<?php



?>

<div class="container">
    <h4>New Student</h4>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12">
            <div class="input-field">
                <span id="result_1"></span>
            </div>
            <div class="input-field">
                <input type="number" name="idno" id="idno">
                <label for="idno">Identity Number</label>
            </div>
            <div class="input-field">
                <input type="number" name="stdNo" id="stdNo">
                <label for="stdNo">Student Number</label>
            </div>
            <div class="input-field">
                <input type="text" name="sname" id="sname">
                <label for="sname">Surname</label>
            </div>
            <div class="input-field">
                <input type="text" name="name" id="name">
                <label for="name">Full Names</label>
            </div>
            <div class="input-field">
                <a href="#!" class="modal-action modal-close btn grey darken-4 waves-effect waves-blue round-btn" style="border: #909090 thin solid;"><i class="fa fa-close"></i> Cancel</a>
                <button onclick="studentAdd()" class="btn blue lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user-plus"></i> Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    function studentAdd() {
        var idno = $('#idno').val();
        var stdNo = $('#stdNo').val();
        var sname = $('#sname').val();
        var name = $('#name').val();

        $.ajax({
            type: "post",
            url: "studentAdd.php",
            data: {
                idno: idno,
                stdNo: stdNo,
                sname: sname,
                name: name
            },
            success: function(response) {
                $('#result_1').html(response);
            }
        });
    }
</script> 