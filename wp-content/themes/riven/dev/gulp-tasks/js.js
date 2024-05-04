import webpack from 'webpack-stream';
import webPackConfig from '../webpack.config.js';

export const js = () => {
    return app.gulp
        .src(app.path.src.js, { sourcemaps: true })
        .pipe(
            app.plugins.plumber(
                app.plugins.notify.onError({
                    title: 'JS',
                    message: 'Error: <%= error.message %>',
                })
            )
        )
        .pipe(
            webpack({
                config: webPackConfig,
            })
        )
        .pipe(app.gulp.dest(app.path.build.js))
        .pipe(app.plugins.browsersync.stream());
};
