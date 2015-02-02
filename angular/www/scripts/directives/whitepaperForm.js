(function() {
  'use strict';
  angular.module('leLabApp').directive('whitepaperForm', function(Tags) {
    return {
      scope: {
        whitepaper: '='
      },
      restrict: 'AE',
      templateUrl: 'views/directives/whitepaperForm.html',
      link: function(scope, element, attrs) {
        return Tags.list().then(function(data) {
          return scope.tagsList = data;
        });
      }
    };
  });

}).call(this);

//# sourceMappingURL=whitepaperForm.js.map
