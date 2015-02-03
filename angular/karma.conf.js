// Karma configuration
// http://karma-runner.github.io/0.10/config/configuration-file.html

module.exports = function(config) {
  config.set({
    // base path, that will be used to resolve files and exclude
    basePath: '',

    // testing framework to use (jasmine/mocha/qunit/...)
    frameworks: ['jasmine'],

    // list of files / patterns to load in the browser
    files: [
      'app/bower_components/angular/angular.js',
      'app/bower_components/angular-mocks/angular-mocks.js',
      'app/bower_components/angular-resource/angular-resource.js',
      'app/bower_components/angular-cookies/angular-cookies.js',
      'app/bower_components/angular-sanitize/angular-sanitize.js',
      'app/bower_components/angular-route/angular-route.js',
      'app/bower_components/jquery/jquery.js',
      'app/bower_components/ng-file-upload-shim/angular-file-upload-shim.js',
      'app/bower_components/angular/angular.js',
      'app/bower_components/sass-bootstrap/dist/js/bootstrap.js',
      'app/bower_components/angular-resource/angular-resource.js',
      'app/bower_components/angular-cookies/angular-cookies.js',
      'app/bower_components/angular-sanitize/angular-sanitize.js',
      'app/bower_components/angular-route/angular-route.js',
      'app/bower_components/lodash/dist/lodash.compat.js',
      'app/bower_components/restangular/dist/restangular.js',
      'app/bower_components/angular-ui-router/release/angular-ui-router.js',
      'app/bower_components/angular-animate/angular-animate.js',
      'app/bower_components/angular-busy/dist/angular-busy.js',
      'app/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
      'app/bower_components/angular-xeditable/dist/js/xeditable.js',
      'app/bower_components/gsap/src/uncompressed/TweenMax.js',
      'app/bower_components/ng-Fx/dist/ng-Fx.js',
      'app/bower_components/angular-confirm-click/dist/confirmClick.js',
      'app/bower_components/angular-class/angular-class.js',
      'app/bower_components/angular-bindonce/bindonce.js',
      'app/bower_components/angular-webstorage/angular-webstorage.js',
      'app/bower_components/angular-cache/dist/angular-cache.min.js',
      'app/bower_components/textAngular/dist/textAngular.min.js',
      'app/bower_components/ngInfiniteScroll/build/ng-infinite-scroll.js',
      'app/bower_components/ng-file-upload/angular-file-upload.js',
      'app/bower_components/angular-ui-bootstrap-bower/ui-bootstrap-tpls.js',
      'app/bower_components/bootstrap-css/js/bootstrap.min.js',
      'app/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
      'app/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput-angular.js',
      'app/bower_components/bootstrap-file-input/bootstrap.file-input.js',
      'app/bower_components/sass-bootstrap/js/dropdown.js',
      'app/scripts/*.coffee',
      'app/scripts/**/*.coffee',
      'test/mock/**/*.coffee',
      'test/spec/**/*.coffee'
    ],

    // list of files / patterns to exclude
    exclude: [],

    // web server port
    port: 8080,

    // level of logging
    // possible values: LOG_DISABLE || LOG_ERROR || LOG_WARN || LOG_INFO || LOG_DEBUG
    logLevel: config.LOG_INFO,


    // enable / disable watching file and executing tests whenever any file changes
    autoWatch: false,


    // Start these browsers, currently available:
    // - Chrome
    // - ChromeCanary
    // - Firefox
    // - Opera
    // - Safari (only Mac)
    // - PhantomJS
    // - IE (only Windows)
    browsers: ['Chrome'],


    // Continuous Integration mode
    // if true, it capture browsers, run tests and exit
    singleRun: false
  });
};
