angular.module('rotaSlotCtrl', [])

// inject the Comment service into our controller
    .controller('rotaSlotController', function($scope, $http, RotaSlot) {
        // object to hold all the data for the new comment form
        $scope.commentData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        // use the function we created in our service
        // GET ALL COMMENTS ==============
        RotaSlot.get()
            .success(function(data) {
                $scope.rotaSlots = data;
                $scope.loading = false;
                console.log($scope);
            });

        // function to handle submitting the form
        // SAVE A COMMENT ================

    });