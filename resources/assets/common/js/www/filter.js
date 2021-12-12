app.filter('spaceLess', function () {
    return function (input) {
        if (input) {
            return input.replace(/\s+/g, '-').toLowerCase();
        }
    }
});

app.filter('blogStatus', function () {
    return function (input) {
        var status;

        switch (input) {
            case 0:
                status = 'Draft';
                break;
            case 1:
                status = 'Publish';
                break;
            case 2:
                status = 'Pendding';
                break;
        }

        return status;
    }
});

app.filter('productStatus', function () {
    return function (input) {
        var status;

        switch (input) {
            case 0:
                status = 'Draft';
                break;
            case 1:
                status = 'Publish';
                break;
            case 2:
                status = 'Pendding';
                break;
        }

        return status;
    }
});

app.filter("trustUrl", ['$sce', function ($sce) {
    return function (recordingUrl) {
        return $sce.trustAsResourceUrl(recordingUrl);
    };
}]);

app.filter("fileName", function () {
    return function (input) {
        var fileName;

        if (!angular.isUndefined(input) && input) {
            fileName = input.replace(/^.*[\\\/]/, '');
        }

        return fileName;
    }
});

app.filter('propsFilter', function () {
    return function (items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function (item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();

                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            out = items;
        }

        return out;
    };
});