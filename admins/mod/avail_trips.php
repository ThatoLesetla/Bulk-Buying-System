<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content center-xs">
        <h1><i class="fa fa-calendar-plus-o" style="font-size: 6rem; padding-top: 80px;"></i></h1>
        <h4>You are about to Book</h4>
        <p>Are you sure you want to book this bus?</p>
        <p id="id" hidden></p>
        <p id="bus" hidden></p>
        <p id="timer" hidden></p>
    </div>
    <div class="modal-footer">
        <a onclick="book()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Agree</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Disagree</a>
    </div>
</div>


<div class="col s12">
    <span id="respond"></span>
    <ul class="collection">
        <?php

        session_start();

        include('../connect.php');

        $from = $_POST['depart'];
        $to = $_POST['dest'];
        $timer = $_POST['time'];
        $today = date('d-m-Y');

        if (!empty($from) && !empty($to)) {
            if ($from == $to) {
                $query = "SELECT * FROM schedule WHERE `schedule_date` = '$today'";
            } else {
                $query  = "SELECT * FROM schedule WHERE (`from` = '$from' AND `to` = '$to') AND `schedule_date` = '$today'";
            }
        } else {
            $query = "SELECT * FROM schedule WHERE `schedule_date` = '$today'";
        }


        $result = mysqli_query($db, $query);

        if ($result) :

            while ($row = mysqli_fetch_array($result)) :

                $id = $_SESSION['studentID'];
                $bus = $row['bus'];
                $time = $row['time'];

                $query2 = "SELECT * FROM booking WHERE `bus` = '$bus' AND `time` = '$time ' AND `book_date` = '$today'";
                $result2 = mysqli_query($db, $query2);

                $bookings = mysqli_num_rows($result2);


                if ($row['time'] > $timer) {
                    $style = "#28ba00";
                    $enable_book = "mod('{$id}', '{$bus}', '{$time}');";
                    $time_class = "Leaves at ";
                } else {
                    $style = "#898989";
                    $enable_book = "alert('Bus Already Left');";
                    $time_class = "Left at ";
                }

                $bookings_rate = floor(($bookings / $row['occupance'] * 100));

                if (strlen($row['time']) == 1) {
                    $raw_time = "0" . $row['time'] . "H00";
                } else {
                    $raw_time = $row['time'] . "H00";
                }

                if ($bookings == $row['occupance']) {
                    $style = "#ff0000";
                    $enable_book = "alert('Bus is Fully Booked for {$raw_time}');";
                }

                ?>
        <a href="#!" class="collection-item avatar" style="cursor: pointer; border-left: thick <?php echo ($style); ?> solid;" onclick="<?php echo ($enable_book); ?>">
            <li class="grey-text text-darken-4 start-md end-xs middle-xs" style="cursor: pointer;">
                <img src="images/public.png" class="circle">
                <span class="title"><b><?php echo ($row['bus']); ?></b></span>
                <p class="grey-text"><i><?php echo ($time_class . $raw_time); ?></i></p>
                <p><i class="grey-text" style="font-size: 8pt;">From: <?php echo ($row['from']); ?> | To: <?php echo ($row['to']); ?></i></p>
                <p><?php echo ($bookings); ?> / <?php echo ($row['occupance']); ?> Bookings</p>
                <div class="progress grey lighten-3">
                    <div class="determinate blue lighten-2" style="width: <?php echo ($bookings_rate); ?>%"></div>
                </div>
            </li>
        </a>
        <?php endwhile ?>
        <?php endif ?>
    </ul>
</div>

<script>
    //Init Modal
    $('.modal').modal();

    function mod(id, bus, time) {
        $('#modal1').modal('open');
        $('#id').html(id);
        $('#bus').html(bus);
        $('#timer').html(time);
    };

    function book() {

        var id = $('#id').html();
        var bus = $('#bus').html();
        var time = $('#timer').html();

        $.ajax({
            type: "post",
            url: "save_booking.php",
            data: {
                id: id,
                bus: bus,
                time: time
            },
            success: function(response) {
                $('#respond').html(response)
            }
        });
    }
</script> 