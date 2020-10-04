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

    <!-- Modal Structure -->

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
                <label for="create_passW1">Password</label>
            </div>
            <div class="row middle-xs ">
                <button type="submit" name="btn_pass" id="btn_pass" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Create</button>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Cancel</a>
        </div>
    </div>

    <nav>
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a class="brand-logo">Bulk Buying System</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">

                </ul>
            </div>
        </div>
    </nav>

    <div class="form pushed_top">
        <div class="container">
            <h4 class="start-lg center-xs">Login</h4>
            <div class="divider"></div>
            <div class="row start-lg center-xs">
                <div class="col s12 m8 pull-m2">
                    <form>
                        <div class="input-field">
                            <span id="result"></span>
                        </div>
                        <div class="input-field">
                            <input type="number" name="idNo" id="idNo">
                            <label for="idNo">Administrator Number</label>
                        </div>
                        <div id="pass">
                            <div class="input-field">
                                <input type="password" name="passW1" id="passW1">
                                <label for="passW1">Password</label>
                            </div>
                        </div>
                        <div class="row middle-xs ">
                            <button type="submit" name="btn_login" id="btn_login" class="btn waves-effect waves-dark red lighten-2 col s12 m4 round-btn">Login</button>
                            <div class="col s12 m8"><a href="reg.php"></a></div>
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
        $('#pass').slideDown();

        $(document).ready(function() {

            //Init Modal
            $('.modal').modal();

            //SearchID
            $('#idNo').keyup(function(e) {
                e.preventDefault();
                var idno = $('#idNo').val();


                $.ajax({
                    type: "post",
                    url: 'searchAdminID.php',
                    data: {
                        idno: idno
                    },
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
            });

            //Create Account
            $('#btn_pass').click(function(e) {
                e.preventDefault();
                var idno = $('#idNo').val();
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

            //Login
            $('#btn_login').click(function(e) {
                e.preventDefault();
                var idno = $('#idNo').val();
                var passW = $('#passW1').val();



                $.ajax({
                    type: "post",
                    url: "adm_login_process.php",
                    data: {
                        idno: idno,
                        passW: passW
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