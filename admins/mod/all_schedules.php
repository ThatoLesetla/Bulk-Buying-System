    <!-- Modal Structure -->

    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content center-xs">
            <h1><i class="fa fa-bus" style="font-size: 6rem; padding-top: 80px;"></i></h1>
            <div class="container">
                <h4>Update Schedule</h4>
                <div class="row">
                    <div class="col s6">
                        <div class="input-field">
                            <span name="bus" id="update_bus">
                                <?php include('../connect.php');
                                include('avail_buses.php'); ?>
                            </span>
                            <label for="bus" class="active">Bus</label>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="input-field">
                            <span name="driver" id="update_driver">
                                <?php include('avail_drivers.php'); ?>
                            </span>
                            <label for="driver" class="active">Driver</label>
                        </div>
                    </div>
                </div>
            </div>
            <p id="mod_driver" hidden></p>
            <p id="mod_bus" hidden></p>
            <p id="mod_id" hidden></p>
        </div>
        <div class="modal-footer">
            <a onclick="update_schedule()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Update</a>
            <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Disagree</a>
        </div>
    </div>


    <table class="highlight">
        <thead>
            <tr>
                <th>Date</th>
                <th>Hour</th>
                <th>Bus</th>
                <th>Driver</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Update/Unschedule</th>
            </tr>
        </thead>

        <tbody>
            <?php

            session_start();
            $errors = array();
            include('../connect.php');
            
           
            

            if (empty($_POST['dater'])) {
                $query = "SELECT * FROM schedule";
            } else {
                $dater=$_POST['dater'];
                $query = "SELECT * FROM schedule WHERE `schedule_date` = '$dater'";
            }


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
                <td>
                    <button class="btn blue lighten-2 waves-effect waves-dark" onclick="edit_schedule('<?php echo ($driver); ?>', '<?php echo ($bus); ?>','<?php echo ($scheduleID); ?>');" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px">Edit</button>
                    <button class="btn red lighten-2 waves-effect waves-dark" onclick="delete_schedule('<?php echo ($driver); ?>', '<?php echo ($bus); ?>','<?php echo ($scheduleID); ?>');" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px">Remove</button>
                </td>
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