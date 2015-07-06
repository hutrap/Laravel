angular.module('rotaSlotService', [])

    .factory('RotaSlot', function($http) {

        return {
            // get all the comments
            get : function() {
                return $http.get('/api/rotaSlot');
            }
        }

    });