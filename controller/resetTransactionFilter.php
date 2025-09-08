<?php
session_start();
$_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
}

setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}


unset($_SESSION['filtered_transactions']);
unset($_SESSION['applied_filters']);
unset($_SESSION['show_filtered_message']);

header("Location: ../view/Transaction-history.php");
