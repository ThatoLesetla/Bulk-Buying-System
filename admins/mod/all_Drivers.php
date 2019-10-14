<h4>Staff</h4>
<div class="row">
    <ul class="collection col m12">

        <?php

        session_start();
        $errors = array();
        include('../connect.php');
        $userID = $_SESSION['userID'];

        $query = "SELECT * FROM driver WHERE `passW` <> '' AND `driverID` <> '$userID' AND (`role` = '1' OR `role` = '2') AND `deleted` = '0'";
        $result = mysqli_query($db, $query);



        if (mysqli_num_rows($result) == 0) 
        {
            
                echo ('<h4>No drivers Found');

        }

        if ($result) :

            while ($row = mysqli_fetch_array($result)) {

                if ($row['active'] == 0) {
                    $status = "grey-text";
                } else {
                    $status = "green-text";
                }

                if ($row['role'] == 1) {
                    $role = "Admin";
                    $id = $row['adminID'];

                } elseif ($row['role'] == 2) {
                    $role = "Driver";
                    $id = $row['driverID'];

                }

                ?>
        <li id="<?php echo ($id) ?>" class="collection-item">
            <a style="cursor:pointer;" class="grey-text text-darken-4" title="Click to See Profile" onclick="v_profile(<?php echo ($id); ?>);">
                <h5><i class="fa fa-circle <?php echo ($status); ?>"></i>
                    <?php echo ($id); ?> |
                    <?php echo ($row['sname'] . ' ' . $row['name']); ?> |
                    <b class="blue-text text-lighten"> <?php echo ($role); ?></b>
                    <a class="secondary-content" onclick="delete_staff('<?php echo ($id); ?>');"><i class="fa fa-minus-circle"></i></a>
                </h5>
            </a>
        </li>
        <?php 
    } ?>

        <?php endif ?>
    </ul>

</div>
<div id="result"></div>

<script>
    function delete_staff(idno) {
        var dlt_q = confirm("Are you sure you want to delete staff "+ idno+" ?");

            if (dlt_q == true) {
        $.ajax({
            type: "post",
            url: "delete_staff.php",
            data: {
                idno: idno
            },
            success: function(response) {
                $("#" + idno).remove();
                $('#result').html(response);
            }
        });
            }
    }

    function v_profile(userID) {
        $.ajax({
            type: "post",
            url: "user_profile.php",
            data: {
                userID: userID
            },
            success: function(response) {
                $('.modal').modal('open');
                $('#mod_content').html(response);
            }
        });
    }
</script> 