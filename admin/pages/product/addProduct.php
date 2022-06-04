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
                    <h2>Fill this Form to Add Product</h2>
                    <form class="container-fluid" name="productForm" action="../../../functions/addproduct.php" method="POST" id="productForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Meezan">
                        </div>
                        <div class="mb-3">
                            <label for="productDesc" class="form-label">Product Description</label>
                            <textarea class="form-control" id="productDesc" name="productDesc" placeholder="Meezan is trusted company"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productShortDesc" class="form-label">Product Sub Description</label>
                            <textarea class="form-control" id="productShortDesc" name="productShortDesc" placeholder="Meezan is Good company"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productImg" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImg" name="productImg" accept=".jpg,.jpeg,.png">
                        </div>
                        <div class="mb-3">
                            <label for="productAmount" class="form-label">Product Amount</label>
                            <input type="number" class="form-control" id="productAmount" name="productAmount" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPacking" class="form-label">Product Packing</label>
                            <input type="number" class="form-control" id="productPacking" name="productPacking" required>
                        </div>
                        <div class="mb-3">
                            <label for="productQuan" class="form-label">Product Quantity</label>
                            <input type="number" class="form-control" id="productQuan" name="productQuan" required>
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
                            <label for="productCatId" class="form-label">Assign Category</label>
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
                        <input type="submit" class="btn btn-primary" name="formSubmit" value="Submit" />
                    </form>
                </main>
                <?php
                require("../../components/footer.php");
                footer();
                ?>
            </div>
        </div>
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