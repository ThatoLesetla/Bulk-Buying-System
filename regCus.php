<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnStore</title>

    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
#linklog{
    color: red;
}



</style>

<body>

    <!--Nav-->
    <nav >
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Register</a>
        </div>
    </nav>

    <div class="login pushed-top">
        <div id="body_content" class="container">
        <div class="row .valign-wrapper">
                <form action="" id="user-form">
                    <div class="resultss">
                        <span id="result"></span>
                    </div>
                    <div class="input-field">
                        <input id="name" type="text" class="validate">
                        <label for="name">Customer Name</label>
                    </div>

                    <div class="input-field">
                        <input id="surname" type="text" class="validate">
                        <label for="surname">Customer Surname</label>
                    </div>

                    <div class="input-field">
                        <input id="cell" type="number" class="validate">
                        <label for="cell">Contact Number</label>
                    </div>
                    <div class="input-field">
                        <input id="email" type="text" class="validate">
                        <label for="email">Email Address</label>
                    </div>
                    <div class="input-field">
                        <input id="city" type="text" class="validate">
                        <label for="city">City</label>
                    </div>
                    <div class="input-field">
                        <input id="passW" type="password" class="validate">
                        <label for="passW">Enter Password</label>
                    </div>
                    <div class="input-field">
                        <input id="passW1" type="password" class="validate">
                        <label for="passW1">Enter Password</label>
                    </div>
                    <div class="center">
                    <div class="input">
                        <button id="btn_reg" class="btn red lighten-2 btn-round waves-effect waves-dark col s12">Register</button>
                        <p class="text-center">Already have Registered? <a id="linklog" href="login.php">Login!</a></p>
                    </div>
                    </div>
                    
                    <div class="fixed-action-btn">
                        <a  class="btn red lighten-2 btn-round waves-effect waves-dark">
                            <i class="large fa fa-info"></i>
                        </a>
                    </div>
                </form>
            </div>
    

    <!--footer-->
    <footer class="grey darken-4" style="position:fixed; bottom:0; width:100%;">
        <div class="">
            <div class="container">

            </div>
        </div>
    </footer>
        </div>
    </div>


    <!--scripts-->
    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.fixed-action-btn').floatingActionButton();
            $('textarea#passW1, textarea#passW').characterCounter();

            $('#btn_reg').click(function(e) {
                e.preventDefault();
                
                var name = $('#name').val();
                var cell = $('#cell').val();
                var surname= $('#surname').val();
                var email = $('#email').val();
                var city = $('#city').val();
                var address = $('#address').val();
                var passW = $('#passW').val();
                var passW1 = $('#passW1').val();

                $.ajax({
                    type: "post",
                    url: "regCpuCus.php",
                    data: {
                        name:name,
                        surname:surname,
                        cell: cell,
                        email: email,
                        city:city,
                        passW: passW,
                        passW1: passW1
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