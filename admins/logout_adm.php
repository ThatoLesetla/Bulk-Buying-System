<?php

session_start();



    unset($_SESSION['cell']);
    session_destroy();
    header('location: index.php');

 