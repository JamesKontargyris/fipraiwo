var gulp = require('gulp'),
	compass = require('gulp-compass'),
	sassDir = 'app/assets/sass',
	cssDir = 'public/css',
	imgDir = 'public/img';


gulp.task('styles', function()
{
	return gulp.src(sassDir + '/style.scss')
		.pipe(compass({
			style: 'nested',
			sass: sassDir,
			css: cssDir,
			image: imgDir,
			require: ['susy', 'breakpoint']
		}))
		.pipe(gulp.dest(cssDir));
});

gulp.task('watch', function()
{
	gulp.watch(sassDir + '/**/*.scss', ['styles']);
});

gulp.task('default', function()
{
	gulp.start('styles', 'watch');
});