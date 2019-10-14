<?php

$day = date("d");
$month = date("F");
$year = date("Y");
$date_full = date("d F Y");
?>

<div class="container">
    <h4 class="valign-wrapper">Date Scheduler</h4>
    <div class="divider"></div>
    <div class="row middle-xs">
        <form action="" method="post" class="col m12">
            <div class="input-field">
                <h5>Today: <span><?php echo ($date_full) ?></span></h5>
            </div>
            <div class="row">
                <div class="input-field">
                    <input type="text" name="" id="" class="datepicker">
                </div>
            </div>

            <div id="output"></div>

            <div class="input-field">
                <a href="#!" class="modal-action modal-close btn grey darken-4 waves-effect waves-blue round-btn" style="border: #909090 thin solid;"><i class="fa fa-close"></i> Cancel</a>
                <button name="btn-select-date" id="btn-select-date" class="btn blue lighten-2 waves-effect waves-dark round-btn">Select Date</button>
            </div>
        </form>
    </div>



</div>

<script>

    $('#btn_save_staff').click(function(e) {
        e.preventDefault();

        var idno = $('#idno').val();
        var surname = $('#surname').val();
        var name = $('#name').val();
        var role = $('#role').val();

        $.ajax({
            type: "post",
            url: "save_staff.php",
            data: {
                idno: idno,
                surname: surname,
                name: name,
                role: role
            },
            success: function(response) {
                $('#output').html(response);
            }
        });

    });
</script> 