$('#schedule_btn').click(function () {
    var dater = $('#dater').val();
    var id = $('#time').val();
    var bus = $('#bus select').val();
    var driver = $('#driver select').val();
    var loc = $('#from select').val();
    var loc2 = $('#to select').val();

    $.ajax({
        type: "post",
        url: "save_schedule.php",
        data: {
            dater: dater,
            id: id,
            bus: bus,
            driver: driver,
            loc: loc,
            loc2: loc2
        },
        success: function (response) {
            $('#output').html(response);
        }
    })

});


