<?php 

// display all barbers from all customerss just like the my_barbers.php

$title = "My Services";
function get_content() { 
    require_once '../../controllers/connection.php';

    $services_query = "SELECT * FROM services";
    $services_result = mysqli_query($cn, $services_query);
    $services = mysqli_fetch_all($services_result, MYSQLI_ASSOC);
?>

<div class="container">
<h2 class="py-5">My Services</h2>


<?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
<!-- this condition is to check if someone is logged in as admin and display the add barber form -->
<form method="POST" action="/controllers/services/add.php" enctype="multipart/form-data">  
    <label for="name">Name</label>
    <input type="text" class="form-control" name="service_name" id="service_name">
    <label for="name">Duration</label>
    <input type="text" class="form-control" name="duration" id="duration">
    <label for="">Price</label>
    <input type="text" class="form-control mb-4" name="price" id="price">
                <label for="" class="mt-2">Image</label>
                <input type="file" name="image" class="form-control"/>
                <!-- <input type="file" name="image" id="image" class="form-control mb-4"> -->
    <button class="my-4">Add Barber</button>
</form>

<?php endif; ?>


<div class="row">
    <?php foreach($services as $service):?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="<?php echo $service['image'];?>" class="card-img-top img-fluid">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $service['service_name'];?></h5>             
                    
                    <p class="card-text">Duration: <?php echo $service['duration'];?>hours</p>
                    <p class="card-text">Price: RM<?php echo $service['price'];?></p>
                    <?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
                    <!-- this condition is to check if someone is logged in as admin and display the edit and delete buttons -->
                    <td class="align-middle">
                            <button class="btn btn-outline-warning" 
                            data-bs-target="#editProd-<?php echo $service['service_id']?>"
                            data-bs-toggle="modal">E</button>

                            <div class="modal fade" id="editProd-<?php echo $service['service_id']?>">
                            <div class="modal-dialog modial-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <form method="POST" action="/controllers/services/update.php" enctype="multipart/form-data">
                                        <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>"/>
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="service_name" class="form-control" value="<?php echo $service['service_name']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Duration</label>
                                            <input type="number" name="duration" class="form-control" value="<?php echo $service['duration']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="text" name="price" class="form-control" value="<?php echo $service['price']; ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control"/>
                                            <img src="<?php echo $service['image']?>" class="img-fluid"/>
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
                                data-bs-target="#delservice-<?php echo $service['service_id']?>"
                                >D</button>
                            <div class="modal fade" id="delservice-<?php echo $service['service_id']?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Service</h4>
                                        </div>
                                        <div class="modal-body">
                                            <a href="/controllers/services/delete.php?id=<?php echo $service['service_id']?>" class="btn btn-primary">Confirm</a>
                                            <button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['customers_info']) && !$_SESSION['customers_info']['isAdmin']): ?>
                        
                        <td>
                            <!-- <form method="POST" action="/controller/cart/add.php">
                                <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>"/>
                                <button>Book Service</button>
                            </form> -->
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