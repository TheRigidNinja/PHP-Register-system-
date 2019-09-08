<form class="container form-group mx-auto d-flex flex-column align-items-center justify-content-center"
    action="./Server-PHP/index.php" method="POST">
    <h1 class="h1 form-group">Create Account</h1>
    <h2 class="h2 form-group">Exclusive Members Only</h2>


    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">First Name</span>
        </div>
        <input type="name" class="form-control" placeholder="e.g. Mark" name="firstName" required>
    </div>

    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
        </div>
        <input type="name" class="form-control" placeholder="e.g. Macbeth" name="lastName" required>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Gender</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="gender" required>
            <option value="">Choose...</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
        </select>
    </div>

    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Your Current State</span>
        </div>
        <input type="state" class="form-control" placeholder="e.g. Tasmania" name="state" required>
    </div>

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
        $btnType = "Login"; 
        require("SubmitAction.php");
    ?>

    <!-- <input type="submit" class="btn btn-outline-primary form-control text-center">
    <a class="btn btn-outline-primary form-control text-center" href="Login.php">Login</a> -->
</form>