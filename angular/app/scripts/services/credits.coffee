'use strict'

angular.module('leLabApp').service 'Credits', (Restangular, $q, DSCacheFactory) ->

    credits = Restangular.all('credits')

    # Works
    list: (limit, offset) ->
        deferred = $q.defer()

        Restangular.one('credits').get({'limit': limit, 'offset': offset}).then ((results) ->
            #cache.put('credits', results)
            deferred.resolve results
        ), (response) ->
            deferred.reject response

        deferred.promise

    # Works
    get: (id) ->
        deferred = $q.defer()

        Restangular.one('credits', id).get().then (results) ->
            deferred.resolve results

        deferred.promise

    search: (searchTerm) ->
        deferred = $q.defer()

        Restangular.one('credits/search').get({'keyword': searchTerm}).then (results) ->
            deferred.resolve results

        deferred.promise

    # Works
    save: (credit) ->
        deferred = $q.defer()

        credit.genre = credit.genreName[0].name

        credits.post({ 'data': credit, 'id': null, 'action': 'POST' }).then (results) ->
            deferred.resolve results

        deferred.promise

    # Works
    update: (obj) ->
        deferred = $q.defer()
        id = obj.id

        if obj.genreName.name
            obj.genre = obj.genreName.name
        else
            obj.genre = obj.genreName


        credits.post({ 'data': obj, 'id': id, 'action': 'PUT' }).then (results) ->
            deferred.resolve results

        deferred.promise

    # Works
    delete: (id) ->
        deferred = $q.defer()

        credits.post({ 'data': null, 'id': id, 'action': 'DELETE' }).then (results) ->
            deferred.resolve results

        deferred.promise

    # Upload Image
    saveImage: ->
        deferred = $q.defer()


