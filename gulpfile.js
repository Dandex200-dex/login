var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var open = require('gulp-open');
var htmlmin = require('gulp-htmlmin');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var removeHtmlComments = require('gulp-remove-html-comments');

var Paths = {
  HERE: './',
  DIST: 'dist/',
  CSS: './assets/css/',
  SCSS_TOOLKIT_SOURCES: './assets/scss/paper-dashboard.scss',
  SCSS: './assets/scss/**/**'
};

gulp.task('compile-scss', function() {
  return gulp.src(Paths.SCSS_TOOLKIT_SOURCES)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write(Paths.HERE))
    .pipe(gulp.dest(Paths.CSS))
    .pipe(gulp.dest('build/'));
});

gulp.task('watch', function() {
  gulp.watch(Paths.SCSS, gulp.series('compile-scss'))
  .pipe(gulp.dest('build/'));
});

gulp.task('open', function() {
  gulp.src('examples/dashboard.html')
    .pipe(open())
    .pipe(gulp.dest('build/'));
});

gulp.task('open-app', gulp.parallel('open', 'watch'));
