(function() {

    'use strict';

    angular
        .module('timeTracker')
        .controller('TimeEntry', TimeEntry);

    function TimeEntry(time) {

        // vm is our capture variable
        var vm = this;

        vm.timeentries = [];

    }
})();