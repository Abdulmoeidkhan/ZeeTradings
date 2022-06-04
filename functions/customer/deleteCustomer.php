<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $customerUpdatedBy = $_SESSION["uId"];
    $customerUpdateQuery = "UPDATE customer_user_db set 
            customerUpdatedBy='" . $customerUpdatedBy . "',
            customerStatus=0,
            deleted=1 where customerId='" . $_REQUEST['customerId'] . "'";
    echo $customerUpdateQuery;
    if ($posted = $connection->query($customerUpdateQuery)) {
        header("Location:../admin/pages/customer/customerList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
