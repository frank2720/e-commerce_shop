<?php

require __DIR__ . '/../src/bootstrap.php';

$stmt = db()->prepare('SELECT * FROM products ORDER BY time_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php view('page_header', ['title' => 'Home']) ?>

<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="home.php?page=products">Products</a>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <?=getcategories()?>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div class="input-group-text border-0">
            <form action="display_search.php" method="get">
                <input type="search" placeholder="search product" name="search_product" />
                <input type="submit" name="search_data_product" value="search"/>
            </form>
        </div>
        
        <div class ="link-icons">
            <a href="home.php?page=cart">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>

        <div class="link-icons">
            <a href="home.php?page=profile"><i class="fas fa-user-circle"></i>Profile</a>
        </div>
        <?php
        if (isset($_SESSION['loggedin'])) {
            echo "<div class='link-icons'>
            <a href='logout.php'><i class='fa fa-sign-out'></i>Logout</a>
            </div>
            ";
        }else {
            echo "<div class='link-icons'>
            <a href='userauth/login.html'><i class='fa fa-sign-in'></i>Login</a>
            </div>
            ";
        }
        ?> 
    </div>
</header>
      
        <main>
        <div class="featured">
            <h2>Gadgets</h2>
            <p>Essential gadgets for everyday use</p>
        </div>
        <div class="recentlyadded content-wrapper">
            <h2>Recently Added Products</h2>
            <div class="products">
                <?php foreach ($recently_added_products as $product): ?>
                    <a href="home.php?page=product_details&product_id=<?=$product['product_id']?>" class="product">
                    <img src="admin_page/actions/<?=$product['product_image']?>" width="200" height="200" alt="<?=$product['product_name']?>">
                    <span class="name"><?=$product['product_name']?></span>
                    <span class="price">
                        Ksh <?=number_format($product['price'])?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">Ksh <?=number_format($product['rrp'])?></span>
                            <?php endif; ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        </main>
<?php view('page_footer') ?>