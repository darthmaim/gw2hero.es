'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');

var log = function( head, msg ) {
    gutil.log( '[' + gutil.colors.blue( head ) + ']', msg );
};
var logger = function( head ) {
    return function( msg ) {
        log( head, msg );
    };
};

// === IMAGES ===

var images = {
    src: ['resources/assets/images/**/*.{svg,png,jpg}', '!resources/assets/images/icons{,/**}'],
    dest: 'public/assets/images',

    build: function() {
        var files = gulp.src( images.src );
        return images.handle( files );
    },
    watch: function() {
        var watch = require( 'gulp-watch' );
        var plumber = require('gulp-plumber');

        var files = watch( images.src ).pipe( plumber() );
        return images.handle( files );
    },
    handle: function( source ) {
        var imagemin = require('gulp-imagemin');
        var changed = require('gulp-changed');

        var imageminConfig = {
            progressive: true,
            svgoPlugins: [{ removeViewBox: false }]
        };

        return source
            .pipe( changed( images.dest ))
            .pipe( imagemin( imageminConfig ))
            .pipe( gulp.dest( images.dest ));
    }
};

var icons = {
    src: 'resources/assets/images/icons/**/*.svg',
    dest: 'public/assets/images',

    build: function() {
        var files = gulp.src(icons.src);
        return icons.handle(files);
    },
    watch: function() {

    },
    handle: function(source) {
        var sprite = require('gulp-svg-sprite');

        return source.pipe(sprite({
            mode: {
                symbol: {
                    dest: '',
                    sprite: 'icons.svg'
                }
            }
        })).pipe(gulp.dest(icons.dest));
    }
};

// === STYLES ===

var styles = {
    paths: {
        src: 'resources/assets/css/*.{scss,sass,css}',
        watch: 'resources/assets/css/**/*.{scss,sass,css}',
        dest: 'public/assets/css'
    },

    build: function() {
        var merge = require('merge-stream');

        return merge(
            styles.buildCss(),
            styles.normalizeCss()
        );
    },
    buildCss: function() {
        var sass = require('gulp-sass');
        var postcss = require('gulp-postcss');
        var autoprefixer = require('autoprefixer');
        var minify = require('gulp-minify-css');
        var sourcemaps = require('gulp-sourcemaps');

        log('css', 'build');

        return gulp.src( styles.paths.src )
            .pipe( sourcemaps.init() )
            .pipe( sass() )
            .pipe( postcss([autoprefixer]) )
            .pipe( minify() )
            .pipe( sourcemaps.write( '.' ))
            .pipe( gulp.dest( styles.paths.dest ))
    },
    normalizeCss: function () {
        var minify = require('gulp-minify-css');
        var changed = require('gulp-changed');
        return gulp.src('node_modules/normalize.css/normalize.css')
            .pipe( changed( styles.paths.dest ))
            .pipe( minify() )
            .pipe( gulp.dest( styles.paths.dest ));
    },
    watch: function() {
        var watch = require('gulp-watch');
        return watch( styles.paths.watch, styles.buildCss );
    }
};

// === JS ===

var js = {
    src: './resources/assets/js/*',
    dest: './public/assets/js',
    entry: './resources/assets/js/gw2heroes.js',

    config: {
        entries: './resources/assets/js/gw2heroes.js',
        dest: './public/assets/js',
        outputName: 'gw2heroes.js',
        paths: [ './node_modules' ],
        fullPaths: false,
        debug: true
    },

    build: function() {
        var browserify = require('browserify');
        var babelify = require('babelify');

        var bundle = browserify( js.config )
            .transform( babelify );

        return js.handle( bundle, js.config );
    },
    watch: function() {
        var browserify = require('browserify');
        var watchify = require('watchify');
        var babelify = require('babelify');
        var extend = require('lodash/object/extend');

        var config = extend( js.config, watchify.args );
        var bundle = watchify( browserify( config ))
            .transform( babelify );

        bundle.on('update', function() {
            js.handle( bundle, config );
        });
        bundle.on( 'log', logger('js') );

        return js.handle( bundle, config )
    },
    handle: function( bundle, config ) {
        var sourcemaps = require('gulp-sourcemaps');
        var uglify = require('gulp-uglify');
        var source = require('vinyl-source-stream');
        var buffer = require('gulp-buffer');

        return bundle
            .bundle()
            .on( 'error', function( err ) {
                log( 'js', gutil.colors.red('Error: ') + err );
            })
            .pipe( source( config.outputName ))
            .pipe( buffer() )
            .pipe( sourcemaps.init({ loadMaps: true }) )
            .pipe( uglify() )
            .pipe( sourcemaps.write( '.' ))
            .pipe( gulp.dest( config.dest ));
    }
};

// === GENERAL ===

var general = {
    src: 'resources/assets',
    dest: 'public/assets',

    build: function() {
        var merge = require('merge-stream');

        return merge(
            images.build(),
            icons.build(),
            styles.build(),
            js.build()
        );
    },
    clean: function() {
        var del = require('del');
        return del( general.dest );
    },
    watch: function() {
        styles.build();
        styles.watch();

        images.build();
        images.watch();

        icons.build();
        icons.watch();

        js.watch();
    }
};

gulp.task( 'watch', general.watch );
gulp.task( 'clean', general.clean );
gulp.task( 'build', general.build );
gulp.task( 'build:js', js.build );
gulp.task( 'build:css', styles.build );
gulp.task( 'build:images', images.build );
gulp.task( 'build:icons', icons.build );
gulp.task( 'build-clean', ['clean'], general.build );
// alias default = build
gulp.task( 'default', ['build'] );
