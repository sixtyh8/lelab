'use strict'

angular.module('leLabApp').controller 'IndexCtrl', ($scope, Dashboard) ->
    
	# Get dashboard
    Dashboard.get().then (data) ->
    	$scope.data = data
