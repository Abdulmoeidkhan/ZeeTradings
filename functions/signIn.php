<?php
session_start();
require("./conn.php");
$_SESSION["sign_In_Err"] = false;
if (isset($_POST["Submit"]) && strlen($_POST['uName']) > 0 && strlen($_POST['uPass']) > 5) {
    $req = "SELECT * FROM `staff_user_db` WHERE 
    staffPass='" . $_POST['uPass'] . "' and
    staffStatus=1 and
    staffName = '" . $_POST['uName'] . "' or 
    staffEmail='" . $_POST['uName'] . "'";

    $data =  $connection->query($req);
    if ($row = $data->fetch_assoc()) {
        $_SESSION["uName"] = $row['staffName'];
        $_SESSION["uRole"] = $row['staffRole'];
        $_SESSION["uId"] = $row['staffId'];
        echo "<script>window.location.href='../admin/pages/adminHome/adminHome.php';</script>";
        exit();
    } else {
        $_SESSION["sign_In_Err"] = true;
        echo "not signed in";
    }
}
