(function() {
  'use strict';
  angular.module('leLabApp').directive('creditForm', function(Genres, Engineers) {
    return {
      scope: {
        credit: '='
      },
      restrict: 'AE',
      templateUrl: 'views/directives/creditForm.html',
      link: function(scope, element, attrs) {
        Genres.list().then(function(data) {
          return scope.genres = data;
        });
        return Engineers.list().then(function(data) {
          return scope.engineers = data;
        });
      }
    };
  });

}).call(this);

//# sourceMappingURL=creditForm.js.map
