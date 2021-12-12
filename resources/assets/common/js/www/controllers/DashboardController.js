app.controller('DashboardController', ['$scope', '$rootScope', 'Session', 'OTHER_EVENTS',
    function($scope, $rootScope, Session, OTHER_EVENTS) {
        $scope.session = Session;

        $rootScope.$broadcast(OTHER_EVENTS.userInfo, $scope.session);
    }
]);