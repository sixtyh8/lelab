'use strict'

angular.module('leLabApp').config ($urlRouterProvider, $stateProvider) ->
    # If unmatched URL, redirect to index
    $urlRouterProvider.otherwise "/"

    # Map /credits to /credits/list
    $urlRouterProvider.when("/credits","/credits/list")
    $urlRouterProvider.when("/whitepapers", "/whitepapers/list")
    # $urlRouterProvider.when("/", "/credits/list")

    # Index
    $stateProvider.state("index",
        url: "/"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/index.html"

    # Users
    ).state("users",
        url: "/users"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/users.html"
    
    ).state("change-password",
        url: "/change-password"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/change-password.html"


    # Credits
    ).state("credits",
        url: "/credits"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/credits.html"
    ).state("credits.list"
        url: "/list"
        views:
            credits:
                templateUrl: "views/partials/credits.list.html"
    ).state("credits.edit"
        url: "/edit/:creditId"
        views:
            credits:
                templateUrl: "views/partials/credits.edit.html"
    ).state("credits.new"
        url: "/new"
        views:
            credits:
                templateUrl: "views/partials/credits.new.html"

    # Whitepapers
    ).state("whitepapers",
        url: "/whitepapers"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/whitepapers.html"
    ).state("whitepapers.list"
        url: "/list"
        views:
            whitepapers:
                templateUrl: "views/partials/whitepapers.list.html"
    ).state("whitepapers.edit"
        url: "/edit/:whitepaperId"
        views:
            whitepapers:
                templateUrl: "views/partials/whitepapers.edit.html"
    ).state("whitepapers.new"
        url: "/new"
        views:
            whitepapers:
                templateUrl: "views/partials/whitepapers.new.html"

    # Genres
    ).state("genres"
        url: "/genres"
        views:
          header:
            templateUrl: "views/partials/header.auth.html"
          main:
            templateUrl: "views/genres.html"

    # Tags
    ).state("tags"
        url: "/tags"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/tags.html"

    # Engineers
    ).state("engineers"
        url: "/engineers"
        views:
            header:
                templateUrl: "views/partials/header.auth.html"
            main:
                templateUrl: "views/engineers.html"

    # Login
    ).state("login"
        url: "/login"
        views:
            header:
                templateUrl: "views/partials/header.unauth.html"
            main:
                templateUrl: "views/login.html"
    )
