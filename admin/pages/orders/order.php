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
        <link href="../../utils/css/styles.css" rel="stylesheet" />
        <link href="./order.css" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
                <div id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-right">
                            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">

                            <main>
                                <div class="row contacts">
                                    <?php
                                    $orderFetch = "
                                        select 
                                        o.orderId, 
                                        o.orderNumber, 
                                        o.orderType, 
                                        o.orderAmount, 
                                        o.orderCreateTime,
                                        o.orderPaidAmount, 
                                        o.orderInvoiceAt, 
                                        c.customerName as customerName, 
                                        c.customerId as customerId,
                                        c.customerContact as customerContact,
                                        c.customerEmail as customerEmail
                                        from `order_db` as o 
                                        left join customer_user_db as c on o.orderCustomer=c.customerId  
                                        WHERE o.deleted=0 and o.orderId='" . $_GET['orderId'] . "';";
                                    require("../../../functions/conn.php");
                                    $orderdata = $connection->query($orderFetch);
                                    if ($orderdata) {
                                        while ($row = $orderdata->fetch_assoc()) {
                                    ?>
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">INVOICE TO:</div>
                                                <h2 class="to"><?php echo $row['customerName'] ?></h2>
                                                <div class="email"><a href="mailto:<?php echo $row['customerEmail'] ?>"><?php echo $row['customerEmail'] ?></a></div>
                                            </div>
                                            <div class="col invoice-details">
                                                <h1 class="invoice-id">INVOICE <?php echo $row['orderNumber']; ?></h1>
                                                <?php echo date("m/d/Y", (strtotime($row["orderInvoiceAt"]) + (60 * 60 * 24 * 30))); ?>
                                                <div class="date">Date of Invoice: <?php echo date("m/d/Y", strtotime($row["orderInvoiceAt"])) ?></div>

                                                <div class="date">Due Date: 30/10/2018</div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <table cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">PRODUCTS</th>
                                            <th class="text-right">UNIT PRICE</th>
                                            <th class="text-right">QUANTITY</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rowFetch = "
                                        select 
                                        t.transId, 
                                        t.transAmount, 
                                        t.transQuantity,
                                        p.productName as productName, 
                                        p.productDesc as productDesc, 
                                        p.productAmount as productAmount
                                        from `order_transaction_db` as t
                                        left join product_db as p on t.productId=p.productId  
                                        WHERE t.orderID='" . $_GET['orderId'] . "';";
                                        require("../../../functions/conn.php");
                                        $rowdata = $connection->query($rowFetch);
                                        if ($rowdata) {
                                            $rowNumber = 0;
                                            while ($row = $rowdata->fetch_assoc()) {
                                                $rowNumber++;
                                        ?>
                                                <tr>
                                                    <td class="no"><?php echo $rowNumber; ?></td>
                                                    <td class="text-left">
                                                        <h3>
                                                            <a target="_blank" href="#">
                                                                <?php echo $row['productName'] ?>
                                                            </a>
                                                        </h3>
                                                        <?php echo $row['productDesc'] ?>
                                                    </td>
                                                    <td class="unit">
                                                        <?php echo $row['productAmount'] ?>
                                                    </td>
                                                    <td class="qty">
                                                        <?php echo $row['transQuantity'] ?>
                                                    </td>
                                                    <td class="total">
                                                        <?php echo $row['transAmount'] ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        $countFetch = "
                                            select 
                                            t.transId,
                                            SUM(transAmount) as sumTotal 
                                            from `order_transaction_db` as t
                                            left join product_db as p on t.productId=p.productId  
                                            WHERE t.orderID='" . $_GET['orderId'] . "';";
                                        $countData = $connection->query($countFetch);
                                        while ($sumTotal = $countData->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">SUBTOTAL</td>
                                                <td><?php echo $sumTotal['sumTotal']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">GRAND TOTAL</td>
                                                <td><?php echo $sumTotal['sumTotal']; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tfoot>
                                </table>
                                <div class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div>
                            </main>
                            <footer>
                                Invoice was created on a computer and is valid without the signature and seal.
                            </footer>
                        </div>
                        <div></div>
                    </div>
                </div>

                <?php
                require("../../components/footer.php");
                footer();
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../utils/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:../../admin.php");
};
?>