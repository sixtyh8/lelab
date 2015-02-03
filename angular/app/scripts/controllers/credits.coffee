'use strict'

angular.module('leLabApp').controller 'CreditsCtrl', ($scope) ->
    $scope.currentYear = new Date().getFullYear();


angular.module('leLabApp').controller 'CreditsCtrl.List', ($scope, $state, $filter, $timeout, Credits, ngDialog, notify) ->

    $scope.limit = 50
    $scope.offset = 0
    $scope.loader =
        busy : false

    $scope.getCredits = ->
        # disable infinite scroll while the http call is done
        $scope.loader.busy = true

        Credits.list($scope.limit, $scope.offset).then (data) ->

            if data.length

                if $scope.creditsList?
                    for credit in data
                        $scope.creditsList.push(credit)
                else
                    $scope.creditsList = data

                $scope.offset = $scope.offset + $scope.limit

                # re-enable the infinite scroll
                $scope.loader.busy = false

            else
                return

    $scope.searchCredits = ->
        $scope.creditsPromise = Credits.search($scope.searchTerm).then (data) ->
            $scope.creditsList = data
            #Add highlight

    # Delete a credit
    $scope.deleteCredit = (idx) ->
        $scope.creditToDeleteIndex = idx 
        $scope.creditToDelete = $scope.creditsList[idx]

        ngDialog.open({ 
            template: 'views/partials/confirm.html',
            className: 'ngdialog-theme-default ngdialog-theme-custom',
            showClose: false,
            closeByDocument: false,
            closeByEscape: false,
            scope: $scope
        })

    $scope.doDelete = () ->
        Credits.delete($scope.creditToDelete.id).then (data) ->
            $scope.creditsList.splice($scope.creditToDeleteIndex, 1)
            notify('Credit deleted!')
            ngDialog.closeAll()



angular.module('leLabApp').controller 'CreditsCtrl.Edit', ($scope, $state, $stateParams, Credits, Engineers, Genres, notify) ->

    Credits.get($stateParams.creditId).then (data) ->

        credit = data
    
        if data.genre.length and data.genreName?
            $scope.selectedGenre = data.genreName[0]
            $scope.credit = credit
        else
            $scope.credit =
                genreName : [
                    { name : "" , id: ""}
                ] 
            $scope.credit = _.extend($scope.credit, credit)


    $scope.saveCredit = ->
        
        Credits.update($scope.credit).then (data) ->
            notify('Credit updated!')
            $state.go('credits')


angular.module('leLabApp').controller 'CreditsCtrl.New', ($scope, $state, Credits, Engineers, Genres, Images, notify) ->

    $scope.credit =
        genreName : [
            { name : "" }
        ]
        year: $scope.currentYear
        engineer_id: "1"
        credit: "Mastering"
        homepage_flag: 1

    $scope.saveCredit = ->
        Credits.save($scope.credit).then (data) ->
            notify('Credit saved!')
            $state.go('credits')
