<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/">Home</a>
        
        <?php if(!isset($_SESSION['customers_info'])): ?>
        <a class="nav-link" href="/views/pages/login.php">Login</a>
        <a class="nav-link" href="/views/pages/register.php">Register</a>
        <?php endif; ?>
    
        <?php if(isset($_SESSION['customers_info']) && !$_SESSION['customers_info']['isAdmin']): ?>
        <a class="nav-link" href="/views/pages/cart.php">Cart 
          <span class="badge bg-primary">
            <?php if(!isset($_SESSION['cart'])): ?>
              0
            <?php else: ?>
              <?php echo array_sum($_SESSION['cart']); ?>
            <?php endif; ?>
          </span>
        </a>
        <a class="nav-link" href="/views/pages/my_orders.php">My Orders</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
        <a class="nav-link" href="/views/pages/dashboard.php">Dashboard</a>
        <a class="nav-link" href="/views/pages/all_orders.php">Orders</a>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['customers_info'])): ?>
        <a class="nav-link" href="/controllers/users/process_logout.php">Logout</a>
        <?php endif; ?>
            
      </div>
    </div>
  </div>
</nav>