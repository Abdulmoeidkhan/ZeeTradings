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
                    <h2>Fill this Form to Add Brand</h2>
                    <form class="container-fluid" name="brandForm" action="../../../functions/addBrand.php" method="POST" id="brandForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="brandName" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Meezan">
                        </div>
                        <div class="mb-3">
                            <label for="brandDesc" class="form-label">Brand Description</label>
                            <textarea class="form-control" id="brandDesc" name="brandDesc" placeholder="Meezan is trusted company"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="brandShortDesc" class="form-label">Brand Sub Description</label>
                            <textarea class="form-control" id="brandShortDesc" name="brandShortDesc" placeholder="Meezan is Good company"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="brandImg" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" id="brandImg" name="brandImg" accept=".jpg,.jpeg,.png">
                        </div>
                        <div class="mb-3">
                            <label for="brandLegacy" class="form-label">Brand Legacy</label>
                            <input type="date" class="form-control" id="brandLegacy" name="brandLegacy" >
                        </div>
                        <div class="mb-3">
                            <label for="brandWeb" class="form-label">Brand Web</label>
                            <input type="url" class="form-control" id="brandWeb" name="brandWeb">
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
    header("Location: ../../admin.php");
};
?>