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
                    <h2>Fill this Form to Add User</h2>
                    <form class="container-fluid" name="staffUserForm" action="../../../functions/addStaff.php" method="POST" id="staffUserForm">
                        <div class="mb-3">
                            <label for="staffUserName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="staffUserName" name="staffUserName" aria-describedby="emailHelp" placeholder="Mark Gate ...">
                        </div>
                        <div class="mb-3">
                            <label for="staffUserEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="staffUserEmail" name="staffUserEmail" aria-describedby="emailHelp" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" title="Invalid email address" placeholder="mark@gate.com">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="staffUserPass" class="form-label">Password</label>
                            <input type="password" autocomplete="new-password" class="form-control" id="staffUserPass" name="staffUserPass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" required>
                            <?php echo (isset($_SESSION["sign_In_Pass_Err"]) && $_SESSION["sign_In_Pass_Err"] === true) ? "<div class='invalid-entry'>Password Not Match.</div>":""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="staffUserConfirmPass" class="form-label">Confirm Password</label>
                            <input type="password" autocomplete="new-password" class="form-control" id="staffUserConfirmPass" name="staffUserConfirmPass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" required>
                            <?php echo (isset($_SESSION["sign_In_Pass_Err"]) && $_SESSION["sign_In_Pass_Err"] === true) ? "<div class='invalid-entry'>Confirm Password Not Match.</div>":""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="staffUserContact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="staffUserContact" name="staffUserContact" title="Invalid Contact Number" pattern="[0-9]{12}" required placeholder="923170281611">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="staffUserPic" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="staffUserPic" name="staffUserPic">
                        </div> -->
                        <div class="mb-3">
                            <label for="staffUserRole" class="form-label">Choose Staff Role</label>
                            <select name="staffUserRole" id="staffUserRole" class="form-select">
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" 
                        name="formSubmit" value="Submit"/>
                        <!-- style="visibility: hidden; width:0px;" -->
                    </form>
                    <!-- <button class="btn btn-primary" onclick="validate()">Submit</button> -->
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
        <!-- <script>
            function validate() {
                (document.getElementById("staffUserConfirmPass").value === document.getElementById("staffUserPass").value) ? document.getElementsByTagName("formSubmit")[0].click(): alert("Password and confirm Password is not matched ")
            }
        </script> -->
    </body>

    </html>
<?php } else {
    header("Location:../../admin.php");
};
?>