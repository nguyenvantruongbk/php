<?php
    require_once("functions/product.php");
    $categories = categories_all();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <?php foreach($categories as $item):?>
        <li class="nav-item">
          <a class="nav-link" href="category.php?id=<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></a>
        </li>
        <?php endforeach;?>
      </ul>
      <!-- //<form action="/demo3.php" method="GET"> -->
      <form action="/search.php" class="d-flex" role="search" method="GET">
        <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search" value="<?php echo $search; ?>">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <a class="border border-light p-2 ms-2 position-relative" href="/cart.php"><i class="bi bi-cart"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        <?php echo isset($_SESSION["cart"])?count($_SESSION["cart"]):0; ?></span></a>
        <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"] != null):?>
          <a class="p-2 ms-2" href="/profile.php"><?php echo $_SESSION["auth"]["full_name"];?></a>
          <a class="p-2 ms-2" href="/logout.php">Logout</a>
        <?php else:?>
          <a class="p-2 ms-2" href="/register.php"> Register</a>
          <a class="p-2 ms-2" href="/login.php"> Login</a>
        <?php endif;?>
      </form>
    </div>
  </div>
</nav>