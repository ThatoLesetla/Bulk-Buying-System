<?php

session_start();

if (empty($_SESSION['studentID'])) {
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a class="brand-logo"><img src="images/logo.png" alt="" style="width: 150px;"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="index.php"><i class="fa fa-bullseye"></i> Make Bookings</a></li>
                    <li><a href="show_bookings.php"><i class="fa fa-map-o"></i> My Bookings</a></li>
                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                    <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                    <li><a href="badges.html"><i class="fa fa-info-circle  "></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row center-xs">
            <div class="col s12 m6 pull-m3">
                <span id="today">
                    <h4 id="time"></h4>
                    <div class="divider"></div>
                    <h6 id="day" class="grey-text"></h6>
                </span>
            </div>
        </div>
    </div>
    <div class="form pushed_top">
        <div class="container">
            <h4>Notice</h4>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12">
                    <span id="all-notices"></span>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>

    <script>
        $(document).ready(function() {

            //Init Modal
            $('.modal').modal();

            $('#search_btn').click(function() {
                get_bookings();
            });

            function all_notices() {
                $.ajax({
                    type: "post",
                    url: "mod/all_notices.php",
                    success: function(response) {
                        $('#all-notices').html(response);
                    }
                });
            };

            all_notices();

            function addZero(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }

            setInterval(() => {
                var d = new Date();
                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var days = ["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"];

                var h = addZero(d.getHours());
                var m = addZero(d.getMinutes());
                var s = addZero(d.getSeconds());

                time = h + ":" + m + "." + s

                var day = "<b>" + days[d.getDay()] + "</b> - " + d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
                $('#time').html(time);
                $('#day').html(day);
            }, 1000);
        });
    </script>
</body>

</html> 