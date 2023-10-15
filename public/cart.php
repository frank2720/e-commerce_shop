<?php

require __DIR__ . '/../src/bootstrap.php';

cart();
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = db()->prepare('SELECT * FROM products WHERE product_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['product_id']];
    }
}
?>

<?php view('page_header', ['title' => 'Cart details']) ?>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
  <!-- Container wrapper -->
  <div class="container">    
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent1"
      aria-controls="navbarSupportedContent1"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">      
      <!-- Navbar brand -->
      
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link " href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            Categories
          </a>
          <!-- Dropdown menu -->
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=getcategories()?>
          </ul>
        </li>
      </ul>
      <!-- Left links -->      
    </div>
    <!-- Collapsible wrapper -->

    <form action="display_search.php" method="get" class="d-flex input-group w-auto">
      <input
        type="search"
        class="form-control rounded"
        placeholder="Search products"
        aria-label="Search"
        aria-describedby="search-addon"
        name="search_product"
      />
      <span class="input-group-text border-0" id="search-addon">
      <input type="submit" name="search_data_product" value="search"/></i>
      </span>
    </form>
    
    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="nav-link me-3" href="cart.php">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge rounded-pill badge-notification bg-danger"><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
      </a>

      <?php
            if (isset($_SESSION['username'])) {
                echo "<div class='dropdown'>
                <a class='dropdown-toggle d-flex align-items-center hidden-arrow' href='' id='profiledetails' role='button' data-mdb-toggle='dropdown' aria-expanded='false'>
                <img class='rounded-circle' height='25' loading='lazy' src='imgs/profile.png'>
                <b>".ucfirst(strtolower($_SESSION['username']))."</b>
                </a>
                <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='profiledetails'>
                    <li><a class='dropdown-item' href='profile.php'>My profile</a></li>
                    <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                </ul>
                </div>";
            }else {
                echo "<button type='button' class='btn btn-link px-3 me-2'>
                <a href='login.php'></i><b>Login </b>|<b> Signup</b></a>
              </button>";
            }   
        ?>
    </div>
    <!-- Right elements -->
    
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?> items</h6>
                </div>
                    <form action="cart.php" method="post">
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <td>Product</td>
                                    <td>Price</td>
                                    <td>Quantity</td>
                                    <td>Total</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($products)): ?>
                                    <tr>
                                        <td><h6 class="text-black mb-0 text-center">You have no products added in your Shopping Cart</h6></td>
                                    </tr>
                                <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                            <a href="product_details.php?product_id=<?=$product['product_id']?>">
                                            <img src="admin_page/actions/<?=$product['product_image']?>" alt="<?=$product['product_name']?>"
                                            style="width: 45px; height: 45px"
                                            class="rounded-circle"/>
                                            </a>
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?=$product['product_name']?></p>
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">Ksh <?=number_format($product['price'])?></p>
                                        </td>
                                        <td>
                                            <input  min="1" max="<?=$product['quantity']?>" name="quantity-<?=$product['product_id']?>" value="<?=$products_in_cart[$product['product_id']]?>" type="number"
                                            class="form-control form-control-sm" />
                                        </td>
                                        <td>
                                            <h6 class="mb-0">Ksh <?=number_format($product['price'] * $products_in_cart[$product['product_id']])?></h6>
                                        </td>
                                        <td>
                                            <a href="cart.php?remove=<?=$product['product_id']?>" class="text-muted"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div  class="position-relative position-relative-example pt-5">
                            <div class="position-absolute top-100 start-50 translate-middle">
                                <h6 class="mb-0">
                                    <a href="products.php" class="text-body">
                                        <i class="fas fa-long-arrow-alt-left me-2"></i>
                                        Back to shop
                                    </a>
                                </h6>
                            </div>
                            <div class="position-absolute top-100 start-100 translate-middle">
                                <input type="submit" value="Update" name="update" class="btn btn-dark btn-rounded">
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">

                  <h5 class="text-uppercase mb-3">Payment</h5>

                  <form action="cart.php" method="post">
                  <div class="mb-5">
                    <div class="form-outline">
                      <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Enter your M-PESA number</label>
                    </div>
                  </div>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5>Ksh <?=number_format($subtotal)?></h5>
                  </div>

                  <input type="submit" class="btn btn-dark btn-block btn-lg btn-rounded"
                    data-mdb-ripple-color="dark" value="Place Order" name="placeorder">
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php view('page_footer') ?>