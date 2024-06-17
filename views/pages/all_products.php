<?php 

// display all barbers from all customerss just like the my_barbers.php

$title = "My Products";
function get_content() { 
    require_once '../../controllers/connection.php';

    $products_query = "SELECT * FROM products";
    $product_result = mysqli_query($cn, $products_query);
    $products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

?>

<div class="container">
<h2 class="py-5">My Products</h2>

<?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
<!-- this condition is to check if someone is logged in as admin and display the add barber form -->
<form method="POST" action="/controllers/products/add.php" enctype="multipart/form-data">  
    <label for="name">Name</label>
    <input type="text" class="form-control" name="product_name" id="product_name">
    <label for="name">Price</label>
    <input type="text" class="form-control" name="price" id="price">
    <label class="form-label">Products</label>   
    <select class="form-select" name="product_type">
        <option selected disabled>Select Product Type</option>
        <option value="Hair Clay">Hair Clay</option>
        <option value="Hair Gel">Hair Gel</option>
        <option value="Hair Mousse">Hair Mousse</option>
        <option value="Hair Wax">Hair Wax</option>
        <option value="Hair Color">Hair Color</option>
    </select>
                                <label for="" class="mt-3">Image</label>
                                <input type="file" name="image" id="image" class="form-control mb-4">
    <button class="mb-4">Add Product</button>
</form>

<?php endif; ?>


<div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="<?php echo $product['image'];?>" class="card-img-top img-fluid">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['product_name'];?></h5>             
                    
                    <p class="card-text">Name: <?php echo $product['product_name'];?></p>
                    <p class="card-text">Products: <?php echo $product['product_id'];?> Item</p>
                    <p class="card-text">Price: RM<?php echo $product['price'];?></p>
                    <?php if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']): ?>
                    <!-- this condition is to check if someone is logged in as admin and display the edit and delete buttons -->
                    <td class="align-middle">
                            <button class="btn btn-outline-warning" 
                            data-bs-target="#editProd-<?php echo $product['product_id']?>"
                            data-bs-toggle="modal">E</button>

                            <div class="modal fade" id="editProd-<?php echo $product['product_id']?>">
                            <div class="modal-dialog modial-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <form method="POST" action="/controllers/products/update.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>"/>
                                        <div class="mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" value="<?php echo $product['product_name']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control" value="<?php echo $product['price']?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control"/>
                                            <img src="<?php echo $product['image']?>" class="img-fluid"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Product Type</label>
                                            <select class="form-select" name="product_type" >
                                                <option selected value="<?php echo $product['product_type']?>"><?php echo $product['product_type']?></option>
                                                <option value="Hair Clay">Hair Clay</option>
                                                <option value="Hair Gel">Hair Gel</option>
                                                <option value="Hair Mousse">Hair Mousse</option>
                                                <option value="Hair Wax">Hair Wax</option>
                                                <option value="Hair Color">Hair Color</option>
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
                                data-bs-target="#delproduct-<?php echo $product['product_id']?>"
                                >D</button>
                            <div class="modal fade" id="delproduct-<?php echo $product['product_id']?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete product</h4>
                                        </div>
                                        <div class="modal-body">
                                            <a href="/controllers/products/delete.php?id=<?php echo $product['product_id']?>" class="btn btn-primary">Confirm</a>
                                            <button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['customers_info']) && !$_SESSION['customers_info']['isAdmin']): ?>
                        
                        <td>
                            <!-- <form method="POST" action="/controllers/cart/add.php">
                                <button>Book Product</button>
                            </form> -->
                        </td>
                        <?php endif; ?>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
                                                
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