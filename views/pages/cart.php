<?php 
$title = "My Cart";
function get_content() {
    require_once '../../controllers/connection.php';
    $query = "SELECT * FROM barbers";
    $result = mysqli_query($cn, $query);
    $barbers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $customer_id = $_SESSION['customers_info']['customer_id'];
    $appoinments_query = "SELECT * FROM appointments WHERE customer_id = $customer_id";
    $appoinments_result = mysqli_query($cn, $appoinments_query);
    $my_appoinments = mysqli_fetch_all($appoinments_result, MYSQLI_ASSOC);
?>

<div class="container">
    <?php if(!isset($_SESSION['cart'])): ?>
        <h2 class="py-4">Your cart is empty</h2>
        <a href="/">Go back to shopping</a>
    <?php else: ?>
        <h2 class="py-4">My Cart</h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total = 0;
                    foreach($barbers as $barber): 
                        if(isset($_SESSION['cart'][$barber['barber_id']])):
                ?>
                <tr>
                    <td>
                        <a class="btn btn-danger" href="/controllers/cart/delete.php?id=<?php echo $barber['barber_id']; ?>">x</a>
                    </td>
                    <td><?php echo $barber['barber_name'];?></td>
                    <td>
                        <form method="POST" action="/controllers/cart/update.php">
                            <input type='hidden' name="id" value="<?php echo $barber['barber_id']?>"/>
                            <input 
                            class="form-control quantity-inputs"
                            type="number" 
                            value="<?php echo $_SESSION['cart'][$barber['barber_id']];?>"
                            name="quantity" />
                        </form>
                    </td>
                    <td>RM <?php echo $subtotal; ?></td>
                </tr>
                <?php 
                        endif; 
                    endforeach; 
                ?>

                <tr>
                    <td>
                        <a class="btn btn-danger" href="/controllers/cart/empty.php">Empty Cart</a>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkout">
                            Checkout
                        </button>
                        <div class="modal fade" id="checkout">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">    
                                        <h4>Confirm Checkout</h4>
                                        <form method="POST" action="/controllers/appoinments/checkout.php">
                                            <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                                            <button class="btn btn-info">Confirm</button>
                                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="fw-bold">Total: <?php echo $total; ?></td>
                </tr>
            <tbody>
            
        </table>

    <?php endif; ?>
    
</div>
<?php
}
require_once '../template/layout.php';
?>

<script>
    let quantityInputs = document.querySelectorAll('.quantity-inputs');
    quantityInputs.forEach(input => {
        input.onkeyup = () => input.parentElement.submit();
        input.onchange = () => input.parentElement.submit();
    })
</script>