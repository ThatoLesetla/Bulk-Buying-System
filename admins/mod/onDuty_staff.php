<h4>staff On Duty</h4>
<div class="row">
    <span id="result"></span>
</div>
<div class="row">
    <div class="collection col m12">
        <?php 
        session_start();
        include('../connect.php');
        $userID = $_SESSION['adminID'];

        $query = "SELECT * FROM driver WHERE `passW` <> '' AND  (`role` = '1' OR `role` = '2') AND `active` = '1' ";
        $result = mysqli_query($db, $query);

        if ($result) :

        while ($row = mysqli_fetch_array($result)) :
            if ($row['role'] == 1) {
                $role = " Admin ";
            } elseif($row['role'] == 2)
            {
                $role = " Driver ";
            }
            ?>
        <a class="collection-item grey-text text-darken-4">
            <h5><i class ="fa fa-circle green-text"></i> <?php echo ($row['driverID']) ?> | <?php echo ($row['sname'] . ' ' . $row['name']) ?> | <?php echo ($role) ?> <span oncli ck="user_logout(<?php echo ($row['driverID']) ?>);" class="secondary-content grey-text text-darken-4" style="cursor: pointer;" data-id="<?php echo ($row['driverID']) ?>"></span></h5>
        </a>
        <?php endwhile ?>
        <?php endif ?>

        <?php 
       

       $query = "SELECT * FROM administrator WHERE `passW` <> '' AND `adminID` <> '$userID' AND (`role` = '1' OR `role` = '2') AND `active` = '1' ";
       $result = mysqli_query($db, $query);

       if ($result) :

       while ($row = mysqli_fetch_array($result)) :
           if ($row['role'] == 1) {
               $role = " Admin ";
           } elseif($row['role'] == 2)
           {
               $role = " Driver ";
           }
           ?>
       <a class="collection-item grey-text text-darken-4">
           <h5><i class ="fa fa-circle green-text"></i> <?php echo ($row['adminID']) ?> | <?php echo ($row['sname'] . ' ' . $row['name']) ?> | <?php echo ($role) ?> <span oncli ck="user_logout(<?php echo ($row['adminID']) ?>);" class="secondary-content grey-text text-darken-4" style="cursor: pointer;" data-id="<?php echo ($row['adminID']) ?>"></span></h5>
       </a>
       <?php endwhile ?>
       <?php endif ?>
    </div>
</div>

<script>
    function user_logout(id) {
        $.ajax({
            type: "post",
            url: "user_logout.php",
            data: {
                id: id
            },
            success: function(response) {
                // alert('I can Read 2');
                $('#result').html(response);
            }
        });
    }
</script>



<script>
    function user_logout(id) {
        $.ajax({
            type: "post",
            url: "user_logout.php",
            data: {
                id: id
            },
            success: function(response) {
                // alert('I can Read 2');
                $('#result').html(response);
            }
        });
    }
</script>