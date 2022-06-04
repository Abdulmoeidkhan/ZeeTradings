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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../utils/css/styles.css" rel="stylesheet" />
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
                    <div class="container-fluid px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mt-4">Category List</h2>
                            <a class="btn btn-primary" href="./addCategory.php" role="button">+ Add Category</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                All Category List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Short Description</th>
                                            <th>Create Time</th>
                                            <th>Create By</th>
                                            <th>Updated By</th>
                                            <th>Update Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Short Description</th>
                                            <th>Create Time</th>
                                            <th>Create By</th>
                                            <th>Updated By</th>
                                            <th>Update Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $catListFetch = "select 
                                        p.catName,
                                        p.catDesc,
                                        p.catShortDesc,
                                        p.catCreateTime,
                                        p.catUpdateTime,
                                        p.catId,
                                        p.catStatus,
                                        s.staffName as st1,
                                        st.staffName as st2
                                        from `product_category_db` as p 
                                        left join staff_user_db as s
                                        on p.catAddedBy=s.stafFID 
                                        left join staff_user_db as st
                                        on p.catUpdateBy=st.stafFID
                                        where p.deleted=0
                                        ;";
                                        require("../../../functions/conn.php");
                                        $data = $connection->query($catListFetch);
                                        if ($data) {
                                            while ($row = $data->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catDesc"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catShortDesc"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catCreateTime"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["st1"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["st2"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catUpdateTime"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["catStatus"] == "1" ? "Active" : "InActive" ?></div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo ($_SESSION["uRole"] === "Super" || $_SESSION["uRole"] === "Admin") ?
                                                            '
                                                            <div class="d-flex justify-content-center">
                                                        <a class="btn btn-outline-success" href="./editCategory.php?catId=' . $row["catId"] . '">Edit</a>
                                                    &nbsp;
                                                    <button class="btn btn-outline-danger" onclick="deleteFunc(`' . $row["catId"] . '`)">Delete</button>
                                                    </div>
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
                console.log(id);
                if (valToBeCheck === 'delete') {
                    window.location.href = '../../../functions/deleteCategory.php?catId=' + id;
                }
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