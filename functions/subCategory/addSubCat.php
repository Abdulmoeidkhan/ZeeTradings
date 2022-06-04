<?php
session_start();

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$myuuid = guidv4();
if (isset($_REQUEST['formSubmit'])) {
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $subCatName = $_REQUEST['subCatName'];
        $subCatDesc = $_REQUEST['subCatDesc'];
        $subCatId = $myuuid;
        $subCatCreatedBy = $_SESSION["uId"];
        $subCatStatus = "1";
        $catSubCatQuer = "INSERT INTO `product_sub_category_db` VALUES(
                '" . $subCatName . "',
                '" . $subCatDesc . "',
                '" . $subCatId . "',
                CURRENT_TIMESTAMP,
                '" . $subCatCreatedBy . "',
                CURRENT_TIMESTAMP,
                '" . $subCatCreatedBy . "',
                DEFAULT,
                DEFAULT);";
        echo $catSubCatQuer;
        if ($posted = $connection->query($catSubCatQuer)) {
            header("Location:../admin/pages/subcategory/subCategoryList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "You are not Logged In Properly";
    }
}
