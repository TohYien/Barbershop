<?php 
$title = "Register";
function get_content() {
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto py-5">
            <h2 class="text-center">Register</h2>
            <form method="POST" action="/controllers/customers/process_register.php">
                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password2" class="form-control"/>
                </div>
                <button class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php
}
require_once '../template/layout.php';
?>