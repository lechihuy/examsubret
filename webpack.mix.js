const mix = require('laravel-mix');
let path = require('path');
const fs = require('fs');

const getFiles = (dir, rootDir = null, files = []) => {
    dir = dir.replace(/^\/+|\/+$/gm, '')
    rootDir = rootDir ? rootDir : dir

    fs.readdirSync(dir).forEach(file => {
        fileDir = dir + '/' + file;

        files = fs.statSync(fileDir).isDirectory()
            ? getFiles(fileDir, rootDir, files)
            : files.concat(fileDir.replace(rootDir + '/', ''));
    });

    return files;
}

const ignore = (file) => {
    return path.parse(file).base.charAt(0) == '_' || file == '.DS_Store';
}

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

getFiles('resources/sass').forEach(file => {
    if (! ignore(file)) {
        mix.sass('resources/sass/' + file, 'public/css/' + file.replace('.scss', '.css'));
    }
});

getFiles('resources/js').forEach(file => {
    if (! ignore(file)) {
        mix.js('resources/js/' + file, 'public/js/' + file).sourceMaps();
    }
});

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/images', 'public/images');