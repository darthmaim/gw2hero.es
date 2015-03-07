'use strict';

var gulp = require('gulp');

var paths = {
    images: {
        src: 'resources/assets/images/*',
        dest: 'public/images'
    }
};

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

gulp.task('watch', function() {
    var watch = require('gulp-watch');
    var plumber = require('gulp-plumber');

    images( gulp.src( paths.images.src )
        .pipe( watch( paths.images.src ))
        .pipe( plumber() )
    );
});

gulp.task('clean', function( callback ) {
    var del = require('del');
    del([
        paths.images.dest
    ], callback);
});
gulp.task('build', ['images']);
gulp.task('build-clean', ['clean'], function() {
    gulp.start( 'build' );
});

gulp.task('default', ['build']);
