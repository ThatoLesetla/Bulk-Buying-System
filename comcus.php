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
    color: #ef9a9a;
}

</style>

<body>

    <!--Nav-->
    <nav >
        <div class="nav-wrapper">
            <h4 class="brand-logo center">Select Account</h4>
        </div>
    </nav>

    <div class="row">
    <div class="col s12 m6">
      <div class="card red lighten-2">
        <div class="card-content white-text">
          <span class="card-title">Register As Vendor</span>
          <p>About..</p>
        </div>
        <div class="card-action">
        <div class="container">
                <div class="center">
                <a href="register.php" id="com" class="waves-effect waves-light btn">Register</a>
                </div>
            
            </div>
        </div>
      </div>
    </div>

    <div class="col s12 m6">
      <div class="card red lighten-2">
        <div class="card-content white-text">
          <span class="card-title">Register As Customer</span>
          <p>About..</p>
        </div>
        <div class="card-action">
            <div class="container">
                <div class="center">
                <a href="regCus.php"id="cus" class="waves-effect waves-light btn">Register</a>
                </div>
            
            </div>
     
       
        </div>
      </div>
    </div>

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
             });
    </script>

</body>

</html>