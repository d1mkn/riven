export const server = done => {
    var files = ['../src/scss/**/*.scss', '../src/js/**/*.js', '../**/*.php'];

    app.plugins.browsersync.init(files, {
        proxy: 'http://riven/',
        notify: false,
        online: true,
        port: 3000,
    });
};
