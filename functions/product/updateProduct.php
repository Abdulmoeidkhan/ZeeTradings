<?php
session_start();
require("../vendor/autoload.php");
require("../config-cloud.php");

use Cloudinary\Api\Upload\UploadApi;

if (isset($_REQUEST['formSubmit'])) {
    $uploadedPic["secure_url"] = "";
    if ($_FILES['productImg']['tmp_name']) {
        $uploadedPic = (new UploadApi())->upload(
            $_FILES['productImg']['tmp_name'],
            [
                'resource_type' => 'image',
                'public_id' => 'Project-1-iba/products/' . $_REQUEST["productName"] . '',
                'chunk_size' => 6000000,
            ]
        );
    }
    if (isset($_SESSION["uId"])) {
        require("./conn.php");
        $name = $_REQUEST['productName'];
        $description = $_REQUEST['productDesc'];
        $shortDesc = $_REQUEST['productShortDesc'];
        $productUpdateBy = $_SESSION["uId"];
        $productAmount = $_REQUEST['productAmount'];
        $productStatus = $_REQUEST['productStatus'];
        $productImg = $uploadedPic["secure_url"] ? $uploadedPic["secure_url"] : "";
        $productCatId = $_REQUEST['productCatId'];
        $productSubCatId = $_REQUEST['productSubCatId'];
        $productFile = $_FILES['productImg']["tmp_name"] ? "productImg='" . $productImg . "'," : "";
        $productUpdateQuery = "UPDATE product_db set 
           productName='" . $name . "',
           productDesc='" . $description . "',
           productShortDesc='" . $shortDesc . "',
           productUpdateBy='" . $productUpdateBy . "',
           productSubCatId='" . $productSubCatId . "',
           productAmount='" . $productAmount . "',
           productCatId='" . $productCatId . "',
           " . $productFile . "
           productStatus='" . $productStatus . "' where productId='" . $_REQUEST['uId'] . "'";
        if ($posted = $connection->query($productUpdateQuery)) {
            header("Location:../admin/pages/product/productList.php");
        } else {
            header("Location:../admin/pages/adminHome/500.php");
        }
    } else {
        echo "Some Thing Went Wrong";
    }
};
