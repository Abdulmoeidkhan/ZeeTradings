<?php
session_start();

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function merge($a, ...$b)
{
    return array_merge($a, $b);
}

$myuuid = guidv4();
if (isset($_SESSION["uId"])) {
    // print_r($_SESSION['cart']);
    $_SESSION['totalAmount'] = 0;
    require("../conn.php");
    foreach ($_REQUEST as $updateQuanKey => $updateQuanVal) {
        // echo ($updateQuanKey);
        // echo ($updateQuanVal);
        $_SESSION['cart'][$updateQuanKey]['quantity'] = $updateQuanVal;
    }
    foreach ($_SESSION['cart'] as $iteration) {
        $_SESSION['totalAmount'] += $iteration['quantity'] * $iteration['amount'];
    }
    $orderQuer = "INSERT INTO `order_db` 
    VALUES ('" . $myuuid . "', NULL, '" . $_SESSION['uId'] . "', '0', '1',
     NULL, NULL, '" . $_SESSION['uId'] . "', current_timestamp(),
      current_timestamp(), NULL, '" . $_SESSION['totalAmount'] . "', '0', '0');";
    if ($order = $connection->query($orderQuer)) {
        foreach ($_SESSION['cart'] as $iteration) {
            $transQuery = "INSERT INTO `order_transaction_db` 
              (`transId`, `transCreateBy`, `transCreateTime`, `transUpdateBy`, `transUpdateTime`,
               `transAmount`, `transQuantity`, `transStatus`, `deleted`, `orderId`, `productId`, `transNumber`)
                VALUES ('" . guidv4() . "', '" . $_SESSION['uId'] . "', current_timestamp(), '', current_timestamp(),
                 '" . ($iteration['quantity'] * $iteration['amount']) . "', '" . $iteration['quantity'] . "', '1', '0', '" . $myuuid . "', '" . $iteration['id'] . "', NULL);";
            // echo $transQuery;
            // echo "<br/> <br/>";
            if ($trans = $connection->query($transQuery)) {
                $_SESSION['cart']=[];
                // header("Location:../../front/pages/");
            }
        }
    }



    // $caryarray = ['id' => $_REQUEST['productId'], 'quantity' => $_REQUEST["productQuan"], 'amount' => $_REQUEST['productAmount']];
    // if (array_key_exists($_REQUEST['productId'], $_SESSION['cart'])) {
    //     $_SESSION['cart'][$_REQUEST['productId']]['quantity'] += 1;
    // } else {
    //     $_SESSION['cart'][$_REQUEST['productId']] = $caryarray;
    // }
    // foreach ($_SESSION['cart'] as $iteration) {
    //     $_SESSION['totalAmount'] += $iteration['quantity'] * $iteration['amount'];
    // }
    // echo (count($_SESSION['cart']));
} else {
    $_SESSION["sign_In_Pass_Err"] = true;
    header("Location:../admin/pages/adminHome/adminHome.php");
};
