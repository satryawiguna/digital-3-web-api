app.factory('FileManager', ['$http', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getAccessKey = function (email) {
            var def = Promise.defer();
            var data = {
                email: email
            };
            var config = {};

            $http.post(BASE_API_URL + 'fileManager/getAccessKey?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.setFolder = function (folderPath) {
            var def = Promise.defer();
            var data = {
                folderPath: folderPath
            };
            var config = {};

            $http.post(BASE_API_URL + 'fileManager/folderPath?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.setSubFolder = function (folderPath, subFolderPath) {
            var def = Promise.defer();
            var data = {
                folderPath: folderPath,
                subFolderPath: subFolderPath
            };
            var config = {};

            $http.post(BASE_API_URL + 'fileManager/subFolderPath?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);