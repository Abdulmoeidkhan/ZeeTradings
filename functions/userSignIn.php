<?php
session_start();
require("./conn.php");
$_SESSION["sign_In_Err"] = false;
if (isset($_POST["Submit"]) && strlen($_POST['uName']) > 0 && strlen($_POST['uPass']) > 5) {
    $req = "SELECT * FROM `customer_user_db` WHERE 
    customerPass='" . $_POST['uPass'] . "' and
    customerStatus=1 and
    customerName = '" . $_POST['uName'] . "' or 
    customerEmail='" . $_POST['uName'] . "'";
    $data =  $connection->query($req);
    if ($row = $data->fetch_assoc()) {
        $_SESSION["uName"] = $row['customerName'];
        $_SESSION["uId"] = $row['customerId'];
        echo "<script>window.location.href='../front/pages/index.php';</script>";
    } else {
        $_SESSION["sign_In_Err"] = true;
        header("Location:" . $_SERVER['HTTP_REFERER'] . "");
    }
}
