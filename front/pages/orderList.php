<?php
session_start();
if (!isset($_SESSION["uId"])) {
    header("Location:signIn/signIn.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>The Plaza - eCommerce Template</title>
        <meta charset="UTF-8">
        <meta name="description" content="The Plaza eCommerce Template">
        <meta name="keywords" content="plaza, eCommerce, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
        <link href="../assets/img/favicon.ico" rel="shortcut icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" />


        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i">
        <!-- <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> -->

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
        <link rel="stylesheet" href="../assets/css/animate.css" />
        <link rel="stylesheet" href="../assets/css/styles.css" />
        <link rel="stylesheet" href="../assets/css/style.css" />

        <!-- Top Button CSS -->

        <style>
            html {
                scroll-behavior: smooth;
            }

            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;

            }

            #myTopBtn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 18px;
                border: none;
                outline: none;
                color: white;
                cursor: pointer;
                padding: 15px;
                border-radius: 4px;
                background: #a36ec8;
                background: -webkit-linear-gradient(top left, #a36ec8, #ca7bce);
                background: -moz-linear-gradient(top left, #a36ec8, #ca7bce);
                background: linear-gradient(to bottom right, #a36ec8, #ca7bce);

            }

            #myTopBtn:hover {
                background-color: #555;
            }
        </style>


        <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    </head>

    <body>

        <!-- Top Button -->
        <button onclick="topFunction()" id="myTopBtn" title="Go to top">&#8593;</button>

        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>


        <?php
        include('../components/navBar.php');
        frontHead("My Orders"); ?>

        <main class="container-fluid" style='margin-top:150px;'>
            <div class="container-fluid px-4">
                <!-- <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mt-4">Order List</h2>
                    <a class="btn btn-primary" href="./addorder.php" role="button">+ Add Order</a>
                </div> -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Order List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Customer</th>
                                    <th>Order Type</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Customer</th>
                                    <th>Order Type</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $orderFetch = "
                                        select 
                                        o.orderId, 
                                        o.orderNumber, 
                                        o.orderType, 
                                        o.orderAmount, 
                                        o.orderPaidAmount,  
                                        c.customerName as customerName, 
                                        c.customerId as customerId
                                        from `order_db` as o 
                                        left join customer_user_db as c on o.orderCustomer=c.customerId  
                                        WHERE o.deleted=0 and o.orderCustomer='" . $_SESSION["uId"] . "';";
                                require("../../functions/conn.php");
                                $data = $connection->query($orderFetch);
                                if ($data) {
                                    while ($row = $data->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center"><?php echo $row["orderNumber"] ?></div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center"><?php echo $row["customerName"] ?></div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center"><?php echo $row["orderType"] == 0 ? "Order" : "Invoice"; ?></div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center"><?php echo $row["orderAmount"] ?></div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center"><?php echo $row["orderPaidAmount"] ?></div>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-primary" href="./order.php?orderId='<?php echo $row["orderId"] ?> '">Show</a>
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
        require("../components/footer.php");
        footer();
        ?>


        <!--====== Javascripts & Jquery ======-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/mixitup.min.js"></script>
        <script src="../assets/js/sly.min.js"></script>
        <script src="../assets/js/jquery.nicescroll.min.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>

    </body>

    </html>
<?php
}
?>