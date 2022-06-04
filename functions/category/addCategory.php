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
        $name = $_REQUEST['catName'];
        $desc = $_REQUEST['catDesc'];
        $subDesc = $_REQUEST['catShortDesc'];
        $catId = $myuuid;
        $catCreatedBy = $_SESSION["uId"];
        $catStatus = "1";
        $staffAddQuery = "INSERT INTO product_category_db VALUES(
                '" . $name . "',
                '" . $desc . "',
                '" . $subDesc . "',
                '" . $catId . "',
                CURRENT_TIMESTAMP,
                '" . $catCreatedBy . "',
                CURRENT_TIMESTAMP,
                '" . $catCreatedBy . "',
                DEFAULT,
                DEFAULT);";
        echo $staffAddQuery;
        if ($posted = $connection->query($staffAddQuery)) {
            header("Location:../admin/pages/category/categoryList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "You are not Logged In Properly";
    }
}
