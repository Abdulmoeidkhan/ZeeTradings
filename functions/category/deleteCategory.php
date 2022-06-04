<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $categoryUpdatedBy = $_SESSION["uId"];
    $categoryUpdateQuery = "UPDATE product_category_db set 
            catUpdateBy='" . $categoryUpdatedBy . "',
            catStatus=0,
            deleted=1 where catId='" . $_REQUEST['catId'] . "'";
    echo $categoryUpdateQuery;
    if ($posted = $connection->query($categoryUpdateQuery)) {
        header("Location:../admin/pages/category/categoryList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
