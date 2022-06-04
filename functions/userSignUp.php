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
$myuuid = guidv4();
if (isset($_REQUEST['formSubmit'])) {
    if ($_REQUEST['customerUserPass'] === $_REQUEST['customerUserConfirmPass']) {
        $_SESSION["sign_In_Pass_Err_Cust"] = false;
        require("./conn.php");
        $name = $_REQUEST['customerUserName'];
        $password = $_REQUEST['customerUserPass'];
        $contact = $_REQUEST['customerUserContact'];
        $email = $_REQUEST['customerUserEmail'];
        $customerId = $myuuid;
        $customerCreatedBy = $_SESSION["uId"];
        $customerAddQuery = "INSERT INTO customer_user_db VALUES(
                '" . $name . "',
                '" . $password . "',
                '" . $contact . "',
                '" . $customerId . "',
                '" . $email . "',
                CURRENT_TIMESTAMP,
                '" . $customerCreatedBy . "',
                CURRENT_TIMESTAMP,
                DEFAULT,
                DEFAULT);";
        echo $customerAddQuery;
        if ($posted = $connection->query($customerAddQuery)) {
            header("Location:../front/pages/index.php");
        } else {
            header("Location:../front/pages/signIn/index.php");
        }
    }
    else {
        $_SESSION["sign_In_Pass_Err_Cust"] = true;
        header("Location:../front/pages/signIn/index.php");
    };
}
