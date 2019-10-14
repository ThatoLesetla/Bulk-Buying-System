<h4>New Notice</h4>

<div class="divider"></div>
<div class="row middle-xs">
    <div class="col m12">
        <div class="input-field">
            <span id="result"></span>
        </div>
    </div>
    <div class="col s12 m3">
        <div class="input-field">
            <div class="select">
                <select name="to" id="to" class="browser-default">
                    <option value="1">staff Members</option>
                    <option value="2">Students</option>
                    <option value="3">All</option>
                </select>
            </div>
            <label for="to" class="active">Recepient</label>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="input-field">
            <textarea id="textarea" name="subjects" class="materialize-textarea"></textarea>
            <label for="subjects">Message</label>
        </div>
    </div>
    <div class="col m3">
        <button class="btn waves-effect waves-dark round-btn blue lighten-2" id="btn-send"><i class="fa fa-paper-plane"></i> Send</button>
    </div>
</div>

<div class="row">
    <h5>All Notices</h5>
    <div class="col s12">
        <span id="all-notices"></span>
    </div>
</div>


<script>
    $('#btn-send').click(function() {
        var to = $('#to').val();
        var message = $('#textarea').val();

        $.ajax({
            type: "post",
            url: "saveNotice.php",
            data: {
                to: to,
                message: message
            },
            success: function(response) {
                $('#result').html(response);
            }
        });
    });

    function all_notices() {
        $.ajax({
            type: "post",
            url: "mod/adim_notices.php",
            success: function(response) {
                $('#all-notices').html(response);
            }
        });
    }

    all_notices();
</script> 