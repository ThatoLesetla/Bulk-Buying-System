<div class="divider"></div>
<div class="col s12">
    <div class="row">
        <div class="col s6">
            <div class="input-field">
                <input type="text" name="dater" id="dater" class="datepicker">
                <label for="dater">Select Date</label>
            </div>
        </div>
        <div class="col s6">
            <div class="input-field">
                <button id="btn-v-schedule" class="btn blue lighten-2 waves-effect waves-dark round-btn">Add Schedule</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <span id="table_content"></span>
    </div>
</div>

<script>
    $(document).ready(function() {
        //Init Date picker
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });

        function schedules() {
            var dater = $('#dater').val();
            
            $.ajax({
                type: "post",
                url: "mod/all_schedules.php",
                data: {
                    dater: dater
                },
                success: function(response) {
                    $('#table_content').html(response);
                }
            });
        }

        schedules();

        $('#btn-v-schedule').click(function() {
            var dater = $('#dater').val();

            if (dater == "") {
                alert("Please Select Date");
                $('.datepicker').datepicker('open');
            } else {
                $.ajax({
                    url: "mod/newSchedule.php",
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#adm_mod').modal('open');
                    }
                });
            }
        });

        $('#dater').change(function (e) { 
            e.preventDefault();
            schedules();
        });
    });
</script> 