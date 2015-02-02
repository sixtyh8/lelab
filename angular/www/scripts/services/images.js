(function() {
  'use strict';
  angular.module('leLabApp').service('Images', function(Restangular, $q) {
    return {
      upload: function(formData) {
        var deferred;
        deferred = $q.defer();
        Restangular.all('images').withHttpConfig({
          transformRequest: angular.identity
        }).customPOST(formData, 'upload', void 0, {
          'Content-Type': void 0
        }).then(function(result) {
          return deferred.resolve(result);
        });
        return deferred.promise;
      }
    };
  });

}).call(this);

//# sourceMappingURL=images.js.map
