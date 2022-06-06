<?php
session_start();
if (isset($_SESSION["uId"])) {
    $_SESSION['cart']=[];
    header("Location:../../front/pages/index.php");
}
?>
