var gulp = require('gulp'),
  uglify = require('gulp-uglify'),
  concat = require('gulp-concat');

gulp.task('js', function() {
  return gulp.src(['lib/core.js', 'lib/controls/*.js', 'lib/effects/*.js'])
    .pipe(concat('moodular.min.js'))
    .pipe(uglify( { mangle: false } ))
    .pipe(gulp.dest('assets/js'));
});

gulp.task('default', function() {
  gulp.start('js');
});
