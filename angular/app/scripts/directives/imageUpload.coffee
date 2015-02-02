'use strict'

angular.module('leLabApp').directive 'imageUpload', ($upload, $timeout, Images, $rootScope) ->
    scope: {credit: '='}
    restrict: 'AE'
    templateUrl: 'views/directives/imageUpload.html'
    link: (scope, element, attrs) ->

        scope.cdnUrl = $rootScope.cdnUrl

        $timeout( () ->

            if scope.credit.imgName
                scope.imageAlreadyExists = true
            else
                scope.imageAlreadyExists = false

        , 1000)

        jQuery('.file-input').bootstrapFileInput()

        scope.onFileSelect = ($files) ->
            scope.progress = []
            scope.selectedFiles = $files
            $file = scope.selectedFiles[0]
            scope.dataUrls = []
            scope.uploadSucceeded = false

            if (window.FileReader && $file.type.indexOf('image') > -1)
                fileReader = new FileReader()
                fileReader.readAsDataURL($file)
                fileReader.onload = (e) ->
                    $timeout( () ->
                        scope.dataUrls[0] = e.target.result
                    , 1)

                artist_name = ''
                album_name = ''
                
                # Getting artist and album name from filename
                fileArray = $files[0].name.split('-')
                artist_name = jQuery.trim(fileArray[1]) if fileArray[1]
                album_name = jQuery.trim(fileArray[2].split('.')[0]) if fileArray[2]

                if !scope.credit.album_name?
                    scope.credit.album_name = album_name

                if !scope.credit.artist_name?
                    scope.credit.artist_name = artist_name

        scope.uploadImage = () ->

            file = scope.selectedFiles[0]

            # $upload.upload({
            #     url: 'http://api.lelab.local/images/upload',
            #     file: file
            # })

            $upload.upload({
                url: 'http://api.lelabmastering.com/images/upload',
                file: file
            })

            # .progress( (evt) ->
            #     console.log 'percent: ' + parseInt(100.0 * evt.loaded / evt.total)
            # )

            .success( (data, status, headers, config) ->    
                scope.credit.image_id = data.imageID
                scope.credit.image = data.imageID
                scope.uploadSucceeded = true
            )

            .error( (data, status, headers, config) ->
                console.log "error! status code: " + status
            )
