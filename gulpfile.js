var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var header = require('gulp-header');
var cleanCSS = require('gulp-clean-css');
var pug = require('gulp-pug');
var rename = require("gulp-rename");
var uglify = require('gulp-uglify');
var beautify = require('gulp-html-beautify');
var pkg = require('./package.json');
var gutil = require('gulp-util')

// Set the banner content
var banner = ['/*!\n',
' * Start Bootstrap - <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
' * Copyright 2013-' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
' * Licensed under <%= pkg.license %> (https://github.com/BlackrockDigital/<%= pkg.name %>/blob/master/LICENSE)\n',
' */\n',
''
].join('');

gulp.task('sass', function() {
    gulp.src('resources/assets/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('public/css/'));
});

// Minify compiled CSS
gulp.task('minify-css', ['sass'], function() {
    return gulp.src('public/css/app.css')
    .pipe(cleanCSS({
        compatibility: 'ie8'
    }))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('public/css'))
});

// Minify custom JS
gulp.task('minify-js', function() {
    return gulp.src(['resources/assets/js/**/*.js', '!resources/assets/js/**/*.min.js'])
    .pipe(uglify())
    .on('error', function (err) { gutil.log(gutil.colors.red('[Error]'), err.toString()); })    
    .pipe(header(banner, {
        pkg: pkg
    }))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('public/js'))
});

// Copy vendor files from /node_modules into /vendor
// NOTE: requires `npm install` before running!
gulp.task('copy', function() {
    gulp.src([
        'node_modules/bootstrap/dist/**/*',
        '!**/npm.js',
        '!**/bootstrap-theme.*',
        '!**/*.map'
    ])
    .pipe(gulp.dest('public/vendor/bootstrap'))
    
    gulp.src(['node_modules/jquery/dist/jquery.js', 'node_modules/jquery/dist/jquery.min.js'])
    .pipe(gulp.dest('public/vendor/jquery'))
    
    gulp.src(['node_modules/popper.js/dist/umd/popper.js', 'node_modules/popper.js/dist/umd/popper.min.js'])
    .pipe(gulp.dest('public/vendor/popper'))
    
    gulp.src(['node_modules/jquery.easing/*.js'])
    .pipe(gulp.dest('public/vendor/jquery-easing'))
    
    gulp.src([
        'node_modules/font-awesome/**',
        '!node_modules/font-awesome/**/*.map',
        '!node_modules/font-awesome/.npmignore',
        '!node_modules/font-awesome/*.txt',
        '!node_modules/font-awesome/*.md',
        '!node_modules/font-awesome/*.json'
    ])
    .pipe(gulp.dest('public/vendor/font-awesome'))
    
    gulp.src(['node_modules/chart.js/dist/*.js'])
    .pipe(gulp.dest('public/vendor/chart.js'))
    
    gulp.src([
        'node_modules/datatables.net/js/*.js',
        'node_modules/datatables.net-bs4/js/*.js',
        'node_modules/datatables.net-bs4/css/*.css'
    ])
    .pipe(gulp.dest('public/vendor/datatables/'))
})

// Default task
gulp.task('default', ['sass', 'minify-css', 'minify-js', 'copy']);

// Dev task with browserSync
gulp.task('dev', ['sass', 'minify-css', 'minify-js'], function() {
    gulp.watch('scss/**/*', ['sass']);
    gulp.watch('public/css/*.css', ['minify-css']);
    gulp.watch('public/js/*.js', ['minify-js']);
});