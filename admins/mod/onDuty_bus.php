<h4>Buses On Duty</h4>

<div class="row">
    <span id="result"></span>
</div>
<div class="row">
    <div class="collection col m12">
        <?php 
        session_start();
        include('../connect.php');

        $query = "SELECT * FROM bus WHERE `onDuty` = '1'";
        $result = mysqli_query($db, $query);

        if ($result)  :

        while ($row = mysqli_fetch_array($result)) : ?>
        <a class="collection-item grey-text text-darken-4" id="<?php echo ($row['regNo']) ?>">
            <h5><i class="fa fa-circle green-text"></i> <?php echo ($row['regNo']) ?> | <?php echo ($row['occupance']) ?> Seater<span onclick="bus_logout('<?php echo ($row['regNo']) ?>');" class="secondary-content grey-text text-darken-4" style="cursor: pointer;" data-id="<?php echo ($row['regNo']) ?>"></span></h5>
        </a>
        <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<script>
    function bus_logout(id) {
        

        $.ajax({
            type: "post",
            url: "load/bus_logout.php",
            data: {
                id: id
            },
            success: function(response) {
                $("#" + id).addClass('active');;
                $('#result').html(response);
            }
        });
    }
</script> 