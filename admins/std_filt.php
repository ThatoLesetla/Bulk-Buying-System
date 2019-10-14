<table class="highlight">

        <tbody>
            <?php

            $errors = array();
            include('connect.php');

            $v_date = $_POST['v_dater'];
            $v_bus = $_POST['v_bus'];
            $v_id = $_POST['v_id'];

            if (empty($v_date) && empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM student";
            } elseif (!empty($v_date) && empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM student WHERE `passW` LIKE '%$v_date'";

            } elseif (empty($v_date) && !empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM student WHERE `sname` LIKE '%$v_bus%'";

            } elseif (empty($v_date) && empty($v_bus) && !empty($v_id)) {
                $query = "SELECT * FROM student WHERE `studentID` LIKE '%$v_id'";

            } elseif (!empty($v_date) && !empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM student WHERE (`passW` LIKE '%$v_date') AND (`sname` LIKE '%$v_bus%')";

            } elseif (!empty($v_date) && empty($v_bus) && !empty($v_id)) {

                $query = "SELECT * FROM student WHERE (`passW` LIKE '%$v_date') AND (`studentID` LIKE '%$v_id')";
            } elseif (empty($v_date) && !empty($v_bus) && !empty($v_id))
             {
                $query = "SELECT * FROM student WHERE (`sname` LIKE '%$v_bus%') AND (`studentID` LIKE '%$v_id')";
            } elseif (!empty($v_date) && !empty($v_bus) && !empty($v_id))
             {
                $query = "SELECT * FROM student WHERE (`passW` LIKE '%$v_date') AND (`sname` LIKE '%$v_bus%') AND (`studentID` LIKE '%$v_id')";
            }

            $result = mysqli_query($db, $query);

            if ($result) :

                if (mysqli_num_rows($result) == 0) {
                    echo ('<h4>No students Found');
                }


                <?php while ($row = mysqli_fetch_array($result)) : ?>
                <?php
                if (empty($row['passW'])) {
                    $bg = "white";
                    $user = "No";
                } else {
                    $bg = "grey lighten-4";
                    $user = "Yes";
                }
                ?>
                <tbody>
                    <tr class="<?php echo ($bg); ?>">
                        <td id="studentID"><?php echo ($row['studentID']); ?></td>
                        <td id="sname"><?php echo ($row['sname']); ?></td>
                        <td id="name"><?php echo ($row['name']); ?></td>
                        <td id="user"><?php echo ($user); ?></td>
                        <td><button onclick="studentDelete('<?php echo ($row['studentID']); ?>')" class="btn red lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user-times"></i> Delete</button></td>
                        <td><button onclick="v_profile('<?php echo ($row['studentID']); ?>')" class="btn blue lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user"></i> More Info</button></td>
                    </tr>
           
            <?php 
        } ?>
            <?php endif ?>

        </tbody>
    </table>
    <span id="result"></span>

    <script type="text/javascript">
        $('.modal').modal();

       
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