<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();

?>
<?=template_header('Profile')?>
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="main.php">Home</a>
            <a href="main.php?page=products">Products</a>
        </nav>
        <div class="link-icons">
            <a href="main.php?page=cart">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>
        <div class="link-icons">
            <a href="logout.php"><i class="fa fa-sign-out"></i></a>
        </div>
    </div>
</header>
<main>
<div class="content">
    <h2>Profile Page</h2>
    <div class="loggedin">
        <p>Your account details are below:</p>
        <table>
            <tr>
                <td>Username:</td>
                <td><?= current_user() ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>email</td>
            </tr>
            <tr>
                <td>Phone number:</td>
                <td>number</td>
            </tr>
        </table>
	</div>
</div>
</main>

<?=template_footer()?>