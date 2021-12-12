'use strict';

app.service('Urls', function() {
    this.getActionUrl = function(url, action) {
        if (url.indexOf(action) != -1) {
            return true;
        }
        return false;
    };

    this.getAllUrl = function(next, previous) {
        this.next = {
            url: (!angular.isUndefined(next)) ? next.originalPath : null,
            params: (!angular.isUndefined(next)) ? next.params : null
        };
        this.previous = {
            url: (!angular.isUndefined(previous)) ? previous.originalPath : null,
            params: (!angular.isUndefined(previous)) ? previous.params : null
        };
    };

    return this;
});