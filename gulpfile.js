var gulp = require('gulp');
var browserSync = require('browser-sync').create();

// css plugins
var sass = require('gulp-sass');
var glob = require('gulp-sass-glob');
var cleanCss = require('gulp-clean-css');
var autoprefix = require('gulp-autoprefixer');

// js plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

// both
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var notify = require('gulp-notify');


var config = {
  css: {
    src: 'app/Resources/assets/scss/**/*.scss',
    dest: 'web/assets/css',
    sourceMapDest: '.',
    includePaths: [
      'node_modules/sass-mq',
      'node_modules/susy/sass'
    ]
  },
  js: {
    src: 'app/Resources/assets/js/**/*.js',
    dest: 'web/assets/js',
    sourceMapDest: '.',
    fileName: 'script.js'
  },
  browserSyncProxy: 'http://127.0.0.1:8000'
};

var onError = function(err) {
  notify.onError({
    title:    "Gulp",
    subtitle: "Failure!",
    message:  "Error: <%= error.message %>",
    sound:    "Beep"
  })(err);
  this.emit('end');
};

gulp.task('css', function() {
  return gulp.src(config.css.src)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(glob())
    .pipe(sourcemaps.init())
    .pipe(sass({
      style: 'compressed',
      includePaths: config.css.includePaths
    }))
    .pipe(cleanCss({compatibility: 'ie8'}))
    .pipe(autoprefix('last 2 versions', '> 1%', 'ie 9', 'ie 10', 'iOS 7'))
    .pipe(sourcemaps.write(config.css.sourceMapDest))
    .pipe(gulp.dest(config.css.dest));
});

gulp.task('js', function() {
  return gulp.src(config.js.src)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(concat(config.js.fileName))
    .pipe(uglify())
    .pipe(sourcemaps.write(config.js.sourceMapDest))
    .pipe(gulp.dest(config.js.dest));
});

gulp.task('serve', ['css', 'js'], function() {
  browserSync.init({
    proxy: config.browserSyncProxy
  });

  gulp.watch(config.css.src, ['css']);
  gulp.watch(config.js.src, ['js']);
  gulp.watch('app/Resources/assets/**/*').on('change', browserSync.reload);
});

gulp.task('default', ['serve']);