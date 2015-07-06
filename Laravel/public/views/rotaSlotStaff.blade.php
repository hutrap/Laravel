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
            <th>Id</th>
            <th>Rota id</th>
            <th></td>
        </tr>
        <tr ng-repeat="rotaSlot in rotaSlots">
            <td>@{{ rotaSlot.id  }}</td>
            <td>@{{ rotaSlot.rota_id  }}</td>
        </tr>
    </table>


</div>
</body>
</html>