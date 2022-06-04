<?php
function frontHead()
{
    $navArr = array("Home" => "index", "Contact" => "contact");
?>
    <!-- Header section -->
    <header class="header-section">
        <div class="container-fluid">
            <!-- logo -->
            <div class="site-logo">
                <img src="../../pictures/logo.jpg" alt="logo">
            </div>
            <!-- responsive -->
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <div class="header-right">
                <a href="./cart.php" class="card-bag">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <!-- <img src="../assets/img/icons/bag.png" alt=""> -->
                    <span>2</span>
                </a>
                <a href="#" class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <!-- <img src="../assets/img/icons/search.png" alt=""> -->
                </a>
                <?php if (isset($_SESSION["uId"])) {
                ?>
                    <a href="../../functions/logout.php" class="user"><i class="fa-solid fa-right-from-bracket"></i></a>
                <?php
                } else {
                ?>
                    <a href="../pages/signIn/signIn.php" class="user"><i class="fa-solid fa-right-to-bracket"></i></a>
                <?php
                }
                ?>
            </div>
            <!-- site menu -->
            <ul class="main-menu">
                <?php
                foreach ($navArr as $key => $val) {
                ?>
                    <li><a href="./<?php echo $val ?>.php" <?php echo $key === "Home" ? "style='text-decoration:underline'" : ""; ?>><?php echo $key ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </header>
    <!-- Header section end -->
<?php
}
?>