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
                    <h2>Fill this Form to Add Cutomer</h2>
                    <form class="container-fluid" name="customerUserForm" action="../../../functions/addCustomer.php" method="POST" id="customerUserForm">
                        <div class="mb-3">
                            <label for="customerUserName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="customerUserName" name="customerUserName" aria-describedby="nameHelp" placeholder="Mark Gate ...">
                        </div>
                        <div class="mb-3">
                            <label for="customerUserEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="customerUserEmail" name="customerUserEmail" aria-describedby="emailHelp" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" title="Invalid email address" placeholder="mark@gate.com">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="customerUserPass" class="form-label">Password</label>
                            <input type="password" autocomplete="new-password" class="form-control" id="customerUserPass" name="customerUserPass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" required>
                            <?php echo (isset($_SESSION["sign_In_Pass_Err_Cust"]) && $_SESSION["sign_In_Pass_Err_Cust"] === true) ? "<div class='invalid-entry'>Password Not Match.</div>" : ""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="customerUserConfirmPass" class="form-label">Confirm Password</label>
                            <input type="password" autocomplete="new-password" class="form-control" id="customerUserConfirmPass" name="customerUserConfirmPass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" required>
                            <?php echo (isset($_SESSION["sign_In_Pass_Err_Cust"]) && $_SESSION["sign_In_Pass_Err_Cust"] === true) ? "<div class='invalid-entry'>Confirm Password Not Match.</div>" : ""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="customerUserContact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="customerUserContact" name="customerUserContact" title="Invalid Contact Number" pattern="[0-9]{12}" required placeholder="923170281611">
                        </div>
                        <input type="submit" class="btn btn-primary" name="formSubmit" value="Submit" />
                    </form>
                </main>
                <?php
                require("../../components/footer.php");
                $_SESSION["sign_In_Pass_Err_Cust"] = false;
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