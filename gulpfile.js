var gulp, sass, concat, uglify, rename;

gulp 		= require('gulp');
sass 		= require('gulp-sass');
concat 		= require('gulp-concat');
uglify 		= require('gulp-uglify');
rename		= require('gulp-rename');

// sass
gulp.task('sass', function() {
	return gulp.src(
		[
			// modules
			'public/scss/**/*.scss'
		])
		.pipe(sass({sourceComments: 'map'}))
		.pipe(sass()) // Converts the sass from gulp src to css
		.pipe(concat('app.css'))
		.pipe(gulp.dest('public/dist/css/'));
});

// css minifier
gulp.task('mincss', function() {
	return gulp.src(
		[
			'public/scss/**/*.scss'
		])
		.pipe(sass({sourceComments: 'map'}))
		.pipe(concat("app.css")) // concatenating all files in app.css
		.pipe(rename("app.min.css")) // renaming the css file
		.pipe(sass({outputStyle : 'compressed'})) // minifying the css
		.pipe(gulp.dest('public/dist/css')); // destination folder of the file app.css
});

// js
gulp.task('js', function() {
	return gulp.src(
		[	
			// vendors
			'node_modules/jquery/dist/jquery.js',
			'node_modules/popper.js/dist/umd/popper.js',
			'node_modules/bootstrap/dist/js/bootstrap.js',
			'node_modules/datatables.net/js/jquery.datatables.js',
			'node_modules/jspdf/dist/jspdf.min.js',
			'node_modules/html2pdf.js/dist/html2pdf.js',
			'node_modules/handlebars/dist/handlebars.js',
			// 'node_modules/html2pdf/html2pdf.node.js',
			// 'node_modules/html2canvas/dist/html2canvas.js',
			// modules
			'public/js/**/*.js',
			// ignore files with exclamation point at the start of the filename
			'!public/js/**/!*.js'
		]) // get all the files which will be concatenated in app.js
		.pipe(concat('app.js')) // concatenating all the js here
		.pipe(gulp.dest('public/dist/js/')); // destination file of the js
});

// js minifier
gulp.task('minjs', function() {
	return gulp.src(
		[
			// vendors
			'node_modules/jquery/dist/jquery.js',
			// modules
			'public/js/**/*.js'
		])
		.pipe(concat('app.js')) // concatenating all the js files to app.js
		.pipe(rename('app.min.js')) // renaming the js file
		.pipe(uglify()) // minifying the js 
		.pipe(gulp.dest('public/dist/js')) // destination file of the js
	;
});

// watch
gulp.task('watch', ['sass', 'js'], function() {

	// format files-to-run, task-name
	gulp.watch('public/scss/**/*.scss', ['sass']);
	gulp.watch('public/js/**/*.js', ['js']);

});


// for production minifying the css and javascript
gulp.task('prod', ['mincss', 'minjs']);


// default task which will run all the functions
gulp.task('default', ['watch']);