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
                    <h2>Fill This Form to Update Brand</h2>
                    <?php
                    $brandFetch = "select * from `brand_db` where brandId='" . $_GET["brandId"] . "';";
                    require("../../../functions/conn.php");
                    $data = $connection->query($brandFetch);
                    while ($row = $data->fetch_assoc()) {
                    ?>
                        <form class="container-fluid" name="brandUpdateForm" action="../../../functions/updatebrand.php" method="POST" id="brandUpdateForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Meezan" value="<?php echo $row["brandName"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="brandDesc" class="form-label">Brand Description</label>
                                <textarea class="form-control" id="brandDesc" name="brandDesc" placeholder="Meezan is trusted company"><?php echo $row["brandDesc"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="brandShortDesc" class="form-label">Brand Short Description</label>
                                <textarea class="form-control" id="brandShortDesc" name="brandShortDesc" placeholder="Meezan is Good company"><?php echo $row["brandShortDesc"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="brandWeb" class="form-label">Brand Web Address</label>
                                <input type="url" class="form-control" id="brandWeb" name="brandWeb" placeholder="Meezan" value="<?php echo $row["brandWeb"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="brandLegacy" class="form-label">Brand Legacy</label>
                                <input type="date" class="form-control" id="brandLegacy" name="brandLegacy" value="<?php echo $row["brandLegacy"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="brandWeb" class="form-label">Brand Image</label>
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
                                <div class="column">
                                    <div>
                                        <img src="<?php echo $row["brandImg"]; ?>" width="100" onclick="openModal()" class="hover-shadow" />
                                        <span class="cursor" style="color:black;" onclick="deletePic()">&times;</span>
                                    </div>
                                </div>
                                <div id="myModal" class="modal">
                                    <span class="close cursor" onclick="closeModal()">&times;</span>
                                    <div class="modal-content">
                                        <div class="mySlides">
                                            <img src="<?php echo $row["brandImg"]; ?>" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                                <input type="file" class="form-control" style='display: <?php echo strlen($row["brandImg"])>1?"none":"block"; ?>' id="brandImg"  name="brandImg" accept=".jpg,.jpeg,.png">
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
                                        document.getElementById("brandImg").style.display = "block";
                                        document.getElementsByClassName("mySlides")[0].style.display = "none";
                                        document.getElementsByClassName("column")[0].style.display = "none";
                                    }
                                </script>
                            </div>
                            <div class="mb-3">
                                <label for="brandStatus" class="form-label">Status</label>
                                <select name="brandStatus" id="brandStatus" class="form-select">
                                    <option value="1" <?php echo $row["brandStatus"] === "1" ? "selected" : ""; ?>>Active</option>
                                    <option value="0" <?php echo $row["brandStatus"] === "0" ? "selected" : ""; ?>>InActive</option>
                                </select>
                            </div>
                            <input type="hidden" name="uId" value="<?php echo $_GET["brandId"]; ?> " />
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