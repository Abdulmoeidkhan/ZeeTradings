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
                    <h2>Fill This Form to Update Category</h2>
                    <?php
                    $staffUserReq = "select * from `product_category_db` where catId='" . $_GET["catId"] . "';";
                    require("../../../functions/conn.php");
                    $data = $connection->query($staffUserReq);
                    while ($row = $data->fetch_assoc()) {
                    ?>
                        <form class="container-fluid" name="catUpdateForm" action="../../../functions/updateCategory.php" method="POST" id="catUpdateForm">
                        <div class="mb-3">
                            <label for="catName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="catName" name="catName" placeholder="Meezan" value="<?php echo $row["catName"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="catDesc" class="form-label">Category Description</label>
                            <textarea class="form-control" id="catDesc" name="catDesc" placeholder="Meezan is trusted company"><?php echo $row["catDesc"];?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="catShortDesc" class="form-label">Category Sub Description</label>
                            <textarea class="form-control" id="catShortDesc" name="catShortDesc" placeholder="Meezan is Good company"><?php echo $row["catShortDesc"];?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="catStatus" class="form-label">Status</label>
                            <select name="catStatus" id="catStatus" class="form-select">
                                <option value="1" <?php echo $row["catStatus"] === "1" ? "selected" : ""; ?>>Active</option>
                                <option value="0" <?php echo $row["catStatus"] === "0" ? "selected" : ""; ?>>InActive</option>
                            </select>
                        </div>
                        <input type="hidden" name="uId" value="<?php echo $_GET["catId"]; ?> " />
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