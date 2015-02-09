'use strict'

angular.module('leLabApp').controller 'UsersCtrl', ($scope, $filter, User, Session, notify) ->

    setUser = ->
        $scope.newUser =
            username: ''
            email: ''
            password: ''
            admin: 'placeholder'

    $scope.statuses = [
        {value: 'true', text: 'Admin'}
        {value: 'false', text: 'Editor'}
    ]

    $scope.showStatus = (user) ->

        selected = []

        if user.admin?
          selected = $filter('filter')($scope.statuses, {value: user.admin})

        if selected.length
            return selected[0].text
        else
            return 'Not set'

    $scope.usersPromise = User.list().then (data) ->
        $scope.userList = data

    $scope.addUser = ->
        User.create($scope.newUser).then (data) ->
            $scope.userList.push(data)
            setUser()
            notify('User added!')


    # Delete a credit
    $scope.deleteUser = (userId, index) ->
        User.delete(userId).then (data) ->
            $scope.userList.splice(index, 1)
            notify('User deleted!')

    $scope.saveUser = (data, id) ->
        return User.update(id, data)
        
        # User.update(id, data).then (data) ->
        #     notify('User updated!')
        #     return true

    setUser()

    $scope.getCurrentUser = () ->
        # Get the current user's ID
        currentUserId = Session.info().userId
        # Get the current user's information
        User.get(currentUserId).then (user) ->
            $scope.currentUser = user

    $scope.updatePassword = () ->
        $scope.currentUser.password = $scope.currentUser.newPassword if $scope.currentUser.newPassword?
        
        # console.log $scope.currentUser

        User.update($scope.currentUser.id, $scope.currentUser).then (data) ->

            if data.message is 'success'
                notify('Password changed!')


