<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="#" class="brand-logo"><img src="images/logo.png" alt="" style="width: 150px;"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                    <li><a href="badges.html"><i class="fa fa-info-circle  "></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="form pushed_top">
        <div class="container">
            <h4 class="start-lg center-xs">Password Recovery</h4>
            <div class="divider"></div>
            <div class="row start-lg center-xs">
                <div class="col s12 m8 pull-m2">
                    <form action="" method="post">
                        <div class="input-field">
                            <input type="number" name="stdNo" id="stdNo">
                            <label for="stdNo">Student Number</label>

                        </div>

                        <div class="input-field">
                            <span id="result"></span>
                        </div>

                        <div class="row middle-xs ">
                            <button type="submit" name="btn_reco" id="btn_reco" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#btn_reco').html('Hello');
            $('#btn_reco').click(function (e) { 
                e.preventDefault();
                var idno = $('#stdNo').val();
                
                $.ajax({
                    type: "post",
                    url: "pass_reco.php",
                    data: {idno: idno},
                    success: function (response) {
                        $('#result').html(response);
                    }
                });
                
            });
        });
    </script>
</body>

</html> 