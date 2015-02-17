'use strict'

angular.module('leLabApp').service 'User', (Restangular, $q) ->

    login: (username, password) ->
        deferred = $q.defer()

        Restangular.all("auth").post({ 'username': username, 'password': password }).then (results) ->
            deferred.resolve results

        deferred.promise

    list: ->
        deferred = $q.defer()

        Restangular.all("users").getList().then (results) ->
            deferred.resolve results

        deferred.promise

    create: (user) ->
        deferred = $q.defer()

        Restangular.all("users").post({ 'data': user, 'id': null, 'action': 'POST' }).then (results) ->
            deferred.resolve results

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        Restangular.all("users").post({ 'data': null, 'id': id, 'action': 'DELETE' }).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, user) ->
        deferred = $q.defer()

        Restangular.all("users").post({ 'data': user, 'id': id, 'action': 'PUT' }).then (results) ->
            deferred.resolve results

        deferred.promise

    get: (id) ->
        deferred = $q.defer()

        Restangular.one("users", id).get().then (user) ->
            deferred.resolve user

        deferred.promise


