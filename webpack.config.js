const Encore = require('@symfony/webpack-encore');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/script.js') // Assurez-vous que ce fichier existe
    .addStyleEntry('styles', './assets/css/styles.scss') // Assurez-vous que ce fichier existe
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    // .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })
    .enableSassLoader()
    .addPlugin(new MiniCssExtractPlugin({ filename: 'styles.css' }))

    // Copier les fichiers images
    .copyFiles({
        from: './assets/images',  // Dossier source
        to: 'images/[path][name].[ext]',  // Destination dans build
        pattern: /\.(png|jpg|jpeg|gif|ico|svg)$/,  // Extensions à inclure
    })

    // Copier les avatars sans nettoyage
    .copyFiles({
        from: './assets/images/avatars', // Dossier source
        to: '../uploads/avatars/[path][name].[ext]',  // En dehors de build
        pattern: /\.(png|jpg|jpeg|gif|svg)$/,
    });

module.exports = Encore.getWebpackConfig();