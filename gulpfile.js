const gulp = require('gulp');
const rename = require('gulp-rename');
const watch = require('gulp-watch');
const sass = require('gulp-sass')(require('sass'));

function scssToCss() {
  return gulp.src('scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('css/'));
}

function watchFiles() {
    gulp.watch('scss/**/*.scss', scssToCss);
}

gulp.task('default', gulp.series(scssToCss, watchFiles));
