<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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

    <!-- Modal Structure -->
    <div id="modal2" class="modal modal-fixed-footer">
        <div class="modal-content center-xs">
            <h4>User do not exist</h4>
            </div>  
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Cancel</a>
        </div>
    </div>


    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content center-xs">
            <h4>Register User</h4>
            <div class="input-field">
                <span id="create_userDetails"></span>
            </div>
            <div class="input-field">
                <span id="output"></span>
            </div>
            <div class="row">
                <div class="input-field col-xs-6">
                    <input type="email" name="mail" id="mail">
                    <label for="mail">Email</label>
                </div>
                <div class="input-field col-xs-6">
                    <input type="number" name="cell" id="cell">
                    <label for="cell">Contact Number</label>
                </div>
            </div>
            <div class="input-field">
                <input type="password" name="create_passW" id="create_passW">
                <label for="create_passW">Password</label>
            </div>
            <div class="input-field">
                <input type="text" name="create_passW1" id="create_passW1">
                <label for="create_passW1">Confirm Password</label>
            </div>
            <div class="row middle-xs ">
                <button type="submit" name="btn_pass_std" id="btn_pass_std" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Create</button>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Cancel</a>
        </div>
    </div>

    <div class="form pushed_top">
        <div class="container">
            <h4 class="start-lg center-xs">Login</h4>
            <div class="divider"></div>
            <div class="row start-lg center-xs">
                <div class="col s12 m8 pull-m2">
                    <form action="" method="post">
                        <div class="input-field">
                            <input type="number" name="stdNo" id="stdNo">
                            <label for="stdNo">Student Number</label>

                        </div>

                        <div class="input-field" id="passW-wrapper">
                            <input type="password" name="passW" id="passW">
                            <label for="passW">Password</label>

                        </div>

                        <div class="input-field">
                            <span id="result"></span>
                        </div>

                        <div class="row middle-xs ">
                            <button type="submit" name="logbtn" id="logbtn" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Login</button>
                            <div class="col s12 m8">Forgort Password? <a href="reg.php">Recover here</a></div>
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

    $('.modal').modal();
    

        $('#passW-wrapper').slideUp();
        $(document).ready(function() {

            //SearchID
            $('#stdNo').keyup(function(e) {
                var idno = $('#stdNo').val();
                $.ajax({
                    type: "post",
                    url: 'searchID.php',
                    data: {
                        idno: idno
                    },
                    success: function(response) {
                        $('#output').html(response);
                    }
                });
            });

            //Create Account
            $('#btn_pass_std').click(function(e) {
                e.preventDefault();
                var idno = $('#stdNo').val();
                var email = $('#mail').val();
                var cell = $('#cell').val();
                var passW = $('#create_passW').val();
                var passW1 = $('#create_passW1').val();

                $.ajax({
                    type: "post",
                    url: "create_user.php",
                    data: {
                        idno: idno,
                        email: email,
                        cell: cell,
                        passW: passW,
                        passW1: passW1
                    },
                    success: function(response) {
                        $('#output').html(response);
                    }
                });
            });

            $('#create_passW').keyup(function(e) {
                var pass = $('#create_passW').val();

                $.ajax({
                    type: "post",
                    url: "pass_verify.php",
                    data: {
                        pass: pass
                    },
                    success: function(response) {
                        $('#output').html(response);
                    }
                });
            });

            $('#create_passW1').keyup(function(e) {
                var pass = $('#create_passW1').val();

                $.ajax({
                    type: "post",
                    url: "pass_verify.php",
                    data: {
                        pass: pass
                    },
                    success: function(response) {
                        $('#output').html(response);
                    }
                });
            });

            $('#logbtn').click(function(e) {
                e.preventDefault();

                var stdNo = $('#stdNo').val();
                var passW = $('#passW').val();

                $.ajax({
                    type: "post",
                    url: "logincpu.php",
                    data: {
                        stdNo: stdNo,
                        passW: passW,
                    },
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
        

            });
        });
    </script>

</body>



</html> 