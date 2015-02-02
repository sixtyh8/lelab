(function() {
  'use strict';
  angular.module('leLabApp').directive('engineerOptions', function(Engineers) {
    return {
      scope: {},
      restrict: 'AE',
      replace: true,
      templateUrl: 'views/directives/engineerOptions.html',
      link: function(scope, element, attrs) {
        console.log("engineerOptions directive");
        return Engineers.list().then(function(data) {
          return scope.engineers = data;
        });
      }
    };
  });

}).call(this);

//# sourceMappingURL=engineerOptions.js.map
