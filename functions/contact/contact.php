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
    require("./conn.php");
    $ctcEmail = $_REQUEST['ctcEmail'];
    $ctcNumber = $_REQUEST['ctcNumber'];
    $ctcMessage = $_REQUEST['ctcMessage'];
    $catStatus = "1";
    $catId = $myuuid;
    $fName = $_REQUEST['firstName'];
    $lName = $_REQUEST['lastName'];
    $staffAddQuery = "INSERT INTO product_category_db VALUES(
                '" . $ctcEmail . "',
                '" . $ctcNumber . "',
                '" . $ctcMessage . "',
                '" . $catStatus . "',
                
                DEFAULT,
                DEFAULT);";
    echo $staffAddQuery;
    if ($posted = $connection->query($staffAddQuery)) {
        header("Location:../../front/pages/index.php");
    } else {
        header("Location:../admin/pages/adminHome/500.php");
    }
}
