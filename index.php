<?php
include_once 'functions/common.php';
include_once 'database/connection.php';
// Get the 4 most recently added products
$stmt = $conn->prepare('SELECT * FROM products ORDER BY time_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Pudfra-Shop')?>
        <header>
            <div class="content-wrapper">
                <h1>Pudfra-Shop</h1>
                <div class="link-icons">
                    <div class="input-group-text border-0">
                    <form action="display_search.php" method="get">
                        <input type="search" placeholder="search product" name="search_product" />
                        <button type="submit" name="search_data_product"><i class="fa fa-search"></i></button>
                    </form>
                    </div>
                    <a href="">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="main.php?page=cart">
                        <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
                    </a>
                </div>
            </div>
        </header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f5f5f5;">
            <!-- Container wrapper -->
            <div class="container justify-content-center justify-content-md-between">
                <!-- Toggle button -->
                <button 
                class="navbar-toggler border text-dark py-2"
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Hot offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Gift boxes</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark" href="main.php?page=products">Products</a>
                    </li>
                    <!-- Navbar dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu">
                            <?php
                            getcategories();
                            ?>
                        </ul>
                    </li>
                </ul>
                 <!-- Left links -->
                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Products -->
        <main>
        <div class="featured">
            <h2>Gadgets</h2>
            <p>Essential gadgets for everyday use</p>
        </div>
        <div class="recentlyadded content-wrapper">
            <h2>Recently Added Products</h2>
            <div class="products">
                <?php foreach ($recently_added_products as $product): ?>
                    <a href="main.php?page=product_details&product_id=<?=$product['product_id']?>" class="product">
                    <img src="admin_page/actions/<?=$product['product_image']?>" width="95%" height="200" alt="<?=$product['product_name']?>">
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
        
<?=template_footer()?>