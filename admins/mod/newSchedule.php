<div class="row">
    <div class="col s12">
        <div class="col s12">
            <div class="input-field">
                <div class="select">
                    <select name="time" id="time" class="browser-default">
                        <option value="6">06H00</option>
                        <option value="7">07H00</option>
                        <option value="8">08H00</option>
                        <option value="9">09H00</option>
                        <option value="10">10H00</option>
                        <option value="11">11H00</option>
                        <option value="12">12H00</option>
                        <option value="13">13H00</option>
                        <option value="14">14H00</option>
                        <option value="15">15H00</option>
                        <option value="16">16H00</option>
                        <option value="17">17H00</option>
                        <option value="18">18H00</option>
                        <option value="19">19H00</option>
                        <option value="20">20H00</option>
                        <option value="21">21H00</option>
                    </select>
                </div>
                <label for="time" class="active">Time</label>
            </div>
        </div>

        <div class="col s12">
            <div class="input-field">
                <span name="bus" id="bus">
                    <?php include('../connect.php');
                    include('avail_buses.php'); ?>
                </span>
                <label for="bus" class="active">Bus</label>
            </div>
        </div>

        <div class="col s12">
            <div class="input-field">
                <span name="driver" id="driver">
                    <?php include('avail_drivers.php'); ?>
                </span>
                <label for="driver" class="active">Driver</label>
            </div>
        </div>

        <div class="col s12">
            <div class="input-field">
                <span name="from" id="from">
                    <?php include('avail_loc.php'); ?>
                </span>
                <label for="from" class="active">Departure</label>
            </div>
        </div>

        <div class="col s12">
            <div class="input-field">
                <span name="to" id="to">
                    <?php include('avail_loc.php'); ?>
                </span>
                <label for="to" class="active">Destination</label>
            </div>
        </div>
        <div class="col s12">
            <div class="input-field">
                <button id="schedule_btn" class=" col s12 btn blue lighten-2 waves-effect waves-dark round-btn">Add Schedule</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div id="output">
    </div>
</div>

<script src="script/schedule.js"></script> 