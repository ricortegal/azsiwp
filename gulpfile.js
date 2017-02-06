'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var sourcemaps = require('gulp-sourcemaps');


 
 gulp.task('sass', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream())
});

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});


gulp.task('browser-sync', function() {
  browserSync.init({
            proxy: "azsiwp.15cruces/"
    });
  gulp.watch("sass/**/*.scss", ['sass']);
  gulp.watch("**/*.php",function(vinyl){
    console.log(vinyl)
  }).on('change',browserSync.reload);
})

gulp.task('default',['browser-sync']);

