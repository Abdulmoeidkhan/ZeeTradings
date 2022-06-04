<?php
session_start();
if (isset($_SESSION["uId"])) {
    require("./conn.php");
    $subCategoryUpdatedBy = $_SESSION["uId"];
    $subCategoryUpdateQuery = "UPDATE product_sub_category_db set 
            subCatUpdateBy='" . $subCategoryUpdatedBy . "',
            subCatStatus=0,
            deleted=1 where subCatId='" . $_REQUEST['subCatId'] . "'";
    echo $subCategoryUpdateQuery;
    if ($posted = $connection->query($subCategoryUpdateQuery)) {
        header("Location:../admin/pages/subcategory/subCategoryList.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
};
