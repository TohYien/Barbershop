<?php 

// display all barbers from all customerss just like the my_barbers.php

$title = "My Barbers";
function get_content() { 
    require_once '../../controllers/connection.php';

    $barbers_query = "SELECT * FROM barbers";
    $barbers_result = mysqli_query($cn, $barbers_query);
    $barbers = mysqli_fetch_all($barbers_result, MYSQLI_ASSOC);

    $products_query = "SELECT * FROM products";
    $products_result = mysqli_query($cn, $products_query);
    $products = mysqli_fetch_all($products_result, MYSQLI_ASSOC);

    $services_query = "SELECT * FROM services";
    $services_result = mysqli_query($cn, $services_query);
    $services = mysqli_fetch_all($services_result, MYSQLI_ASSOC);
?>

<div class="container">
<h2 class="py-5">My Barbers</h2>


<?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
<!-- this condition is to check if someone is logged in as admin and display the add barber form -->
<form method="POST" action="/controllers/barbers/add.php" enctype="multipart/form-data">  
    <label for="name">Name</label>
    <input type="text" class="form-control" name="barber_name" id="barber_name">
    <label for="name">Phone</label>
    <input type="text" class="form-control" name="phone" id="phone">
    <label for="">Email</label>
    <input type="text" class="form-control mb-4" name="email" id="email">
    <label class="form-label">Experience</label>   
    <select class="form-select" name="experience">
        <option selected disabled>Select Experience</option>
        <option value="Head Barber">Head Barber</option>
        <option value="Junior Barber">Junior Barber</option>
        <option value="Senior Barber">Senior Barber</option>
    </select>
                <label for="" class="mt-3">Image</label>
                <input type="file" name="image" id="image" class="form-control mb-4">
    <button class="mb-4">Add Barber</button>
</form>

<?php endif; ?>


<div class="row">
    <?php foreach($barbers as $barber):?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="<?php echo $barber['image'];?>" class="card-img-top img-fluid"  width='200' height='200'>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $barber['name'];?></h5>             
                    
                    <p class="card-text">Phone: <?php echo $barber['phone'];?></p>
                    <p class="card-text">Email: <?php echo $barber['email'];?></p>
                    <p class="card-text">Experience: <?php echo $barber['experience'];?></p>
                    <?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
                    <!-- this condition is to check if someone is logged in as admin and display the edit and delete buttons -->
                    <td class="align-middle">
                            <button class="btn btn-outline-warning" 
                            data-bs-target="#editProd-<?php echo $barber['barber_id']?>"
                            data-bs-toggle="modal">E</button>

                            <div class="modal fade" id="editProd-<?php echo $barber['barber_id']?>">
                            <div class="modal-dialog modial-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <form method="POST" action="/controllers/barbers/update.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $barber['barber_id']; ?>"/>
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="barber_name" class="form-control" value="<?php echo $barber['name']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="number" name="phone" class="form-control" value="<?php echo $barber['phone']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" value="<?php echo $barber['email']; ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control"/>
                                            <img src="<?php echo $barber['image']?>"  class="img-fluid" width='200' height='200'/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Expereinces</label>
                                            <select class="form-select" name="experience">
                                                <option value="Head Barber">Head Barber</option>
                                                <option value="Junior Barber">Junior Barber</option>
                                                <option value="Senior Barber">Senior Barber</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                                        <button class="btn btn-success">Confirm</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            

                            <button 
                                class="btn btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#delbarber-<?php echo $barber['barber_id']?>"
                                >D</button>
                            <div class="modal fade" id="delbarber-<?php echo $barber['barber_id']?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete barber</h4>
                                        </div>
                                        <div class="modal-body">
                                            <a href="/controllers/barbers/delete.php?id=<?php echo $barber['barber_id']?>" class="btn btn-primary">Confirm</a>
                                            <button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['customers_info']) && !$_SESSION['customers_info']['isAdmin']): ?>
                        
                        <td>
                            <form method="POST" action="/controllers/appointments/add.php">
                                <input type="hidden" name="barber_id" value="<?php echo $barber['barber_id']; ?>"/>
                                <select name="product_id" class="form-select mb-3">
                                    <option selected disabled>Select Product</option>
                                    <?php foreach($products as $product): ?>
                                        <option value="<?php echo $product['product_id']?>"><?php echo $product['product_name']?></option>
                                    <?php endforeach;?>
                                </select>

                                <select name="service_id" class="form-select mb-3">
                                    <option selected disabled>Select Service</option>
                                    <?php foreach($services as $service): ?>
                                        <option value="<?php echo $service['service_id']?>"><?php echo $service['service_name']?></option>
                                    <?php endforeach;?>
                                </select>
                                <input type="datetime-local" class="form-control mb-3" name="appointment_time">
                                <button>Book Barber</button>
                            </form>

                        </td>
                        <?php endif; ?>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
                                                
</div>

</div>


<?php 
}
require_once '../template/layout.php';
?>

<script>
let formEl = document.getElementById('filter');
formEl.addEventListener('change', (e) => {
    e.target.parentElement.submit()
})
</script>