'use strict'

angular.module('leLabApp').controller 'WhitepapersCtrl', ($scope, $filter) ->

angular.module('leLabApp').controller 'WhitepapersCtrl.List', ($scope, $state, Whitepapers, notify) ->

    $scope.whitepapersPromise = Whitepapers.list().then (data) ->
        $scope.whitepapers =
            list : data
            config :
                itemsPerPage: 10
                fillLastPage: true


    $scope.searchWhitepapers = ->
        $scope.whitepapersPromise = Whitepapers.search($scope.searchTerm).then (data) ->
            $scope.whitepapers.list = data


    $scope.deleteWhitepaper = (whitepaperID, index) ->
        Whitepapers.delete(whitepaperID).then (data) ->
            $scope.whitepapers.list.splice(index, 1)
            notify('Whitepaper deleted!')


angular.module('leLabApp').controller 'WhitepapersCtrl.Edit', ($scope, $state, $stateParams, $filter, Whitepapers, notify) ->

    Whitepapers.get($stateParams.whitepaperId).then (data) ->
        $scope.whitepaper = data
        $scope.whitepaper.tags = []

        # Add each tag to the tags array of the scope
        for tag in data.tagsList
            $scope.whitepaper.tags.push(tag[0].name)

    $scope.saveWhitepaper = ->
        newDate = new Date()
        $scope.now = $filter('date')(newDate, 'short')
        $scope.whitepaper.updated_at = $scope.now
        Whitepapers.update($scope.whitepaper).then (data) ->
            notify('Whitepaper updated!')
            $state.go('whitepapers')


angular.module('leLabApp').controller 'WhitepapersCtrl.New', ($scope, $state, $filter, Whitepapers, notify) ->

    $scope.whitepaper =
        created_at: null
        tags: []

    $scope.saveWhitepaper = ->
        newDate = new Date()
        $scope.now = $filter('date')(newDate, 'short')
        $scope.whitepaper.created_at = $scope.now

        Whitepapers.save($scope.whitepaper).then (data) ->
            notify('Whitepaper saved!')
            $state.go('whitepapers')
