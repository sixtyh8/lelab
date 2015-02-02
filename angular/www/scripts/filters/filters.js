(function() {
  'use strict';
  angular.module('leLabApp').filter('truncate', function() {
    return function(text, length, end) {
      if (isNaN(length)) {
        length = 10;
      }
      if (end === void 0) {
        end = "...";
      }
      if (text.length <= length || text.length - end.length <= length) {
        return text;
      } else {
        return String(text).substring(0, length - end.length) + end;
      }
    };
  });

  angular.module('leLabApp').filter("isInArray", function() {
    return function(input, route) {
      var i, len;
      i = 0;
      len = input.length;
      i;
      while (i < len) {
        if (input[i] === route) {
          return true;
        }
        i++;
      }
      return false;
    };
  });

}).call(this);

//# sourceMappingURL=filters.js.map
