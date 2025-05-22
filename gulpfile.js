const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');


function buildStyles() {
  return gulp.src('scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(gulp.dest('public/css'));
};

function buildJs() {
  return gulp.src('js/*.js')
    .pipe(babel())
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/js'));
};

function watch() {
  gulp.watch('scss/*.scss', buildStyles);
  gulp.watch('js/*.js', buildJs);
};

exports.watch   = watch;
exports.default = gulp.series(buildJs, buildStyles);
