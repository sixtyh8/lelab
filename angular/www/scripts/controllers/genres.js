(function() {
  'use strict';
  angular.module('leLabApp').controller('GenresCtrl', function($scope, Genres, notify) {
    $scope.genresPromise = Genres.list().then(function(data) {
      return $scope.genres = data;
    });
    $scope.deleteGenre = function(id, index) {
      return Genres["delete"](id).then(function(data) {
        $scope.genres.splice(index, 1);
        return notify('Genre deleted!');
      });
    };
    $scope.search = function(keyword) {
      return Genres.search(keyword).then(function(data) {
        return $scope.results = data;
      });
    };
    return $scope.saveGenre = function(data, genre_id) {
      return Genres.update(genre_id, data).then(function(data) {
        notify('Genre saved!');
        return true;
      });
    };
  });

}).call(this);

//# sourceMappingURL=genres.js.map
