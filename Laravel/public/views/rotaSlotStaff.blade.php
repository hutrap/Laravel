<!doctype html> <html lang="en"> <head> <meta charset="UTF-8"> <title>Laravel and Angular Comment System</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
    <style>
        body        { padding-top:30px; }
        form        { padding-bottom:20px; }
        .comment    { padding-bottom:20px; }
    </style>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="../js/controllers/rotaSlotCtrl.js"></script> <!-- load our controller -->
    <script src="../js/services/rotaSlotService.js"></script> <!-- load our service -->
    <script src="../js/app.js"></script> <!-- load our application -->
</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="rotaSlotApp" ng-controller="rotaSlotController">

<div class="col-md-8 col-md-offset-2">

    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

    <!-- THE COMMENTS =============================================== -->
    <!-- hide these comments if the loading variable is true -->
    <table class="table table-striped table-hover" width="100%">
        <tr>
            <th rowspan="2">Staff Id</th><th colspan="7">Days</td><th rowspan="2">Total hours</th>
        </tr>

        <tr>
            <th>0</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th>
        </tr>
        <tr  ng-repeat="(staff_id, days) in rotaSlots.main">
            <td>@{{ staff_id  }}</td>
            <td ng-repeat="(day, day_data) in days.days" >
                @{{ day_data.start_time }} @{{ day_data.end_time }}
            </td>
            <td>
                @{{days.total_hours}}
            </td>
        </tr>

        <tr>
            <td>Total:</td>
            <td ng-repeat="(day, total) in rotaSlots.per_day" >
                @{{ total}}
            </td>
            <td>
                @{{days.total_hours}}
            </td>
            <td></td>
        </tr>
        <tr>
            <th colspan="9">Work alone</th>
        </tr>
        <tr  ng-repeat="(staff_id, days) in rotaSlots.work_alone">
            <td>@{{ staff_id  }}</td>
            <td>@{{ days.0.start_time }} @{{ days.0.end_time }}</td>
            <td>@{{ days.1.start_time }} @{{ days.1.end_time }}</td>
            <td>@{{ days.2.start_time }} @{{ days.2.end_time }}</td>
            <td>@{{ days.3.start_time }} @{{ days.3.end_time }}</td>
            <td>@{{ days.4.start_time }} @{{ days.4.end_time }}</td>
            <td>@{{ days.5.start_time }} @{{ days.5.end_time }}</td>
            <td>@{{ days.6.start_time }} @{{ days.6.end_time }}</td>
            <td>@{{ days.total/60 | number:2 }}</td>
        </tr>
    </table>
</div>
</body>
</html>