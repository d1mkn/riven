import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import autoprefixer from 'gulp-autoprefixer';
import groupCssMediaQueries from 'gulp-group-css-media-queries';

const sass = gulpSass(dartSass);

export const scss = () => {
    return (
        app.gulp
            .src([app.path.src.scss, '!../src/scss/libs/libs.scss', '!../src/scss/base/base.scss', '!../src/scss/global/global.scss'], {
                sourcemaps: true,
            })
            .pipe(
                app.plugins.plumber(
                    app.plugins.notify.onError({
                        title: 'SCSS',
                        message: 'Error: <%= error.message %>',
                    })
                )
            )
            .pipe(
                sass({
                    outputStyle: 'expanded',
                })
            )
            .pipe(groupCssMediaQueries())
            .pipe(
                autoprefixer({
                    grid: true,
                    overrideBrowserlist: ['last 3 versions'],
                    cascade: false,
                })
            )
            // Uncomment if you need an uncompressed take of the styles file
            // .pipe(app.gulp.dest(app.path.build.css))
            .pipe(
                cleanCss({
                    compatibility: 'ie8',
                    level: 2,
                })
            )
            .pipe(app.gulp.dest(app.path.build.css))
            .pipe(app.plugins.browsersync.stream())
    );
};
