<?php
session_start();
if (isset($_REQUEST['formSubmit'])) {
    if ($_REQUEST['staffUserPass'] === $_REQUEST['staffUserConfirmPass']) {
        $_SESSION["sign_In_Pass_Err"] = false;
        if (isset($_SESSION["uId"])) {
            require("./conn.php");

            $name = $_REQUEST['staffUserName'];
            $password = $_REQUEST['staffUserPass'];
            $contact = $_REQUEST['staffUserContact'];
            $email = $_REQUEST['staffUserEmail'];
            $staffUpdatedBy = $_SESSION["uId"];
            $staffStatus = $_REQUEST['staffUserStatus'];
            $staffRole = $_REQUEST["staffUserRole"];
            $staffUpdateQuery = "UPDATE staff_user_db set 
            staffName='" . $name . "',
            staffPass='" . $password . "',
            staffContact='" . $contact . "',
            staffEmail='" . $email . "',
            staffUpdateBy='" . $staffUpdatedBy . "',
            staffStatus='" . $staffStatus . "',
            staffRole='" . $staffRole . "' where staffId='" . $_REQUEST['uId'] . "'";
            echo $staffUpdateQuery;
            if ($posted = $connection->query($staffUpdateQuery)) {
                header("Location:../admin/pages/staff/staffList.php");
            } else {
                header("Location:../admin/pages/adminHome/500.php");
            }
        } else {
            echo "You have not provided same password for confirm password";
        }
    } else {
        $_SESSION["sign_In_Pass_Err"] = true;
        header("Location:../admin/pages/adminHome/adminHome.php");
    };
}
