'use strict'

angular.module('leLabApp').directive 'whitepaperForm', (Tags) ->
    scope: {whitepaper: '='}
    restrict: 'AE'
    templateUrl: 'views/directives/whitepaperForm.html'
    link: (scope, element, attrs) ->

        # Get tags
        Tags.list().then (data) ->
            scope.tagsList = data
