//import gulp from "gulp";
//import sass from "gulp-sass";
//import gutil from "gulp-util";

// Gulp.js configuration
'use strict';

const

  // source and build folders
  dir = {
    src         : './',
    build       : './'
  }

  // Gulp and plugins
  //newer         = require('gulp-newer'),
  //imagemin      = require('gulp-imagemin'),
  //sass          = require('gulp-sass'),
  //postcss       = require('gulp-postcss'),
  //deporder      = require('gulp-deporder'),
  //concat        = require('gulp-concat'),
  //stripdebug    = require('gulp-strip-debug'),
  //uglify        = require('gulp-uglify')
;

var sass = require('gulp-sass')(require('sass'));
var gulp = require('gulp');


gulp.task('styles', () => {
    return gulp.src('./sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./'));
});


gulp.task('watch', () => {
    gulp.watch('sass/**/*.scss', (done) => {
        gulp.series(['styles'])(done);
    });
});