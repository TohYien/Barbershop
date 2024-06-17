<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">💇🏻‍♂️</a>
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
          
        </a>
        <a class="nav-link" href="/views/pages/appointments.php">Appointments</a>
        <a class="nav-link" href="/views/pages/all_barbers.php">Barbers</a>
        <a class="nav-link" href="/views/pages/all_products.php">Products</a>
        <a class="nav-link" href="/views/pages/all_services.php">Services</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
          <a class="nav-link" href="/views/pages/appointments.php">All Appointments</a>
          <a class="nav-link" href="/views/pages/all_barbers.php">Barbers</a>
          <a class="nav-link" href="/views/pages/all_products.php">Products</a>
          <a class="nav-link" href="/views/pages/all_services.php">Services</a>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['customers_info'])): ?>
        <a class="nav-link" href="/controllers/customers/process_logout.php">Logout</a>
        <?php endif; ?>
            
      </div>
    </div>
  </div>
</nav>