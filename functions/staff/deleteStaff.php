<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $staffUpdatedBy = $_SESSION["uId"];
    $staffUpdateQuery = "UPDATE staff_user_db set 
            staffUpdateBy='" . $staffUpdatedBy . "',
            staffStatus=0,
            deleted=1 where staffId='" . $_REQUEST['staffId'] . "'";
    echo $staffUpdateQuery;
    if ($posted = $connection->query($staffUpdateQuery)) {
        header("Location:../admin/pages/staff/staffList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
?>
