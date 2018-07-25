// Require Gulp, Sass, and browser-sync

const gulp        = require('gulp');

// Move JS Files to src/js

gulp.task('js', function() {
    return gulp.src(['node_modules/jsoneditor/dist/jsoneditor.min.js'])
        .pipe(gulp.dest("js"))
});

// Move Font Awesome CSS to src/css

gulp.task('css', function() {
  return gulp.src('node_modules/jsoneditor/dist/jsoneditor.min.css')
    .pipe(gulp.dest('css'))
});
gulp.task('img', function() {
	return gulp.src('node_modules/jsoneditor/dist/img/*')
	.pipe(gulp.dest('css/img'))
});

// Gulp default tasks

gulp.task('default', ['css', 'js','img']);
