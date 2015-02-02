'use strict'

angular.module('leLabApp').service 'Images', (Restangular, $q) ->

    upload: (formData) ->
        deferred = $q.defer()

        Restangular.all('images').withHttpConfig({transformRequest: angular.identity}).customPOST(formData, 'upload', undefined, {'Content-Type': undefined}).then (result)->
            deferred.resolve(result)

        deferred.promise