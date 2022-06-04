<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="../../../functions/userSignUp.php">
                            <div class="form-group">
                                <label for="customerUserName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="customerUserName" id="customerUserName" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="customerUserEmail"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="customerUserEmail" id="customerUserEmail" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="customerUserContact"><i class="zmdi zmdi-phone"></i></label>
                                <input type="tel" name="customerUserContact" id="customerUserContact" placeholder="Your Contact"/>
                            </div>
                            <div class="form-group">
                                <label for="customerUserPass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="customerUserPass" id="customerUserPass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="customerUserConfirmPass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="customerUserConfirmPass" id="customerUserConfirmPass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="formSubmit" id="formSubmit" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="./signIn.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>