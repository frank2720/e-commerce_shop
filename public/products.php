<?php

require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('page_header', ['title' => 'Products']) ?>

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

<!--Main layout-->
<main class="mt-5">
<br><br>
<div class="container">
<!-- Products -->
  <section>
  <div class="text-center">
  <h1 class="mb-3">Products</h1>
    <div class="row">
      <?=getproducts();?>
      <?=category_products();?>
    </div>
  </div>
</section> 
</div>
</main>
 <!--Main layout-->
<?php view('page_footer') ?>