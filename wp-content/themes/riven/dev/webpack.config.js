import TerserPlugin from 'terser-webpack-plugin';
import path from 'path';
import glob from 'glob';

import { fileURLToPath } from 'url';
import { dirname } from 'path';
import fs from 'fs-extra';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

if (!fs.existsSync(__dirname)) {
    fs.mkdirSync(__dirname);
}

function getEntries() {
    const entryPath = '../src/js/';
    const files = glob.globSync(`${entryPath}/**/*.js`);
    return files.reduce((result, file) => {
        const name = path.relative(entryPath, file).replace(/\.js$/, '');
        result[name] = file;
        return result;
    }, {});
}

const config = {
    mode: 'production',
    optimization: {
        minimizer: [
            new TerserPlugin({
                extractComments: false,
            }),
        ],
    },
    cache: {
        type: 'filesystem', // По умолчанию 'memory'
    },
    entry: getEntries(),
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, '../dist/js'),
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
        ],
    },
    resolve: {
        preferRelative: true,
    },
};

export default config;
