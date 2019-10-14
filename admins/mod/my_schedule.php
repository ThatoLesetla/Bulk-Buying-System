<?php

session_start();

if (empty($_SESSION['driverID'])) {
    header('location: ../adm_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
    <link rel="stylesheet" type="text/css" href="../css/flexboxgrid.css" />
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/Style.css">
</head>

<body>

    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content center-xs">
            <h4>Verify The User</h4>
            <h1><i class="fa fa-calendar-plus-o" style="font-size: 6rem; padding-top: 80px;"></i></h1>
            <p>Are you sure you want to book this bus?</p>
            <p id="id" hidden></p>
            <p id="bus" hidden></p>
            <p id="timer" hidden></p>
        </div>

        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
        </div>
    </div>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="index.php" class="brand-logo"><img src="../images/logo.png" alt="" style="width: 150px;"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="verify.php"><i class="fa fa-angle-double-left"></i> Back</a></li>
                    <li><a href="../staff_notices.php">Noticeboard</a></li>
                    <li><a href="../logout_adm.php"><i class="fa fa-power-off"></i> Logout</a></li>
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



    <div class="cam_section">
        <div class="container">
            <h4>My Schedules</h4>
            <div class="divider"></div>
            <div class="row center-xs middle-xs">
                <div class="col s12">
                    <div class="divider"></div>
                    <div class="col s12">
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Hour</th>
                                    <th>Bus</th>
                                    <th>Driver</th>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $errors = array();
                                include('../connect.php');
                                $id = $_SESSION['driverID'];
                                $today = date('d-m-Y');

                                $query = "SELECT * FROM schedule WHERE `driver` = '$id' AND `schedule_date` >= '$today' ORDER BY `schedule_date` ASC";



                                $result = mysqli_query($db, $query);

                                if ($result) :

                                    if (mysqli_num_rows($result) == 0) {
                                        echo ('<h4>No Schedules Found');
                                    }


                                    while ($row = mysqli_fetch_array($result)) {

                                        $driver = $row['driver'];

                                        $query1 = "SELECT * FROM driver WHERE `driverID` = '$driver'";
                                        $result1 = mysqli_query($db, $query1);

                                        if ($result1) {

                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $name = $row1['sname'] . ' ' . $row1['name'];
                                                $raw_time = $row['time'];
                                                $bus = $row['bus'];
                                                $scheduleID = $row['scheduleID'];
                                            }

                                            if (strlen($raw_time) == 1) {
                                                $time = "0" . $raw_time . "H00";
                                            } else {
                                                $time = $raw_time . "H00";
                                            }
                                        }
                                        ?>
                                <tr id="<?php echo ($scheduleID); ?>">
                                    <td><b><?php echo ($row['schedule_date']); ?><b></td>
                                    <td><?php echo ($time); ?></td>
                                    <td><?php echo ($bus); ?></td>
                                    <td><?php echo ($name); ?></td>
                                    <td><?php echo ($row['from']); ?></td>
                                    <td><?php echo ($row['to']); ?></td>
                                </tr>
                                <?php 
                            } ?>
                                <?php endif ?>

                            </tbody>
                        </table>
                        <span id="result"></span>

                        <script type="text/javascript">
                            $('.modal').modal();


                            function delete_schedule(driver, bus, id) {

                                var dater = $('#dater').val();

                                var dlt_q = confirm("Are you sure you want to delete schedule?");

                                if (dlt_q == true) {
                                    $.ajax({
                                        type: "post",
                                        url: "mod/unschedule.php",
                                        data: {
                                            dater: dater,
                                            id: id,
                                            driver: driver,
                                            bus: bus
                                        },
                                        success: function(response) {
                                            $("#" + id).remove();
                                            $('#result').html(response);
                                        }
                                    });
                                }
                            };


                            function edit_schedule(driver, bus, id) {
                                $('#modal1').modal('open');

                                $('#mod_driver').html(driver);
                                $('#mod_bus').html(bus);
                                $('#mod_id').html(id);
                            }

                            function update_schedule() {
                                var driver = $('#mod_driver').html();
                                var bus = $('#mod_bus').html();
                                var id = $('#mod_id').html();

                                var update_driver = $('#update_driver select').val();
                                var update_bus = $('#update_bus select').val();

                                $.ajax({
                                    type: "post",
                                    url: "update_schedule.php",
                                    data: {
                                        driver: driver,
                                        bus: bus,
                                        id: id,
                                        update_driver: update_driver,
                                        update_bus: update_bus
                                    },
                                    success: function(response) {
                                        $('#result').html(response);
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script type="text/javascript" src="../script/jquery.min.js"></script>
        <script type="text/javascript" src="../script/materialize.min.js"></script>

        <script type="module">
            import QrScanner from "../script/qr-scanner.min.js";
        QrScanner.WORKER_PATH = '../script/qr-scanner-worker.min.js';

        const video = document.getElementById('qr-video');
        const camHasCamera = document.getElementById('cam-has-camera');
        const camQrResult = document.getElementById('cam-qr-result');
        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
        const fileSelector = document.getElementById('file-selector');
        const fileQrResult = document.getElementById('file-qr-result');
    

        function setResult(label, result) 
        {
            label.textContent = result;
            camQrResultTimestamp.textContent = new Date().toString();
            label.style.color = 'teal';
            clearTimeout(label.highlightTimeout);
            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        
        }

        // ####### Web Cam Scanning #######

        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

        const scanner = new QrScanner(video, result => setResult(camQrResult, result));
        
        scanner.start();
        
        

        document.getElementById('inversion-mode-select').addEventListener('change', event => {
            scanner.setInversionMode(event.target.value);
        });

        // ####### File Scanning #######

        fileSelector.addEventListener('change', event => {
            const file = fileSelector.files[0];
            if (!file) {
                return;
            }
            QrScanner.scanImage(file)
                .then(result => setResult(fileQrResult, result))
                .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
        });

    </script>
        <script>
            $(document).ready(function() {

                //Init Modal
                $('.modal').modal();

                function addZero(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }

                //QR Scan

                function scan() {
                    var qrdata = $('#cam-qr-result').html();
                    var bus = $('#bus select').val();
                    var time = $('#time select').val();

                    if (qrdata != "empty") {
                        $.ajax({
                            type: "post",
                            url: "scan_qr.php",
                            data: {
                                qrdata: qrdata,
                                bus: bus,
                                time: time
                            },
                            success: function(response) {
                                $('#cam-qr-result').html(response);
                            }
                        });
                    }
                }

                function all_notices() {
                    $.ajax({
                        type: "post",
                        url: "all_notices.php",
                        success: function(response) {
                            $('#all-notices').html(response);
                        }
                    });
                };

                $('#btn-all-notices').click(function(e) {
                    e.preventDefault();
                    all_notices();
                    $('#modal1').modal('open');
                });

                setInterval(() => {
                    scan();
                }, 1000);

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