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
    <span id="show">echo('<script>$show).html(<img src="img/{$row['userID']}.jpg"/>)</script>');</span>
        <div class="modal-content center-xs">
            <h4>Confirmation</h4>
            
            <h1><i class="fa fa-calendar-plus-o" style="font-size: 6rem; padding-top: 80px;"></i></h1>
            <p>confirm student</p>
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
                    <li><a href="my_schedule.php">My Schedules</a></li>
                    <li><a href="../driver_notices.php">Noticeboard</a></li>
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

    <div class="bus_details">
        <div class="container">
            <h4>Bus Details</h4>
            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field">
                        <span id="bus">
                            <?php 
                            include('../connect.php');
                            include('avail_buses.php');
                            ?>
                        </span>
                        <label for="bus" class="active">Bus</label>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="input-field">
                        <div class="select" id="time">
                            <select name="time" class="browser-default">
                                <option value="6">06H00</option>
                                <option value="7">07H00</option>
                                <option values="8">08H00</option>
                                <option value="9">09H00</option>
                                <option value="10">10H00</option>
                                <option value="11">11H00</option>
                                <option value="12">12H00</option>
                                <option value="13">13H00</option>
                                <option value="14">14H00</option>
                                <option value="15">15H00</option>
                                <option value="16">16H00</option>
                                <option value="17">17H00</option>
                                <option value="18">18H00</option>
                                <option value="19">19H00</option>
                                <option value="20">20H00</option>
                                <option value="21">21H00</option>
                            </select>
                        </div>
                        <label for="time" class="active">Time</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cam_section">
        <div class="container">
            <div class="row center-xs middle-xs">
                <div class="col s12 m6">
                    <div class="">
                        <video muted playsinline id="qr-video" class="z-depth-3 round-btn" style="width:100%;"></video>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field">
                        <div class="select">
                            <select id="inversion-mode-select" class="browser-default validate">
                                <option value="original">Scan original (dark QR code on bright background)</option>
                                <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                                <option value="both">Scan both</option>
                            </select>
                            <br>
                        </div>
                        <b>Detected QR code: </b>
                        <span id="cam-qr-result">empty</span>
                        <br>
                        <b>Last detected at: </b>
                        <span id="cam-qr-result-timestamp"></span>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" name="check" id="check" class="btn blue lightn-2 waves-effect waves-dark round-btn push-s2 card col s8">Check Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- img src="images/logo.png" -->
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
   // var qrdata = $('#cam-qr-result').html();
   var dataQ = "mahlomola";
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

