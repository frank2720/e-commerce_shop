<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();

?>
<?php view('page_header', ['title' => 'Profile']) ?>
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="products.php">Products</a>
        </nav>
        <div class="link-icons">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>
        
        <div class="link-icons">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<div class='dropdown'>
                <a class='nav-link dropdown-toggle' href='' id='profiledetails' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <img style='height: 1.5em;display: inline-block' src='imgs/profile.png'>
                <b>".ucfirst($_SESSION['username'])."</b>
                </a>
                <ul class='dropdown-menu' aria-labelledby='profiledetails'>
                    <li><a class='dropdown-item' href='profile.php'>Account</a></li>
                    <hr>
                    <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                </ul>
                </div>";
            }else {
                echo "<a href='login.php'></i><b>Login </b>|<b> Signup</b></a>";
            }   
            ?>
        </div>

    </div>
</header>
<main>
<div class="content">
    <h2>Profile Page</h2>
    <div class="loggedin">
        <p>Your account details:</p>
        <table>
            <tr>
                <td>Username:</td>
                <td><?= current_user() ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>.....</td>
            </tr>
            <tr>
                <td>Phone number:</td>
                <td>.......</td>
            </tr>
        </table>
	</div>
</div>
</main>

<?php view('page_footer') ?>