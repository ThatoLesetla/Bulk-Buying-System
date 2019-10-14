<?php

include('connect.php');

$userID = $_POST['userID'];

$query = "SELECT * FROM vendor WHERE `vendorID` = '$userID'";
$result = mysqli_query($db, $query);


//Get Gender
function getGender($identity)
{
    $gender = (int)substr($identity, 6, 1);

    return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
}

function getAge($identity)
{
    $currentYear = date('Y');
    $dob = (int)substr($identity, 0, 2);

    $cent_age = $currentYear - $dob;

    $age = (int)substr($cent_age, 2, 2);

    return $age . " Years";
}


while ($row = mysqli_fetch_array($result)) :
    ?>
    <div class="container" id="printable">
        <div class="row">
            <div class="col s12">
                <h4><?php echo ($row['name']); ?></h4>
                <div class="divider"></div>
                <p>City: <?php echo ($row['city']); ?></p>
                <p>Address: <?php echo ($row['address']); ?></p>
                <p>email: <?php echo ($row['email']); ?></p>
                <p>Contact Number: <?php echo ($row['phone']); ?></p>
            </div>
            <div class="input-field">
                <a href="" class="modal-action modal-close btn grey darken-4 waves-effect waves-green" style="border: #909090 thin solid;"><i class="fa fa-check"></i> OK</a>
                <a href="" id="btn_print" class="modal-action modal-close btn lighten-2 waves-effect waves-blue" ><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </div>
<?php endwhile ?>

<script>
    $('#btn_print').click(function(e) {
        e.preventDefault();
        var mode = 'iframe';
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };

        $('#printable').printArea(options);
    });
</script>