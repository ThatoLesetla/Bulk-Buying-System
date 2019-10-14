<?php

session_start();
unset($_SESSION['phone']);
session_destroy();

echo "<script>window.location.href = 'login.php'</script>";
