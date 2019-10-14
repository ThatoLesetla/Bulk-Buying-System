<?php

session_start();

include 'connect.php';

if (empty($_SESSION['email'])) {
    unset($_SESSION['email']);
    session_abort();
    header('location: login.php');
} else {
    $cell = $_SESSION['email'];

    $query = "SELECT * FROM vendor WHERE `email` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            header('location: vendor.php');
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
    
</head>

<body>

<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo"><i class=""></i></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="login.php">Sign in</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="#">Home</a></li>
      </ul>
    </div>
    <ul>
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Shop by category</a></li>
    </ul>

</ul>
    <div class="nav-content ">
                <div class="row valign-wrapper">
                    <div class="col s12">
                        <div class="input-field" style="padding: 0 !important; margin: 0 !important; margin-top: 0px !important;">
                            <input id="cell" type="number" class="validate white-text">
                            <label for="cell" class="white-text">Search...</label>
                        </div>
                    </div>
  </nav>

 <!--drop-->
    <ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">one</a></li>
    <li><a href="#!">two</a></li>
    <li class="divider"></li>
    <li><a href="#!">three</a></li>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>

        

   
     <!--scripts-->
    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.sidenav').sidenav();   
        $(".dropdown-trigger").dropdown();  

        });
    </script>

</body>

</html> 