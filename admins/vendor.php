<?php

include('connect.php');

$query = "SELECT * FROM vendor ORDER BY `name` ASC";
$result = mysqli_query($db, $query);


if ($result) :


    ?>



  
    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn" id="btn_sammury">View Sammury</button>
    <br><br>
    <table class="bordered" id="std_table">
        <thead class="grey darken-4 white-text" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
            <tr>
                <th>Vendor Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Delete</th>
                <th>Profile</th>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($result)) : ?>
            <?php
            if (empty($row['password'])) {
                $bg = "white";
                $user = "No";
            } else {
                $bg = "grey lighten-4";
                $user = "Yes";
            }
            ?>
            <tbody>
                <tr class="<?php echo ($bg); ?>">
                    <td id="studentID"><?php echo ($row['name']); ?></td>
                    <td id="sname"><?php echo ($row['address']); ?></td>
                    <td id="name"><?php echo ($row['city']); ?></td>
                    <td id="name"><?php echo ($row['phone']); ?></td>
                    <td id="name"><?php echo ($row['email']); ?></td>
                    <td><button onclick="studentDelete('<?php echo ($row['vendorID']); ?>')" class="btn red lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user-times"></i> Delete</button></td>
                    <td><button onclick="v_profile('<?php echo ($row['vendorID']); ?>')" class="btn blue lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user"></i> More Info</button></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>

<?php else : ?>

    <?php //unset($_SESSION['studentID']);
    //echo ('<script>window.location.assign("error.php");</script>'); 
    
    echo("wrong");
    ?>

<?php endif ?>

<span id="result"></span>

<script>
    function v_profile(userID) {
        $.ajax({
            type: "post",
            url: "vendor_profile.php",
            data: {
                userID: userID
            },
            success: function(response) {
                $('.modal').modal('open');
                $('#mod_content').html(response);
            }
        });
    }

    function studentDelete(id) {
        var dlt_q = confirm("Are you sure you want to delete vendor ?");

        if (dlt_q == true) {

            $.ajax({

                type: "post",
                url: "deleteStudent.php",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#" + id).remove();
                    $('#result').html(response);
                }
            });
        }
    }

    $('#btn_new_student').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "mod/add_student.php",
            success: function(response) {
                $('#mod_content').html(response);
                $('#adm_mod').modal('open');
            }
        });
    });

    $('#btn_sammury').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "studentSammury.php",
            success: function(response) {
                $('#mod_content').html(response);
                $('#adm_mod').modal('open');
            }
        });
    });

</script>