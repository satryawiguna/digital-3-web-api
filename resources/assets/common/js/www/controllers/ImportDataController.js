app.controller('ImportDataController', ['$scope', '$rootScope', 'Session', 'ImportData', 'AUTH_EVENTS',
    function($scope, $rootScope, Session, ImportData, AUTH_EVENTS) {
        $scope.importData = function(){
            var file = $scope.fileData;
            var data = new FormData();

            data.append('file', file);

            ImportData.importData(data)
                .success(function (response) {
                    console.log(response);
                })
                .error(function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                });
        };
    }
]);