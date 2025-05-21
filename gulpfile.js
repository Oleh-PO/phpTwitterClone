const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');

function buildStyles() {
  return gulp.src('scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('public/css'));
};

function buildJs() {
  return gulp.src('js/*.js')
    .pipe(concat('main.js'))
    .pipe(gulp.dest('public/js'));
};

function watch() {
  gulp.watch('scss/*.scss', buildStyles);
  gulp.watch('js/*.js', buildJs);
};

exports.default = buildJs;
exports.default = buildStyles;
exports.watch   = watch;
