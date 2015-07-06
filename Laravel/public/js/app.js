var commentApp = angular.module('commentApp', ['mainCtrl', 'commentService']);

var rotaSlotApp = angular.module('rotaSlotApp', ['rotaSlotCtrl', 'rotaSlotService']);

(function() {

    'use strict';

    angular
        .module('timeTracker', [
            'ngResource',
            'ui.bootstrap'
        ]);

})();
