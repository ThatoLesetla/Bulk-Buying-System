<h4>Busses</h4>

<div class="row">
    <ul class="collection col m12">

        <?php

        session_start();
        $errors = array();
        include('../connect.php');

        $query = "SELECT * FROM bus WHERE `deleted` <> '1'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 0) {
            echo ('<h4>No staff Buses Found');
        }


        while ($row = mysqli_fetch_array($result)) {

            if ($row['onDuty'] == 0) {
                $status = "grey-text";
            } else {
                $status = "green-text";
            }

            $id = $row['regNo'];
            ?>
        <li id="<?php echo ($row['busID']) ?>" class="collection-item grey-text text-darken-4">
            <h5><i class="fa fa-circle <?php echo ($status); ?>"></i>
                <?php echo ($row['regNo']); ?> |
                <?php echo ($row['occupance']); ?> Seater
                <a class="secondary-content" onclick="delete_bus('<?php echo ($id); ?>', '<?php echo ($row['busID']); ?>');"><i class="fa fa-minus-circle"></i></a>
            </h5>
        </li>
        <?php 
    } ?>
    </ul>

</div>
<div id="result"></div>

<script>
    function delete_bus(regNo, busID) {
        var dlt_q = confirm("Are you sure you want to delete bus "+ regNo+" ?");

            if (dlt_q == true){
                $.ajax({
                    type: "post",
                    url: "delete_bus.php",
                    data: {
                        regNo: regNo
                    },
                    success: function(response) {
                        $("#" + busID).remove();
                        $('#result').html(response);
                    }
                });
            }
    }
</script> 