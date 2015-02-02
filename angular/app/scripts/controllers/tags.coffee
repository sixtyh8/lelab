'use strict'

angular.module('leLabApp').controller 'TagsCtrl', ($scope, Tags, notify) ->

    $scope.newTag = {}

    $scope.tagsPromise = Tags.list().then (data) ->
        $scope.tags = data

    $scope.deleteTag = (id, index) ->
        Tags.delete(id).then (data) ->
            # Remove genre from $scope.tags if request was successful
            $scope.tags.splice(index, 1)
            notify('Tag deleted!')

    $scope.addTag = ->
        if $scope.newTag.label?
            Tags.add($scope.newTag.label).then (data) ->
                $scope.newTag.label = null
                # Add the tag to the scope
                $scope.tags.push(data)
                notify('Tag added!')

    $scope.saveTag = (data, tag_id) ->
        Tags.update(tag_id, data).then (data) ->
            notify('Tag saved!')
            return true
