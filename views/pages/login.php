<?php 
$title = "Login";
function get_content() {
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto py-5">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="/controllers/customers/process_login.php">
                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>


<?php
}
require_once '../template/layout.php';
?>