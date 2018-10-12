'use strict';

var gulp = require('gulp'),

    // Sass/CSS processes
    bourbon = require('bourbon').includePaths,
    neat = require('bourbon-neat').includePaths,
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    postcssWc = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    //mqpacker = require('css-mqpacker'),  currently doesn't work for themes using max-width for media queries
    sourcemaps = require('gulp-sourcemaps'),
    cssMinify = require('gulp-cssnano'),
    cssMinifyWc = require('gulp-cssnano'),
    sassLint = require('gulp-sass-lint'),

    // Utilities
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber');


/************
 * Utilities
 ***********/

/**
 * Error handling
 *
 * @function
 */
function handleErrors() {
    var args = Array.prototype.slice.call(arguments);

    notify.onError({
        title: 'Task Failed [<%= error.message %>',
        message: 'See console.',
        sound: 'Sosumi' // See: https://github.com/mikaelbr/node-notifier#all-notification-options-with-their-defaults
    }).apply(this, args);

    // gutil.beep(); // Beep 'sosumi' again

    // Prevent the 'watch' task from stopping
    this.emit('end');
}


/************
 * CSS Tasks
 ***********/

/*
 * PostCSS task handler
 */
gulp.task('postcss', function() {

    return gulp.src('assets/sass/style.scss')

        //Error handling
        .pipe(plumber({
            errorHandler: handleErrors
        }))

        // Wrap tasks in a sourcemap
        .pipe( sourcemaps.init() )

        .pipe( sass({
            includePaths: [].concat( bourbon, neat ),
            errLogToConsole: true,
            outputStyle: 'expanded' // Options: nested, expanded, compact, compressed
        }))

        .pipe( postcss([
            autoprefixer({
                browsers: ['last 2 version']
            })
        ]))

        // creates the sourcemap
        .pipe(sourcemaps.write())

        .pipe(gulp.dest('./'));
});

gulp.task('postcssWc', function() {

    return gulp.src('assets/sass/youthSportsTrainer-woocommerce.scss')

    //Error handling
        .pipe(plumber({
            errorHandler: handleErrors
        }))

        // Wrap tasks in a sourcemap
        .pipe( sourcemaps.init() )

        .pipe( sass({
            includePaths: [].concat( bourbon, neat ),
            errLogToConsole: true,
            outputStyle: 'expanded' // Options: nested, expanded, compact, compressed
        }))

        .pipe( postcss([
            autoprefixer({
                browsers: ['last 2 version']
            })
        ]))

        // creates the sourcemap
        .pipe(sourcemaps.write())

        .pipe(gulp.dest('./'));
});

gulp.task('cssMinify', ['postcss'], function() {
    return gulp.src('style.css')

        //Error handling
        .pipe(plumber({
            errorHandler: handleErrors
        }))

        .pipe( cssMinify({
            safe: true
        }))
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('./'))
});

gulp.task('cssMinifyWc', ['postcssWc'], function() {
    return gulp.src('youthSportsTrainer-woocommerce.css')

    //Error handling
        .pipe(plumber({
            errorHandler: handleErrors
        }))

        .pipe( cssMinify({
            safe: true
        }))
        .pipe(rename('youthSportsTrainer-woocommerce.min.css'))
        .pipe(gulp.dest('./lib/components/woocommerce/'))
        .pipe(notify({
            message: 'WooCommerce styles are built.'
        }))
});

gulp.task('sass:lint', ['cssMinify'], function() {
    gulp.src([
        'assets/sass/style.scss',
        '!assets/sass/base/html5-reset/_normalize.scss',
        '!assets/sass/utilities/animate/**/*.*'
    ])
        .pipe(sassLint())
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError())
});

gulp.task('sass:lintWc', ['cssMinifyWc'], function() {
    gulp.src([
        'assets/sass/youthSportsTrainer-woocommerce.scss'
    ])
        .pipe(sassLint())
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError())
});

/*********************
 * All tasks listeners
 ********************/

gulp.task('watch', function() {
    gulp.watch('assets/sass/**/*.scss', ['styles']);
});

/**
 * Individual tasks
 */
// gulp.task('scripts', [''])
gulp.task('styles', ['sass:lint']);
gulp.task('wc', ['sass:lintWc']);