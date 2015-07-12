angular.module('rotaSlotCtrl', [])
    .controller('rotaSlotController', function($scope, $http, RotaSlot) {

        $scope.commentData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        RotaSlot.get()
            .success(function(data) {
                $scope.rotaSlots = data;
                $scope.loading = false;
            });
    });