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
                            <h2 class="mt-4">Order List</h2>
                            <a class="btn btn-primary" href="./addorder.php" role="button">+ Add Order</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                All Order List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Transaction Number</th>
                                            <th>Transaction Customer</th>
                                            <th>Transaction Product</th>
                                            <th>Unit Price</th>
                                            <th>Unit Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Order Number</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Transaction Number</th>
                                            <th>Transaction Customer</th>
                                            <th>Transaction Product</th>
                                            <th>Unit Price</th>
                                            <th>Unit Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Order Number</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        require("../../../functions/conn.php");
                                        $orderFetch = "
                                        select 
                                        t.transId, 
                                        t.transStatus,  
                                        t.transNumber, 
                                        t.transAmount,
                                        t.transQuantity,
                                        c.customerName as customerName, 
                                        p.productName as productName, 
                                        p.productAmount as productAmount,
                                        o.orderNumber as orderNumber
                                        from `order_transaction_db` as t 
                                        left join customer_user_db as c on t.transCreateBy=c.customerId  
                                        left join product_db as p on t.productId=p.productId  
                                        left join order_db as o on t.orderId=o.orderId  
                                        WHERE t.deleted=0 and t.transStatus=1;";
                                        $data = $connection->query($orderFetch);
                                        if ($data) {
                                            while ($row = $data->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["transNumber"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["customerName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productName"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["productAmount"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["transQuantity"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["transAmount"] ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center"><?php echo $row["orderNumber"] ?></div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo ($_SESSION["uRole"] === "Super" || $_SESSION["uRole"] === "Admin") ?
                                                            '
                                                            <a class="btn btn-outline-primary" href="./order.php?transId=' . $row["transId"] . '">Show</a>
                                                        &nbsp;
                                                        <a class="btn btn-outline-success" href="./editOrder.php?transId=' . $row["transId"] . '">Edit</a>
                                                        &nbsp;
                                                        <button class="btn btn-outline-danger" onclick="deleteFunc(`' . $row["transId"] . '`)">Delete</a>
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
                    window.location.href = '../../../functions/deleteOrder.php?transId=' + id;
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