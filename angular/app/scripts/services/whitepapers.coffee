'use strict'

angular.module('leLabApp').service 'Whitepapers', (Restangular, $q) ->

    whitepapers = Restangular.all("whitepapers")

    # Works
    list: ->
    	deferred = $q.defer()

    	whitepapers.getList().then ((results) ->
            deferred.resolve results
        ), (response) ->
            console.log response
            deferred.reject response

    	deferred.promise

    # Works
    get: (id) ->
        deferred = $q.defer()

        Restangular.one('whitepapers', id).get().then (results) ->
            deferred.resolve results

        deferred.promise

    # Works
    save: (whitepaper) ->
        deferred = $q.defer()

        whitepapers.post({ 'data': whitepaper }).then (results) ->
            deferred.resolve results

        deferred.promise

    # Works
    update: (obj) ->
        deferred = $q.defer()
        id = obj.id

        Restangular.one('whitepapers', id).get().then (result) ->
            result = obj
            result.put().then (data) ->
                deferred.resolve data

        deferred.promise

    # Works
    delete: (id) ->
        deferred = $q.defer()

        Restangular.one('whitepapers', id).remove().then (results) ->
            deferred.resolve results

        deferred.promise

    search: (searchTerm) ->
        deferred = $q.defer()

        Restangular.one('whitepapers/search').get({'keyword': searchTerm}).then (results) ->
            deferred.resolve results

        deferred.promise
