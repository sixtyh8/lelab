'use strict'

angular.module('leLabApp').directive 'creditForm', (Genres, Engineers) ->
    scope: {credit: '='}
    restrict: 'AE'
    templateUrl: 'views/directives/creditForm.html'
    link: (scope, element, attrs) ->

        # Get genres
        Genres.list().then (data) ->
            scope.genres = data

        # Get engineers
        Engineers.list().then (data) ->
            scope.engineers = data
