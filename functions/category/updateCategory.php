<?php
session_start();
if (isset($_REQUEST['formSubmit'])) {
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['catName'];
        $description = $_REQUEST['catDesc'];
        $shortDesc = $_REQUEST['catShortDesc'];
        $catUpdateBy = $_SESSION["uId"];
        $catStatus = $_REQUEST['catStatus'];
        $catUpdateQuery = "UPDATE product_category_db set 
            catName='" . $name . "',
            catDesc='" . $description . "',
            catShortDesc='" . $shortDesc . "',
            catUpdateBy='" . $catUpdateBy . "',
            catStatus='" . $catStatus . "' where catId='" . $_REQUEST['uId'] . "'";
        echo $catUpdateQuery;
        if ($posted = $connection->query($catUpdateQuery)) {
            header("Location:../admin/pages/category/categoryList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "Some Thing Went Wrong";
    }
};
