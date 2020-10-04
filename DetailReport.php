<?php
session_start();

include 'connect.php';
$errors = array();
$id = '';
if (empty($_SESSION['phone'])) {
    unset($_SESSION['phone']);
    session_abort();
    header('location: login.php');
} else {
    $cell = $_SESSION['phone'];
    $name = ' ';
    $surname = ' ';

    $query = "SELECT * FROM vendor WHERE `email` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $surname = $row['surname'];
                $id = $row['vendorID'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineStore</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="script/dataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<style>
    #photo {
        border-bottom: 2.5px solid #fcf9f2 !important;
    }

    #name {
        border-bottom: 2.5px solid #ea454b !important;

    }

    #price {
        border-bottom: 2.5px solid #ea454b !important;

    }

    #des {
        border-bottom: 2.5px solid #ea454b !important;

    }
</style>

<body>
    <nav class="nav-extended">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo"><i class="">Bulk Buying System</i></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="vendor.php" data-target="sidenav-2" class="right sidenav-trigger show-on-medium-and-up"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="logout.php">Logout</a></li>
                <li><a href="vendor.php">Home</a></li>
            </ul>
        </div>

    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
    </ul>
    <div class="container">

        <span class="title">

            <h2 style="text-align: center">Detail Report</h2>
        </span><br>
        <div class="row">
            <div class="input-field col s4">
                <input type="date" name="startDate" id="startDate" min="2019-01-01" max="2019-10-31" required="" />
                <input type="date" name="endDate" id="endDate" min="2019-01-01" max="2019-10-31" required="" />
                <button class="btn btn-success" onclick="filterTable()">Filter By Date</button>
            </div>
            <div class="switch">
                <select>
                    <option>One</option>
                    <option>Two</option>
                </select>
            </div>

        </div>

        <table id="detailTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Payment Type</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $query = "SELECT * FROM bulk_order b, customer c WHERE c.customerID AND b.customerId";
                $result = mysqli_query($db, $query);


                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {

                            $orderID = $row['id'];
                            $orderDate = $row['orderDate'];
                            $total = $row['total'];
                            $paymentType = $row['paymentType'];
                            $customerName = $row['name'];
                            ?>

                            <tr>
                                <td><?php echo $orderID ?></td>
                                <td><?php echo $customerName ?></td>
                                <td><?php echo $orderDate ?></td>
                                <td><?php echo $paymentType ?></td>
                                <td><?php echo $total ?></td>
                            </tr>

                <?php
                        }
                    }
                }
                ?>

    </div>

    <div id="addProdMod" class="modal modal-fixed-footer valign-wrapper" style="">

        <span id="mod_content" class="valign-wrapper" style="padding-top: 20px;"></span>
    </div>

    <div class="fixed-action-btn wow fadeIn" data-wow-delay="1s">
        <button id="addProds" class="btn-floating btn-large red darken-4 waves-effect waves-dark">
            <i class="large fa fa-plus"></i>
        </button>
    </div>



    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script src="script/dataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="script/dataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

    <script>
        //$('#productTable').dataTable();

        $(document).ready(function() {
            $('#detailTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        var body = document.getElementsByTagName('tbody')[0];
        var rows = body.getElementsByTagName('tr');

        console.log(rows + 54542);

        function filterTable() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;

            $(rows).show();
            console.log(rows + 589887867);

            if (startDate == '') {
                alert("Enter startTime");

                return false;
            }


            if (endDate == '') {
                alert("Enter startTime");

                return false;
            }

            if (startDate > endDate) {
                alert("StartDate can't be greater then end date");

                return false;
            }




            var start = new Date(startDate);
            var end = new Date(endDate);

            for (var i = 0; i < rows.length; i++) {
                var singleRow = rows[i];
                var dateColumn = singleRow.getElementsByTagName('td')[2];
                var orderDate = dateColumn.innerHTML;

                console.log(orderDate + " " + start);

                if (orderDate >= start && orderDate <= end) {
                    $(rows[i]).show();
                    //$('button').hide();
                } else {
                    $(rows[i]).hide();
                }

            }

        }
    </script>
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
            $('.modal').modal();
            var currYear = (new Date()).getFullYear();
            $(".datepicker").datepicker({
                defaultDate: new Date(currYear, 1, 31),
                // setDefaultDate: new Date(2000,01,31),
                maxDate: new Date(currYear + 5, 12, 31),
                yearRange: [2019, currYear],
                format: "yyyy/mm/dd"
            });

            $("#srcBy").on('change', function() {
                var value = $(this).val();
                var cell = "<?php echo $cell; ?>";
                var date = $('#bdate').val();

                $.ajax({
                    url: 'srcprod.php',
                    type: 'POST',
                    data: {
                        value: value,
                        cell: cell,
                        date: date

                    },
                    beforeSend: function() {
                        $("#prodsList").html('Loading...');
                    },
                    success: function(data) {
                        $("#prodsList").html(data);
                    },
                });
            });


            $("#bdate").on('change', function() {
                var value = $(this).val();
                var cell = "<?php echo $cell; ?>";
                var date = $('#bdate').val();

                $.ajax({
                    url: 'prodByDate.php',
                    type: 'POST',
                    data: {
                        value: value,
                        cell: cell,
                        date: date

                    },
                    beforeSend: function() {
                        $("#prodsList").html('Loading...');
                    },
                    success: function(data) {
                        $("#prodsList").html(data);
                    },
                });
            });






            $('#addProds').click(function() {

                $.ajax({
                    url: "addPros.html",
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#addProdMod').modal('open');

                    }
                });
            });

        });


        //functions
        function moses(id) {

            var pID = id;
            // alert(id)
            $.ajax({
                type: 'post',
                url: "updateProd.php",
                data: {
                    pID: pID,
                },
                success: function(response) {
                    $('#mod_content').html(response);
                    $('#addProdMod').modal('open');
                }
            });

        }

        function moses2(idd) {

            var pID = idd;
            var updateP = confirm("Are you sure you want to delete product?");
            if (updateP == true) {
                $.ajax({
                    type: 'post',
                    url: "delProd.php",
                    data: {
                        pID: pID,
                    },
                    success: function(response) {
                        $('#' + idd).html(response);

                    }
                });
            }

        }
        $("#alls").on('change', function() {
            $('.item').prop("checked", $(this).prop("checked"));
        });

        function alls() {


        }

        function page() {
            $.ajax({
                url: 'deleteSelectedProd.php',
                type: 'GET',
                success: function(data) {
                    $("#prodsList").html(data);
                }
            });
        }

        $('#selectedBox').click(function() {
            var ids = $('.item:checked').map(function() {
                return $(this).val();
            }).get().join(' ');

            if (ids !== null && ids !== '') {

                //$.post('deleteSelectedProd.php?p=del', {ids :ids}, function(data){page();});
                $.ajax({
                    url: 'deleteSelectedProd.php',
                    type: 'POST',
                    data: {
                        ids: ids,
                    },
                    success: function(data) {
                        $("#prodsList").html(data);
                    }
                });
            } else {

                //page();

                alert("Nothing Checked...");

            }


        });
    </script>

    <script>
        $(document).ready(function(e) {

            $("#form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "prodpic.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        //$("#preview").fadeOut();
                        $("#err").fadeOut();
                    },
                    success: function(data)
                    $('#err').html(data); {
                        if (data == 'invalid') {
                            // invalid file format.
                            $("#err").html("Invalid File !").fadeIn();
                        } else {
                            // view uploaded file.
                            $("#preview").html(data).fadeIn();
                            $("#form")[0].reset();
                        }
                    },
                    error: function(e) {
                        $("#err").html(e).fadeIn();
                    }
                });

            }));




        });
    </script>