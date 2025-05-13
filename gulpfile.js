const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function buildStyles() {
  return gulp.src('scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('public/css'));
};

function watch() {
  gulp.watch('scss/*.scss', buildStyles);
};

exports.default = buildStyles;
exports.watch   = watch;
