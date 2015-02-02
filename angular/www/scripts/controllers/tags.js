(function() {
  'use strict';
  angular.module('leLabApp').controller('TagsCtrl', function($scope, Tags, notify) {
    $scope.newTag = {};
    $scope.tagsPromise = Tags.list().then(function(data) {
      return $scope.tags = data;
    });
    $scope.deleteTag = function(id, index) {
      return Tags["delete"](id).then(function(data) {
        $scope.tags.splice(index, 1);
        return notify('Tag deleted!');
      });
    };
    $scope.addTag = function() {
      if ($scope.newTag.label != null) {
        return Tags.add($scope.newTag.label).then(function(data) {
          $scope.newTag.label = null;
          $scope.tags.push(data);
          return notify('Tag added!');
        });
      }
    };
    return $scope.saveTag = function(data, tag_id) {
      return Tags.update(tag_id, data).then(function(data) {
        notify('Tag saved!');
        return true;
      });
    };
  });

}).call(this);

//# sourceMappingURL=tags.js.map
