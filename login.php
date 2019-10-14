<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>

    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>

#cell  {
    border-bottom: 2.5px solid #ef9a9a  !important;
}
#passW{
    border-bottom: 2.5px solid #ef9a9a  !important;
}
#log{
    border-bottom: 2.5px solid #ef9a9a  !important;
}
#link{
    color: red;
}


</style>

<body>

    <!--Nav-->
    <nav >
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Login</a>
        </div>
    </nav>

    <div class="login pushed-top">
        <div class="container">
            <div class="row .valign-wrapper">
                <form action="" id="user-form">
                    <div class="input-field">
                        <span id="result"></span>
                    </div>
                    <div class="input-field">
                        <input id="log" type="number" class="validate">
                        <label for="log">Customer/Company number</label>
                    </div>
                    <div class="input-field">
                        <input id="passW" type="password" class="validate">
                        <label for="passW">Password</label>
                    </div>
                    <div class="input-field">
                            <div class="select">
                                <select name="signAs" id="signAs" class="browser-default" style="box-shadow: 1px 0px 2px none; border-bottom :#ef9a9a 2px solid; ">
                                    <option value="0" disabled selected>Sign as</option>
                                    <option value="1">Vendor</option>
                                    <option value="2">Customer</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="center">
                        <div class="input-field">
                        <button id="btn_login" class="btn red lighten-2 btn-round waves-effect waves-dark col s12">Login</button>
                        <p class="text-center">Not Yet Registered? <a id="link" href="comcus.php">Register!</a></p>
                        </div>
                        </div>

                    <div class="fixed-action-btn">
                        <a href="#" class="btn-floating btn-large red lighten-2 waves-effect waves-dark">
                            <i class="large fa fa-info"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer class="grey darken-4" style="position:fixed; bottom:0; width:100%;">
        <div class="">
            <div class="container">

            </div>
        </div>
    </footer>




    <!--scripts-->
    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.fixed-action-btn').floatingActionButton();

            $('#btn_login').click(function(e) {
                e.preventDefault();
                var cell = $('#log').val();
                var passW = $('#passW').val();
                var signAs = $('#signAs').val();

                $.ajax({
                    type: "post",
                    url: "loginCpu.php",
                    data: {
                        cell: cell,
                        passW: passW,
                        signAs:signAs
                        
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