'use strict'

angular.module('leLabApp').controller 'GenresCtrl', ($scope, Genres, notify) ->

    $scope.newGenre = {}
    
    $scope.genresPromise = Genres.list().then (data) ->
        $scope.genres = data

    $scope.deleteGenre = (id, index) ->
        Genres.delete(id).then (data) ->
            $scope.genres.splice(index, 1)
            notify('Genre deleted!')

    $scope.addGenre = ->
        if $scope.newGenre.label?
            Genres.add($scope.newGenre.label).then (data) ->
                $scope.newGenre.label = null
                # Add the tag to the scope
                $scope.genres.push(data)
                notify('Genre added!')

    $scope.search = (keyword) ->
        Genres.search(keyword).then (data) ->
            $scope.results = data

    $scope.saveGenre = (data, genre_id) ->
        Genres.update(genre_id, data).then (data) ->
            notify('Genre saved!')
            return true
