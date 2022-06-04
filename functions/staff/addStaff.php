<?php
session_start();
require("../config-cloud.php");

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$myuuid = guidv4();
if (isset($_REQUEST['formSubmit'])) {
    if ($_REQUEST['staffUserPass'] === $_REQUEST['staffUserConfirmPass']) {
        $_SESSION["sign_In_Pass_Err"] = false;
        echo $_FILES['staffUserPic'];
        if (isset($_SESSION["uId"])) {
            require("./conn.php");

            $name = $_REQUEST['staffUserName'];
            $password = $_REQUEST['staffUserPass'];
            $contact = $_REQUEST['staffUserContact'];
            $staffId = $myuuid;
            $email = $_REQUEST['staffUserEmail'];
            $staffCreatedBy = $_SESSION["uId"];
            $staffStatus = "0";
            $staffRole = $_REQUEST["staffUserRole"];
            $staffAddQuery = "INSERT INTO staff_user_db VALUES(
                '" . $name . "',
                '" . $password . "',
                '" . $contact . "',
                '" . $staffId . "',
                '" . $email . "',
                CURRENT_TIMESTAMP,
                '" . $staffCreatedBy . "',
                CURRENT_TIMESTAMP,
                '" . $staffCreatedBy . "',
                DEFAULT,
                '" . $staffRole . "',
                DEFAULT,
                '".$uploadedPic["secure_url"]."');";
            if ($posted = $connection->query($staffAddQuery)) {
                header("Location:../admin/pages/staff/staffList.php");
            } else {
                header("Location:../admin/pages/adminHome/500.php");
            }
        } else {
            echo "You are not Logged In Properly";
        }
    } else {
        $_SESSION["sign_In_Pass_Err"] = true;
        header("Location:../admin/pages/adminHome/adminHome.php");
    };
}
