<?php 

    if(isset($_POST["submit"])){

        // Requires To connect to DB
        require("Config/db_connect.php");

        $email =  mysqli_real_escape_string($conn, $_POST["email"]);
        $password =  mysqli_real_escape_string($conn, $_POST["password"]);

        // Writing queries
        $sql = "SELECT * FROM members WHERE Email=$email";

        // Make query & get result
        $result = mysqli_query($conn, $sql);

        // // fetch query 
        // // $member = mysqli_fetch_assoc($result);

        echo "<script>console.log('$result')</script>";

        // // freeing / Closing connection
        // mysqli_free_result($results);
        // mysqli_close($conn);
    }
?>


<!DOCTYPE html>
<?php 
    $titleName = "Login";
    require("Templates/header.php");
?>
<body>
    <form class="container form-group mx-auto d-flex flex-column align-items-center justify-content-center" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
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

        <input type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control text-center">
        <a class="btn btn-outline-primary form-control text-center" href="./CreateAccount.php">Create Account</a>

    </form>
</body>
</html>