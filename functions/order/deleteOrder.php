<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $orderUpdatedBy = $_SESSION["uId"];
    $orderUpdateQuery = "UPDATE order_db set 
            orderUpdateBy='" . $orderUpdatedBy . "',
            orderStatus=0,
            deleted=1 where orderId='" . $_REQUEST['orderId'] . "'";
    if ($posted = $connection->query($orderUpdateQuery)) {
        header("Location:../admin/pages/order/orderList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
?>