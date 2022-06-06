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
    echo $_FILES['brandImg']['name'];
    $uploadedPic = (new UploadApi())->upload(
        $_FILES['brandImg']['tmp_name'],
        [
            'resource_type' => 'image',
            'public_id' => 'Project-1-iba/brands/'.$_REQUEST["brandName"].'',
            'chunk_size' => 6000000,
        ]
    );
    // print_r($uploadedPic);
    // $uploadedPic["secure_url"]="https://";
    if (isset($_SESSION["uId"])) {
        require("../conn.php");
        $name = $_REQUEST['brandName'];
        $description = $_REQUEST['brandDesc'];
        $subDescription = $_REQUEST['brandShortDesc'];
        $brandId = $myuuid;
        $brandUrl = $_REQUEST['brandWeb'];
        $brandCratedBy = $_SESSION["uId"];
        $brandStatus = "0";
        $brandLegacy = $_REQUEST["brandLegacy"];
        $brandAddQuery = "INSERT INTO brand_db VALUES(
                '" . $name . "',
                '" . $description . "',
                '" . $subDescription . "',
                '" . $brandId . "',
                '" . $brandCratedBy . "',
                '" . $brandCratedBy . "',
                DEFAULT,
                DEFAULT,
                '" . $uploadedPic["secure_url"] . "',
                '" . $brandLegacy . "',
                '" . $brandUrl . "',
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            );";
        // echo $brandAddQuery;
        if ($posted = $connection->query($brandAddQuery)) {
            header("Location:../admin/pages/brand/brandList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        $_SESSION["sign_In_Pass_Err"] = true;
        header("Location:../admin/pages/adminHome/adminHome.php");
    };
}
