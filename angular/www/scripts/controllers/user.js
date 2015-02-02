(function() {
  'use strict';
  angular.module('leLabApp').controller('UsersCtrl', function($scope, $filter, User, Session, notify) {
    var setUser;
    setUser = function() {
      return $scope.newUser = {
        username: '',
        email: '',
        password: '',
        admin: 'placeholder'
      };
    };
    $scope.statuses = [
      {
        value: 'true',
        text: 'Admin'
      }, {
        value: 'false',
        text: 'Editor'
      }
    ];
    $scope.showStatus = function(user) {
      var selected;
      selected = [];
      if (user.admin != null) {
        selected = $filter('filter')($scope.statuses, {
          value: user.admin
        });
      }
      if (selected.length) {
        return selected[0].text;
      } else {
        return 'Not set';
      }
    };
    $scope.usersPromise = User.list().then(function(data) {
      return $scope.userList = data;
    });
    $scope.addUser = function() {
      return User.create($scope.newUser).then(function(data) {
        $scope.userList.push(data);
        setUser();
        return notify('User added!');
      });
    };
    $scope.deleteUser = function(userId, index) {
      return User["delete"](userId).then(function(data) {
        $scope.userList.splice(index, 1);
        return notify('User deleted!');
      });
    };
    $scope.saveUser = function(data, id) {
      return User.update(id, data).then(function(data) {
        notify('User updated!');
        return true;
      });
    };
    setUser();
    $scope.getCurrentUser = function() {
      var currentUserId;
      currentUserId = Session.info().userId;
      return User.get(currentUserId).then(function(user) {
        return $scope.currentUser = user;
      });
    };
    return $scope.updatePassword = function() {
      if ($scope.currentUser.newPassword != null) {
        $scope.currentUser.password = $scope.currentUser.newPassword;
      }
      return User.update($scope.currentUser.id, $scope.currentUser).then(function(data) {
        if (data.message === 'success') {
          return notify('Password changed!');
        }
      });
    };
  });

}).call(this);

//# sourceMappingURL=user.js.map
