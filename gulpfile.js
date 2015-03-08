'use strict';

var gulp = require('gulp');

// === IMAGES ===

var images = {
    src: 'resources/assets/images/*',
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

// === STYLES ===

var styles = {
    src: 'resources/assets/css/*',
    dest: 'public/assets/css',

    build: function() {
        var merge = require('merge-stream');

        return merge(
            styles.buildCss(),
            styles.normalizeCss()
        );
    },
    buildCss: function() {
        var sass = require('gulp-sass');
        var autoprefixer = require('gulp-autoprefixer');
        var minify = require('gulp-minify-css');
        var sourcemaps = require('gulp-sourcemaps');

        return gulp.src( styles.src )
            .pipe( sourcemaps.init() )
            .pipe( sass() )
            .pipe( autoprefixer() )
            .pipe( minify() )
            .pipe( sourcemaps.write( '.' ))
            .pipe( gulp.dest( styles.dest ))
    },
    normalizeCss: function () {
        var minify = require('gulp-minify-css');
        var changed = require('gulp-changed');
        return gulp.src('node_modules/normalize.css/normalize.css')
            .pipe( changed( styles.dest ))
            .pipe( minify() )
            .pipe( gulp.dest( styles.dest ));
    },
    watch: function() {
        var watch = require('gulp-watch');
        return watch( styles.src, styles.buildCss );
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
            styles.build()
        );
    },
    clean: function( cb ) {
        var del = require('del');
        del( general.dest, cb );
    },
    watch: function() {
        general.build();

        styles.watch();
        images.watch();
    }
};

gulp.task( 'watch', general.watch );
gulp.task( 'clean', general.clean );
gulp.task( 'build', general.build );
gulp.task( 'build:css', styles.build );
gulp.task( 'build:images', images.build );
gulp.task( 'build-clean', ['clean'], general.build );
// alias default = build
gulp.task( 'default', ['build'] );
