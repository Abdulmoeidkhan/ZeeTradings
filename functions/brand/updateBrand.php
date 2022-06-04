<?php
session_start();
require("../vendor/autoload.php");
require("../config-cloud.php");

use Cloudinary\Api\Upload\UploadApi;

if (isset($_REQUEST['formSubmit'])) {
    $uploadedPic["secure_url"] = "";
    if ($_FILES['brandImg']['tmp_name']) {
        $uploadedPic = (new UploadApi())->upload(
            $_FILES['brandImg']['tmp_name'],
            [
                'resource_type' => 'image',
                'public_id' => 'Project-1-iba/brands/' . $_REQUEST["brandName"] . '',
                'chunk_size' => 6000000,
            ]
        );
    }
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['brandName'];
        $description = $_REQUEST['brandDesc'];
        $shortDesc = $_REQUEST['brandShortDesc'];
        $brandUpdateBy = $_SESSION["uId"];
        $brandStatus = $_REQUEST['brandStatus'];
        $brandLegacy = $_REQUEST['brandLegacy'];
        $brandWeb = $_REQUEST['brandWeb'];
        $brandImg = $uploadedPic["secure_url"] ? $uploadedPic["secure_url"] : "";
        $brandFile = $_FILES['brandImg']["tmp_name"] ? "brandImg='" . $brandImg . "'," : "";
        $brandUpdateQuery = "UPDATE brand_db set 
           brandName='" . $name . "',
           brandDesc='" . $description . "',
           brandShortDesc='" . $shortDesc . "',
           brandUpdateBy='" . $brandUpdateBy . "',
           brandLegacy='" . $brandLegacy . "',
           brandWeb='" . $brandWeb . "',
           " . $brandFile . "
           brandStatus='" . $brandStatus . "'
            where brandId='" . $_REQUEST['uId'] . "'";
        if ($posted = $connection->query($brandUpdateQuery)) {
            header("Location:../admin/pages/brand/brandList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "Some Thing Went Wrong";
    }
};
