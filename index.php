<?php 
    $title = "Catalogue";
    function get_content() {
        require_once './controllers/connection.php';

        $query = "SELECT * FROM barbers";
        $result = mysqli_query($cn, $query);
        $barbers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // $prouduct->name without MYSQLI_ASSOC
        // $barber['name'] with MYSQLI_ASSOC
?>

<div class="container">
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['class']; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php endif; ?>

    <h2 class="py-5">Catalogue</h2>

    <div class="row">
        <?php foreach($barbers as $barber): ?>
            <div class="col-md-4 col-6">
                <div class="card">
                    <img src="<?php echo $barber['image'] ?>" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $barber['name']?></h5>
                        <p class="card-text"><?php echo $barber['description']?></p>
                        <small>RM <?php echo $barber['price'] ?></small>
                    </div>
                    <?php if(isset($_SESSION['user_info']) && !$_SESSION['user_info']['isAdmin']): ?>
                    <div class="card-footer">
                        <form action="/controllers/cart/add.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $barber['id']?>"/>
                            <div class="input-group">
                                <input type="number" name="quantity" class="form-control"/>
                                <button class="btn btn-success">ATC+</button>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
</div>

<?php 
    }
    require_once './views/template/layout.php';
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alertBox = document.querySelector('.alert');
        setTimeout(function() {
            <?php unset($_SESSION['message']); ?>
            <?php unset($_SESSION['class']); ?>
            alertBox.classList.toggle("d-none");
        }, 5000)
    })
</script>