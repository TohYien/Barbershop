<?php 
    $title = "My Appoinments";
    function get_content() { 
        require_once '../../controllers/connection.php';
        $customer_id = $_SESSION['customers_info']['customer_id'];
        
        $all_query = "
        SELECT  
        barbers.name as barber_name, barbers.experience as experience, barbers.image as barber_image, 

        products.product_name as product_name, products.price as price, products.image as image, products.product_type as product_type,

        services.service_name as service_name, services.price as service_price, services.image as service_image,

        appointments.appointment_time, appointments.appointment_id, appointments.barber_id, appointments.service_id, appointments.product_id, appointments.isPaid,
        
        customers.username as username , customers.phone as phone, customers.email as email FROM appointments  

        JOIN products ON appointments.product_id = products.product_id
        JOIN services ON appointments.service_id = services.service_id
        JOIN customers ON appointments.customer_id = customers.customer_id
        JOIN barbers ON appointments.barber_id = barbers.barber_id
        ";

        $appointments_query = "
        SELECT  
        barbers.name as barber_name, barbers.experience as experience, barbers.image as barber_image, 

        products.product_name as product_name, products.price as price, products.image as image, products.product_type as product_type,

        services.service_name as service_name, services.price as service_price, services.image as service_image,
        
        appointments.appointment_time, appointments.appointment_id, appointments.barber_id, appointments.service_id, appointments.product_id, appointments.isPaid,
        
        customers.username as username , customers.phone as phone, customers.email as email FROM appointments 

        JOIN customers ON appointments.customer_id = $customer_id
        JOIN barbers ON appointments.barber_id = barbers.barber_id
        JOIN products ON appointments.product_id = products.product_id
        JOIN services ON appointments.service_id = services.service_id
        WHERE appointments.customer_id = $customer_id and customers.isAdmin = 0;
        ";
        
        $appointments_result;

        if(isset($_SESSION['customers_info']) && $_SESSION['customers_info']['isAdmin']) {
            $appointments_result = mysqli_query($cn, $all_query);
        } else {
            $appointments_result = mysqli_query($cn, $appointments_query);
        }
        
        $my_appoinments = mysqli_fetch_all($appointments_result, MYSQLI_ASSOC);

?>

<div class="container">
    <h2 class="py-5">My Appoinments</h2>
    
    <?php foreach($my_appoinments as $appoinment): ?> <!-- appoinments table -->
        <div class="bappoinment p-5 my-3">
            
            <?php if($appoinment['isPaid']): ?>
                <h2>Paid</h2>
                <?php else: ?>
                    <h2>Not Paid</h2>
                    <?php endif;?>
                    
                        
                <table class="table table-bordered bg-dark text-white">
        <tbody>
      
                <tr>

                    <td>
                        <h5>Appointment Details</h5>
                    </td>

                    <td>
                        <h5>Customer Details</h5>
                    </td>
                    
                    <td>
                        <h5>Barber Details</h5>    
                    </td>
        
            
                    <td>
                        <h5>Service Details</h5>           
                    </td>
            
                    <td>
                        <h5>Product Details</h5>
                    </td>

                </tr>

            
            <tr>
                <td>
                    <h6> <?php echo $appoinment['appointment_time']; ?></h6>
                </td>
                <td>
                    <div>
                        <h6><?php echo $appoinment['username']; ?></h6>
                        <h6> <?php echo $appoinment['phone']; ?></h6>
                        <h6> <?php echo $appoinment['email']; ?></h6>
                    </div>
                </td>
                <td>
                    <div>
                        <h6> <?php echo $appoinment['barber_name']; ?></h6>
                        <h6> <?php echo $appoinment['experience']; ?></h6>
                        <img src="<?php echo $appoinment['barber_image'];?>" class="img-fluid" width='200' height='200'>
                    </div>
                </td>
                <td>
                    <div>
                        <h6> <?php echo $appoinment['service_name']; ?></h6> 
                        <h6> <?php echo $appoinment['service_price']; ?></h6>
                        <img src="<?php echo $appoinment['service_image'];?>" class="img-fluid" width='200' height='200'>
                    </div>
                </td>
                <td>
                    <div>
                        <h6> <?php echo $appoinment['product_name']; ?></h6>
                        <h6> <?php echo $appoinment['price']; ?></h6>
                        <h6> <?php echo $appoinment['product_type']; ?></h6>
                        <img src="<?php echo $appoinment['image'];?>" class="img-fluid" width='200' height='200'>
                    </div>
                </td>
            </tr>
    </tbody>
    </table>

        <?php if(isset($_SESSION['customers_info']) && !$_SESSION['customers_info']['isAdmin']):?>
        <form action="../../controllers/appointments/paid.php" method="POST">
            <button class="btn btn-success">Pay</button>
            <input type="text" name="appointment_id" value="<?php echo $appoinment['appointment_id']; ?>" hidden>
        </form>
        <?php endif; ?>
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