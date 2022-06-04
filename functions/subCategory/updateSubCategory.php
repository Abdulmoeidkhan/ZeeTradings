<?php
session_start();
if (isset($_REQUEST['formSubmit'])) {
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['subCatName'];
        $description = $_REQUEST['subCatDesc'];
        $UpdateBy = $_SESSION["uId"];
        $Status = $_REQUEST['subCatStatus'];
        $UpdateQuery = "UPDATE `product_sub_category_db` set 
            subCatName='" . $name . "',
            subCatDesc='" . $description . "',
            subCatUpdateBy='" . $UpdateBy . "',
            subCatStatus='" . $Status . "' where subCatId='" . $_REQUEST['uId'] . "'";
        echo $UpdateQuery;
        if ($posted = $connection->query($UpdateQuery)) {
            header("Location:../admin/pages/subcategory/subCategoryList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "Some Thing Went Wrong";
    }
};
