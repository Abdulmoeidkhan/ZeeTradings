<?php
session_start();
if (isset($_REQUEST['formSubmit'])) {
    $_SESSION["sign_In_Pass_Err"] = false;
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['customerUserName'];
        $contact = $_REQUEST['customerUserContact'];
        $email = $_REQUEST['customerUserEmail'];
        $customerUpdatedBy = $_SESSION["uId"];
        $customerStatus = $_REQUEST['customerUserStatus'];
        $customerUpdateQuery = "UPDATE customer_user_db set 
            customerName='" . $name . "',
            customerContact='" . $contact . "',
            customerEmail='" . $email . "',
            customerUpdatedBy='" . $customerUpdatedBy . "',
            customerStatus='" . $customerStatus . "' where customerId='" . $_REQUEST['uId'] . "'";
        echo $customerUpdateQuery;
        if ($posted = $connection->query($customerUpdateQuery)) {
            header("Location:../admin/pages/customer/customerList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    }
    else {
        echo "You have not provided same password for confirm password";
    }
} else {
    $_SESSION["sign_In_Pass_Err"] = true;
    header("Location:../admin/pages/adminHome/adminHome.php");
};
