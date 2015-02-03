'use strict'

angular.module('leLabApp').directive 'engineerOptions', (Engineers) ->
    scope: {}
    restrict: 'AE'
    replace: true
    templateUrl: 'views/directives/engineerOptions.html'
    link: (scope, element, attrs) ->
        console.log "engineerOptions directive"
        Engineers.list().then (data) ->
            scope.engineers = data
