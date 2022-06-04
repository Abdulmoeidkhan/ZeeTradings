<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $brandUpdatedBy = $_SESSION["uId"];
    $brandUpdateQuery = "UPDATE brand_db set 
            brandUpdateBy='" . $brandUpdatedBy . "',
            brandStatus=0,
            deleted=1 where brandId='" . $_REQUEST['brandId'] . "'";
    if ($posted = $connection->query($brandUpdateQuery)) {
        header("Location:../admin/pages/brand/brandList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
?>