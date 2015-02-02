(function() {
  'use strict';
  angular.module('leLabApp').directive('imageUpload', function($upload, $timeout, Images, $rootScope) {
    return {
      scope: {
        credit: '='
      },
      restrict: 'AE',
      templateUrl: 'views/directives/imageUpload.html',
      link: function(scope, element, attrs) {
        scope.cdnUrl = $rootScope.cdnUrl;
        $timeout(function() {
          if (scope.credit.imgName) {
            return scope.imageAlreadyExists = true;
          } else {
            return scope.imageAlreadyExists = false;
          }
        }, 1000);
        jQuery('.file-input').bootstrapFileInput();
        scope.onFileSelect = function($files) {
          var $file, album_name, artist_name, fileArray, fileReader;
          scope.progress = [];
          scope.selectedFiles = $files;
          $file = scope.selectedFiles[0];
          scope.dataUrls = [];
          scope.uploadSucceeded = false;
          if (window.FileReader && $file.type.indexOf('image') > -1) {
            fileReader = new FileReader();
            fileReader.readAsDataURL($file);
            fileReader.onload = function(e) {
              return $timeout(function() {
                return scope.dataUrls[0] = e.target.result;
              }, 1);
            };
            artist_name = '';
            album_name = '';
            fileArray = $files[0].name.split('-');
            if (fileArray[1]) {
              artist_name = jQuery.trim(fileArray[1]);
            }
            if (fileArray[2]) {
              album_name = jQuery.trim(fileArray[2].split('.')[0]);
            }
            if (scope.credit.album_name == null) {
              scope.credit.album_name = album_name;
            }
            if (scope.credit.artist_name == null) {
              return scope.credit.artist_name = artist_name;
            }
          }
        };
        return scope.uploadImage = function() {
          var file;
          file = scope.selectedFiles[0];
          return $upload.upload({
            url: 'http://api.lelabmastering.com/images/upload',
            file: file
          }).success(function(data, status, headers, config) {
            scope.credit.image_id = data.imageID;
            scope.credit.image = data.imageID;
            return scope.uploadSucceeded = true;
          }).error(function(data, status, headers, config) {
            return console.log("error! status code: " + status);
          });
        };
      }
    };
  });

}).call(this);

//# sourceMappingURL=imageUpload.js.map
