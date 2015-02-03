'use strict'

angular.module('leLabApp').service 'Session', ($q, webStorage) ->

    logged: ->
        !!webStorage.session.get('authenticated')

    isAdmin: ->
        !!webStorage.session.get('admin')

    create: (user) ->
        deferred = $q.defer()

        $q.all([
            webStorage.session.add 'authenticated', true
            webStorage.session.add 'username', user.username
            webStorage.session.add 'userId', user.userId
            webStorage.session.add 'email', user.email
            webStorage.session.add 'admin', user.admin
        ]).then ->
            deferred.resolve()
            return

        deferred.promise

    remove: ->
        webStorage.session.clear()

    info: ->
        authenticated: webStorage.session.get("authenticated")
        username: webStorage.session.get("username")
        userId: webStorage.session.get("userId")
        email: webStorage.session.get("email")
        admin: webStorage.session.get("admin")


