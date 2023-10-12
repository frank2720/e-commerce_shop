<?php

require __DIR__ . '/../src/bootstrap.php';

$stmt = db()->prepare('SELECT * FROM products ORDER BY time_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php view('page_header', ['title' => 'Home']) ?>

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

<!-- carousel -->
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-mdb-ride="carousel">
  <div class="carousel-indicators">
    <button
      type="button"
      data-mdb-target="#carouselExampleCaptions"
      data-mdb-slide-to="0"
      class="active"
      aria-current="true"
      aria-label="Slide 1"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselExampleCaptions"
      data-mdb-slide-to="1"
      aria-label="Slide 2"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselExampleCaptions"
      data-mdb-slide-to="2"
      aria-label="Slide 3"
    ></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg" class="d-block w-100" alt="Wild Landscape"/>
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
      <div class="carousel-caption d-none d-sm-block mb-5">
        <h1 class="mb-4">
                <strong>Shopping at your confort</strong>
              </h1>

              <p>
                <strong>Essential gadgets for everyday use.</strong>
              </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg" class="d-block w-100" alt="Camera"/>
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
      <div class="carousel-caption d-none d-md-block mb-5">
        <h1 class="mb-4">
                <strong>Shopping at your confort</strong>
              </h1>

              <p>
                <strong>Essential gadgets for everyday use.</strong>
              </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg" class="d-block w-100" alt="Exotic Fruits"/>
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
      <div class="carousel-caption d-none d-md-block mb-5">
        <h1 class="mb-4">
                <strong>Shopping at your confort</strong>
              </h1>

              <p>
                <strong>Essential gadgets for everyday use.</strong>
              </p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

 <!--Main layout-->
<main>
<div class="container">
<h2 class="mt-4 mb-4 text-center"><strong>Recently Added Products</strong></h2>
<!-- Products -->
  <section>
  <div class="text-center">

    <div class="row">
    <?php foreach ($recently_added_products as $product): ?>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="admin_page/actions/<?=$product['product_image']?>"
            width="371" height="390"
              class="w-100" />
            <a href="product_details.php?product_id=<?=$product['product_id']?>">              
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                <?php if ($product['rrp'] > $product['price']): ?>
                  <h5>
                    <span class="badge sale-badge ms-2">
                      <?=round((($product['price']/$product['rrp'])*100)-100)?>%
                    </span>
                  </h5>
                <?php endif; ?>
                </div>
              </div>

            <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="product_details.php?product_id=<?=$product['product_id']?>" class="text-reset">
              <h5 class="card-title mb-2"><?=ucfirst(strtolower($product['product_name']))?></h5>
            </a>
            <h6 class="mb-3 price">
            <?php if ($product['rrp'] > $product['price']): ?>
              <s>KES<?=number_format($product['rrp'])?></s>
            <?php endif; ?>
              <strong class="ms-2 sale">KES <?=number_format($product['price'])?></strong>
            </h6>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
    
  </div>
</section>
  
<!-- Pagination -->
  <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>  
<!-- Pagination -->  
</div>
</main>
 <!--Main layout-->
 <?php view('page_footer') ?>