'use strict'

angular.module('leLabApp').filter 'truncate', ->
    (text, length, end) ->
        if (isNaN(length))
            length = 10

        if (end == undefined)
            end = "..."

        if (text.length <= length || text.length - end.length <= length)
            return text
        else
            return String(text).substring(0, length-end.length) + end

# Filter to check if a given string is in a given array
angular.module('leLabApp').filter "isInArray", ->
  (input, route) ->
    i = 0
    len = input.length
    i
    while i < len
      return true  if input[i] is route
      i++
    false