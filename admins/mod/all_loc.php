<h4>Locations</h4>
<div class="row">
    <ul class="collection col m12">

        <?php

        session_start();
        $errors = array();
        include('../connect.php');

        $query = "SELECT * FROM `location`";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 0) {
            echo ('<h4>No Staff Locations Found');
        }

        if ($result) :

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['location'];
            ?>
        <li id="<?php echo ($row['locID']) ?>" class="collection-item grey-text text-darken-4">
            <h5><i class="fa fa-circle green-text"></i>
                <?php echo ($row['location']); ?>
                <a class="secondary-content" onclick="delete_loc('<?php echo ($row['location']); ?>', '<?php echo ($row['locID']) ?>');"><i class="fa fa-minus-circle"></i></a>
            </h5>
        </li>
        <?php 
    } ?>
    <?php endif ?>
    </ul>

</div>
<div id="result"></div>

<script>
    function delete_loc(loc, locID) {
        var dlt_q = confirm("Are you sure you want to delete location "+ loc+" ?");

        if (dlt_q == true){
            $.ajax({
                
                type: "post",
                url: "delete_loc.php",
                data: {
                    loc: loc
                },
                success: function(response) {
                    $("#" + locID).remove();
                    $(' #result').html(response); } 
                }); 
          }
        } 
</script> 