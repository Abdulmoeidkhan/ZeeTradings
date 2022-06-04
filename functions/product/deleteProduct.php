<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $productUpdatedBy = $_SESSION["uId"];
    $productUpdateQuery = "UPDATE product_db set 
            productUpdateBy='" . $productUpdatedBy . "',
            productStatus=0,
            deleted=1 where productId='" . $_REQUEST['productId'] . "'";
    if ($posted = $connection->query($productUpdateQuery)) {
        header("Location:../admin/pages/product/productList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
?>