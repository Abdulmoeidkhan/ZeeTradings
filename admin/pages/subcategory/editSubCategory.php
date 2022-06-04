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
                    <h2>Fill This Form to Update Sub Category</h2>
                    <?php
                    $subCatReq = "select * from `product_sub_category_db` where subCatId='" . $_GET["subCatId"] . "';";
                    require("../../../functions/conn.php");
                    $data = $connection->query($subCatReq);
                    while ($row = $data->fetch_assoc()) {
                    ?>
                        <form class="container-fluid" name="subCatUpdateForm" action="../../../functions/updateSubCategory.php" method="POST" id="subCatUpdateForm">
                            <div class="mb-3">
                                <label for="subCatName" class="form-label">Sub Category Name</label>
                                <input type="text" class="form-control" id="subCatName" name="subCatName" placeholder="Meezan" value="<?php echo $row["subCatName"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="subCatDesc" class="form-label">Sub Category Description</label>
                                <textarea class="form-control" id="subCatDesc" name="subCatDesc" placeholder="Meezan is trusted company"><?php echo $row["subCatDesc"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="catSubCat" class="form-label">Assign Sub Category</label>
                                <select name="catSubCat" id="catSubCat" class="form-select">
                                    <?php
                                    $subCatFetch = "select subCatName,subCatId from `product_sub_category_db` where subCatStatus=1 and deleted=0;";
                                    require("../../../functions/conn.php");
                                    $data2 = $connection->query($subCatFetch);
                                    while ($row2 = $data2->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row2['subCatId'] ?>" <?php echo $row2['subCatId'] === $row["subCatId"] ? "selected" : "" ?>>
                                            <?php echo $row2['subCatName'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subCatStatus" class="form-label">Status</label>
                                <select name="subCatStatus" id="subCatStatus" class="form-select">
                                    <option value="1" <?php echo $row["subCatStatus"] === "1" ? "selected" : ""; ?>>Active</option>
                                    <option value="0" <?php echo $row["subCatStatus"] === "0" ? "selected" : ""; ?>>InActive</option>
                                </select>
                            </div>
                            <input type="hidden" name="uId" value="<?php echo $_GET["subCatId"]; ?> " />
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