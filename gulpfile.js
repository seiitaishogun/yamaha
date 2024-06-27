var gulp = require('gulp');

var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass')(require('sass'));
var rename = require('gulp-rename');

const { watch, series } = require('gulp');

function css(cb) {
    gulp.src('./wp/wp-content/themes/yamaha/css/styles.scss')
        .pipe(rename({
            suffix:'.min'
        }))
        .pipe(sourcemaps.init())
        .pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./wp/wp-content/themes/yamaha/css/'));
  cb();
}

exports.default = function() {
    watch('wp/wp-content/themes/yamaha/css/module/*.scss', css);
};