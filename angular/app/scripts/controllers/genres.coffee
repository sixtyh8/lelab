'use strict'

angular.module('leLabApp').controller 'GenresCtrl', ($scope, Genres, notify) ->

    $scope.genresPromise = Genres.list().then (data) ->
        $scope.genres = data

    $scope.deleteGenre = (id, index) ->
        Genres.delete(id).then (data) ->
            $scope.genres.splice(index, 1)
            notify('Genre deleted!')

    $scope.search = (keyword) ->
        Genres.search(keyword).then (data) ->
            $scope.results = data

    $scope.saveGenre = (data, genre_id) ->
        Genres.update(genre_id, data).then (data) ->
            notify('Genre saved!')
            return true
