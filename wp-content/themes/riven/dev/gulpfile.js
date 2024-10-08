import gulp from 'gulp';
import { path } from './gulp-config/path.js';
import { plugins } from './gulp-config/plugins.js';

global.app = {
    gulp,
    path,
    plugins,
};

import { reset } from './gulp-tasks/reset.js';
import { server } from './gulp-tasks/server.js';
import { scss } from './gulp-tasks/scss.js';
import { js } from './gulp-tasks/js.js';
import { images } from './gulp-tasks/images.js';
import { fonts } from './gulp-tasks/fonts.js';
import { copy } from './gulp-tasks/copy.js';

function watcher() {
    gulp.watch(path.watch.scss, scss);
    gulp.watch(path.watch.js, js);
    gulp.watch(path.watch.images, images);
    gulp.watch(path.watch.files, copy);
}

const mainTasks = gulp.series(fonts, gulp.parallel(copy, scss, js, images));

const dev = gulp.series(mainTasks, gulp.parallel(watcher));
const devWithReset = gulp.series(reset, mainTasks, gulp.parallel(watcher));
const devWithServer = gulp.series(reset, mainTasks, gulp.parallel(watcher, server));

gulp.task('default', dev);
gulp.task('reset', devWithReset);
gulp.task('all', devWithServer);
