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
                    <h2>Fill This Form To Add Sub Category</h2>
                    <form class="container-fluid" name="subCatForm" action="../../../functions/addSubCat.php" method="POST" id="subCatForm">
                        <div class="mb-3">
                            <label for="subCatName" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" id="subCatName" name="subCatName" placeholder="Hot">
                        </div>
                        <div class="mb-3">
                            <label for="subCatDesc" class="form-label">Sub Category Description</label>
                            <textarea class="form-control" id="subCatDesc" name="subCatDesc" placeholder="Most Wanted"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="staffCatStatus" class="form-label">Status</label>
                            <select name="staffCatStatus" id="staffCatStatus" class="form-select">
                                <option value="0">Active</option>
                                <option value="1">InActive</option>
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