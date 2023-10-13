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
<main>
<div class="container">
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark mt-3 mb-5 shadow p-2" style="background-color: #607D8B">
  <!-- Container wrapper -->
  <div class="container-fluid">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="#">Categories:</a>

    <!-- Toggle button -->
    <button 
       class="navbar-toggler" 
       type="button" 
       data-mdb-toggle="collapse" 
       data-mdb-target="#navbarSupportedContent2" 
       aria-controls="navbarSupportedContent2" 
       aria-expanded="false" 
       aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Link -->
        <li class="nav-item acitve">
          <a class="nav-link text-white" href="#">All</a>
        </li>
        <li class="nav-item">
              <a class="nav-link text-white" href="#">Shirts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Sport wears</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Outwears</a>
            </li>

      </ul>

      <!-- Search -->
      <form class="w-auto py-1" style="max-width: 12rem">
        <input type="search" class="form-control rounded-0" placeholder="Search" aria-label="Search">
      </form>

    </div>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
  
<!-- Products -->
  <section>
  <div class="text-center">
    <div class="row">
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg"
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Denim shirt</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Shirt</p>
            </a>
            <h6 class="mb-3 price">120$</h6>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13.jpg"
              class="w-100" />
            <a href="#!">  
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">bestseller</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Sweatshirt</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Sport wear</p>
            </a>
            <h6 class="mb-3 price">139$</h6>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14.jpg"
              class="w-100" />
            <a href="#!">              
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Grey blouse</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Sport wear</p>
            </a>
            <h6 class="mb-3 price">99$</h6>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15.jpg"
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge sale-badge ms-2">-10%</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Black jacket</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Outwear</p>
            </a>
            <h6 class="mb-3 price">
              <s>199$</s><strong class="ms-2 sale">179$</strong>
            </h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13.jpg"
              class="w-100" />
            <a href="#!">              
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Sweatshirt</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Sport wear</p>
            </a>
            <h6 class="mb-3 price">139$</h6>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14.jpg"
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-success ms-2">Eco</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Grey blouse</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Sport wear</p>
            </a>
            <h6 class="mb-3 price">99$</h6>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15.jpg"
              class="w-100" />
            <a href="#!">              
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Black jacket</h5>
            </a>
            <a href="" class="text-reset">
              <p>Outwear</p>
            </a>
            <h6 class="mb-3 price">199$</h6>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg"
              class="w-100" />
            <a href="#!">              
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-2">Denim shirt</h5>
            </a>
            <a href="" class="text-reset ">
              <p>Shirt</p>
            </a>
            <h6 class="mb-3 price">120$</h6>
          </div>
        </div>
      </div>
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