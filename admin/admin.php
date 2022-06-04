<?php
session_start();
if (isset($_SESSION["uId"])) {
    header("Location:pages/adminHome/adminHome.php");
} else if (!isset($_SESSION["uId"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="./admin.css" rel="stylesheet" type="text/css" />
        <title>Admin</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center text-dark mt-5">ACCOUNTING SYSTEM</h2>
                    <div class="text-center mb-5 text-dark">Made with Thought</div>
                    <div class="card my-5">
                        <form class="card-body cardbody-color p-lg-5" action="../functions/signIn.php" method="POST">
                            <div class="text-center">
                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" id="Username" aria-describedby="emailHelp" placeholder="User Name" name='uName' required pattern="^[a-zA-Z0-9_ ]*$">
                                <?php if (isset($_SESSION["sign_In_Err"]) && !$_SESSION["sign_In_Err"]) { ?>
                                    <div class="invalid-entry">
                                        Please insert correct User Name.
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Password" name='uPass' required>
                                <?php if (isset($_SESSION["sign_In_Err"]) && !$_SESSION["sign_In_Err"]) { ?>
                                    <div class="invalid-entry">
                                        Please insert correct Password.
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100" name="Submit">Login</button></div>
                            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                                Registered? <a href="#" class="text-dark fw-bold"> Create an
                                    Account</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>
<?php


}
?>