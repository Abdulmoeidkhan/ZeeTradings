<?php
session_start();
if (isset($_SESSION["uId"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../utils/css/styles.css" rel="stylesheet" />
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
                    <div class="container-fluid px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mt-4">Product List</h2>
                            <a class="btn btn-primary" href="./addProduct.php" role="button">+ Add Product</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                All Product List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Short Description</th>
                                            <th>Amount</th>
                                            <th>Create Time</th>
                                            <th>Create By</th>
                                            <th>Update Time</th>
                                            <th>Updated By</th>
                                            <th>Status</th>
                                            <th>Picture</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Short Description</th>
                                            <th>Amount</th>
                                            <th>Create Time</th>
                                            <th>Create By</th>
                                            <th>Update Time</th>
                                            <th>Updated By</th>
                                            <th>Status</th>
                                            <th>Picture</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ProductFetch = "
                                        select 
                                        p.productName, 
                                        p.productDesc, 
                                        p.productShortDesc, 
                                        p.productId, 
                                        p.productStatus, 
                                        p.productAmount, 
                                        p.productImg, 
                                        p.productAddedTime, 
                                        p.productUpdateTime, 
                                        s.staffName as st1, 
                                        st.staffName as st2, 
                                        c.catName as catName, 
                                        sc.subCatName as subCatName 
                                        from `product_db` as p 
                                        left join staff_user_db as s on p.productAddedBy=s.stafFId 
                                        left join staff_user_db as st on p.productUpdateBy=st.stafFId 
                                        left join product_sub_category_db as sc on p.productSubCatId=sc.subCatId 
                                        left join product_category_db as c on p.productCatId=c.catId 
                                        WHERE p.deleted=0;";
                                        require("../../../functions/conn.php");
                                        $data = $connection->query($ProductFetch);
                                        if ($data) {
                                            while ($row = $data->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productDesc"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productShortDesc"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productAmount"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productAddedTime"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["st1"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productUpdateTime"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["st2"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productStatus"] == "1" ? "Active" : "InActive" ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <img src="<?php echo $row["productImg"]; ?>" width="100" height="100" onclick="openModal('<?php echo $row['productId'] ?>')" class="hover-shadow" />
                                                        </div>
                                                        <div id="<?php echo $row['productId'] ?>" class="modal">
                                                            <span class="close cursor" onclick="closeModal('<?php echo $row['productId'] ?>')">&times;</span>
                                                            <div class="modal-content">
                                                                <div id="mySlides-<?php echo $row['productId'] ?>">
                                                                    <img src="<?php echo $row["productImg"]; ?>" style="width:100%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["subCatName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo ($_SESSION["uRole"] === "Super" || $_SESSION["uRole"] === "Admin") ?
                                                            '
                                                        <a class="btn btn-outline-success" href="./editProduct.php?productId=' . $row["productId"] . '">Edit</a>
                                                        &nbsp;
                                                        <button class="btn btn-outline-danger" onclick="deleteFunc(`' . $row["productId"] . '`)">Delete</a>
                                                        '
                                                            : "<div class='d-flex justify-content-center'>You Can't Perform any action !!</div>";
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                require("../../components/footer.php");
                footer();
                ?>
            </div>
        </div>
        <script>
            function deleteFunc(id) {
                let valToBeCheck = prompt('Type delete To Delete User');
                if (valToBeCheck === 'delete') {
                    window.loProduction.href = '../../../functions/deleteProduct.php?productId=' + id;
                }
            }
        </script>
        <script>
            function openModal(id) {
                document.getElementById(id).style.display = "block";
                document.getElementById("mySlides-" + id).style.display = "block";
            }

            function closeModal(id) {
                document.getElementById(id).style.display = "none";
                document.getElementById("mySlides-" + id).style.display = "none";
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../utils/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../utils/js/datatables-simple-demo.js"></script>

    </body>

    </html>
<?php } else {
    header("Location:../../admin.php");
};
?>