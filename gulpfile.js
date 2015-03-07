'use strict';

var gulp = require('gulp');

var paths = {
    images: {
        src: 'resources/assets/images/*',
        dest: 'public/assets/images'
    },
    css: {
        src: 'resources/assets/css/*',
        dest: 'public/assets/css'
    }
};

// === IMAGES ===

var images = function( source ) {
    var imagemin = require('gulp-imagemin')({
        progressive: true,
        svgoPlugins: [{ removeViewBox: false }]
    });
    var changed = require('gulp-changed');

    return source
        .pipe( changed( paths.images.dest ))
        .pipe( imagemin )
        .pipe( gulp.dest( paths.images.dest ));
};

gulp.task('images', function() {
    return images( gulp.src( paths.images.src ));
});

// === CSS ===

gulp.task('css', function() {
    var sass = require('gulp-sass');
    var autoprefixer = require('gulp-autoprefixer');
    var minify = require('gulp-minify-css');
    var sourcemaps = require('gulp-sourcemaps');

    return gulp.src( paths.css.src )
        .pipe( sourcemaps.init() )
        .pipe( sass() )
        .pipe( autoprefixer() )
        .pipe( minify() )
        .pipe( sourcemaps.write( '.' ))
        .pipe( gulp.dest( paths.css.dest ))
});

gulp.task('copy:normalize', function () {
    var minify = require('gulp-minify-css');
    var changed = require('gulp-changed');
    return gulp.src( 'node_modules/normalize.css/normalize.css' )
        .pipe( changed( paths.css.dest ))
        .pipe( minify() )
        .pipe( gulp.dest( paths.css.dest ));
});

// === GENERAL ===

gulp.task('watch', function() {
    var watch = require('gulp-watch');
    var plumber = require('gulp-plumber');

    gulp.start( 'css' );
    watch( paths.css.src, function() {
        gulp.start( 'css' );
    });

    images( gulp.src( paths.images.src )
        .pipe( watch( paths.images.src ))
        .pipe( plumber() )
    );
});

gulp.task('clean', function( callback ) {
    var del = require('del');
    del([
        'public/assets'
    ], callback);
});
gulp.task('build', ['images', 'copy:normalize']);
gulp.task('build-clean', ['clean'], function() {
    gulp.start( 'build' );
});

gulp.task('default', ['build']);
