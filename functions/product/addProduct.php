<?php
session_start();
require("../vendor/autoload.php");
require("../config-cloud.php");

use Cloudinary\Api\Upload\UploadApi;

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
    $_SESSION["sign_In_Pass_Err"] = false;
    echo $_FILES['productImg']['name'];
    $uploadedPic = (new UploadApi())->upload(
        $_FILES['productImg']['tmp_name'],
        [
            'resource_type' => 'image',
            'public_id' => 'Project-1-iba/products/' . $_REQUEST["productName"] . '',
            'chunk_size' => 6000000,
        ]
    );
    // print_r($uploadedPic);
    // $uploadedPic["secure_url"]="https://";
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['productName'];
        $description = $_REQUEST['productDesc'];
        $subDescription = $_REQUEST['productShortDesc'];
        $productCratedBy = $_SESSION["uId"];
        $productId = $myuuid;
        $productImg = $uploadedPic["secure_url"];
        $productCatId = $_REQUEST['productCatId'];
        $productAmount = $_REQUEST['productAmount'];
        $productQuan = $_REQUEST['productQuan'];
        $productPacking = $_REQUEST['productPacking'];
        $productSubCatId = $_REQUEST['productSubCatId'];
        $productAddQuery = "INSERT INTO product_db VALUES(
                '" . $name . "',
                '" . $description . "',
                '" . $subDescription . "',
                '" . $productId . "',
                '" . $productAmount . "',
                '" . $productCratedBy . "',
                CURRENT_TIMESTAMP,
                '" . $productCratedBy . "',
                CURRENT_TIMESTAMP,
                DEFAULT,
                DEFAULT,
                '" . $productImg . "',
                '" . $productCatId . "',
                '" . $productSubCatId . "',
                '" . $productQuan . "',
                '" . $productQuan . "',
                '" . $productPacking . "'
            );";
        echo $productAddQuery;
        if ($posted = $connection->query($productAddQuery)) {
            header("Location:../admin/pages/product/productList.php");
        }
         else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        $_SESSION["sign_In_Pass_Err"] = true;
        header("Location:../admin/pages/adminHome/adminHome.php");
    };
}
