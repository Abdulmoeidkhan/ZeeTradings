<?php
session_start();
if (isset($_SESSION["uId"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="../../utils/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            /* The Modal (background) */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: black;
            }

            /* Modal Content */
            .modal-content {
                position: relative;
                margin-left: 20vw;
                background-color: #fefefe;
                padding: 0;
                width: 75vw;
                max-width: 1200px;
            }


            /* The Close Button */
            .close {
                color: white;
                position: absolute;
                top: 5vh;
                right: 25px;
                font-size: 35px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #999;
                text-decoration: none;
                cursor: pointer;
            }

            .mySlides {
                display: none;
            }

            .cursor {
                cursor: pointer;
            }
        </style>
    </head>

    <body class="sb-nav-fixed">
        <?php
        require("../../components/topNav.php");
        navBar();
        ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php
                require("../../components/sideNav.php");
                sideNav();
                ?>
            </div>
            <div id="layoutSidenav_content">
                <main class="container-fluid">
                    <h2>Fill This Form to Update Product</h2>
                    <?php
                    $productFetch = "select * from `product_db` where productId='" . $_GET["productId"] . "';";
                    require("../../../functions/conn.php");
                    $data = $connection->query($productFetch);
                    while ($row = $data->fetch_assoc()) {
                    ?>
                        <form class="container-fluid" name="productUpdateForm" action="../../../functions/updateproduct.php" method="POST" id="productUpdateForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" placeholder="Meezan" value="<?php echo $row["productName"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productDesc" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDesc" name="productDesc" placeholder="Meezan is trusted company"><?php echo $row["productDesc"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productShortDesc" class="form-label">Product Short Description</label>
                                <textarea class="form-control" id="productShortDesc" name="productShortDesc" placeholder="Meezan is Good company"><?php echo $row["productShortDesc"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productAmount" class="form-label">Product Amount</label>
                                <input type="number" class="form-control" id="productAmount" name="productAmount" value="<?php echo $row["productAmount"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productQuantity" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="0" value="<?php echo $row["productQuantity"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productQuantityRemaining" class="form-label">Product Quantity Remaining</label>
                                <input type="number" class="form-control" id="productQuantityRemaining" name="productQuantitiyRemaining" placeholder="0" value="<?php echo $row["productQuantityRemaining"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productPacking" class="form-label">Product Packing</label>
                                <input type="number" class="form-control" id="productPacking" name="productPacking" placeholder="4" value="<?php echo $row["productPacking"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productWeb" class="form-label">Product Image</label>
                                <div class="column">
                                    <div>
                                        <img src="<?php echo $row["productImg"]; ?>" width="100" onclick="openModal()" class="hover-shadow" />
                                        <span class="cursor" style="color:black;" onclick="deletePic()">&times;</span>
                                    </div>
                                </div>
                                <div id="myModal" class="modal">
                                    <span class="close cursor" onclick="closeModal()">&times;</span>
                                    <div class="modal-content">
                                        <div class="mySlides">
                                            <img src="<?php echo $row["productImg"]; ?>" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                                <input type="file" class="form-control" style='display: <?php echo strlen($row["productImg"]) > 1 ? "none" : "block"; ?>' id="productImg" name="productImg" accept=".jpg,.jpeg,.png">
                            </div>
                            <div class="mb-3">
                                <label for="productSubCatId" class="form-label">Assign Sub Category</label>
                                <select name="productSubCatId" id="productSubCatId" class="form-select">
                                    <?php
                                    $subCatFetch = "select subCatName,subCatId from `product_sub_category_db` where subCatStatus=1 and deleted=0;";
                                    require("../../../functions/conn.php");
                                    $subCatData = $connection->query($subCatFetch);
                                    while ($row = $subCatData->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['subCatId'] ?>">
                                            <?php echo $row['subCatName'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productCatId" class="form-label">Assign Sub Category</label>
                                <select name="productCatId" id="productCatId" class="form-select">
                                    <?php
                                    $catFetch = "select catName,catId from `product_category_db` where catStatus=1 and deleted=0;";
                                    require("../../../functions/conn.php");
                                    $catData = $connection->query($catFetch);
                                    while ($row = $catData->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['catId'] ?>">
                                            <?php echo $row['catName'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productStatus" class="form-label">Status</label>
                                <select name="productStatus" id="productStatus" class="form-select">
                                    <option value="1" <?php echo $row["productStatus"] === "1" ? "selected" : ""; ?>>Active</option>
                                    <option value="0" <?php echo $row["productStatus"] === "0" ? "selected" : ""; ?>>InActive</option>
                                </select>
                            </div>
                            <input type="hidden" name="uId" value="<?php echo $_GET["productId"]; ?> " />
                            <input type="submit" class="btn btn-primary" name="formSubmit" value="Submit" />
                        </form>
                    <?php
                    }
                    ?>
                </main>
                <?php
                require("../../components/footer.php");
                $_SESSION["sign_In_Pass_Err"] = false;
                footer();
                ?>
            </div>
        </div>
        <script>
            function openModal() {
                document.getElementById("myModal").style.display = "block";
                document.getElementsByClassName("mySlides")[0].style.display = "block";
            }

            function closeModal() {
                document.getElementById("myModal").style.display = "none";
                document.getElementsByClassName("mySlides")[0].style.display = "none";
            }

            function deletePic() {
                document.getElementById("myModal").style.display = "none";
                document.getElementById("productImg").style.display = "block";
                document.getElementsByClassName("mySlides")[0].style.display = "none";
                document.getElementsByClassName("column")[0].style.display = "none";
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../utils/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("Location:../../admin.php");
};
?>