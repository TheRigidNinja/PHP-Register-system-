<form class="container form-group mx-auto d-flex flex-column align-items-center justify-content-center"
    action="./Server-PHP/index.php" method="POST">
    <h1 class="h1 form-group">Login</h1>
    <h2 class="h2 form-group">Exclusive Members Only</h2>

    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
        </div>
        <input type="email" class="form-control" placeholder="Email" name="email" required>
    </div>


    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
        </div>
        <input type="password" placeholder="password" class="form-control" name="password" required>
    </div>

    <?php 
        $btnType = "Create Account"; 
        require("SubmitAction.php");

        header("Location: ");
    ?>

</form>