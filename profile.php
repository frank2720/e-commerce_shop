<?php
include_once 'functions/common.php';
include_once 'database/connection.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: userauth/login.html');
    exit;
}
$ses_id = $_SESSION['id'];

$stmt = $conn->prepare('SELECT * FROM accounts WHERE id=?');
$stmt->bindParam(1,$ses_id);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
</header>
<main>
<div class="content">
    <h2>Profile Page</h2>
    <div class="loggedin">
        <p>Your account details are below:</p>
        <table>
            <?php foreach($user as $user):?>
            <tr>
                <td>Username:</td>
                <td><?=$_SESSION['name']?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?=$user['email']?></td>
            </tr>
            <tr>
                <td>Phone number:</td>
                <td><?=$user['phone']?></td>
            </tr>
            <?php endforeach;?>
        </table>
	</div>
</div>
</main>

<?=template_footer()?>