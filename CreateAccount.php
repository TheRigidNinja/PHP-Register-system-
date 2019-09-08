<?php 

    // Check if user has submitted the form --> Then get all variables and set the in DB
    if(isset($_POST["submit"])){
        
        // Requires To connect to DB
        require("Config/db_connect.php");

        // Collect all data from form 
        $firstName =  mysqli_real_escape_string($conn, $_POST["firstName"]);
        $lastName =  mysqli_real_escape_string($conn, $_POST["lastName"]);
        $gender =  mysqli_real_escape_string($conn, $_POST["gender"]);
        $state =  mysqli_real_escape_string($conn, $_POST["state"]);
        $email =  mysqli_real_escape_string($conn, $_POST["email"]);
        $password =  mysqli_real_escape_string($conn, $_POST["password"]);

        // Making sql Query 
        $sql = "INSERT INTO members(FirstName, LastName, Gender, CountryState, Email, Pass) VALUES('$firstName','$lastName','$gender','$state','$email','$password')";

        // Saving to DB
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
        }else{
            echo "Query Erro:". mysqli_error($conn); 
        }
        
        mysqli_close($conn);
    }


?>




<!DOCTYPE html>
<?php 
    $titleName = "Create Account";
    require("Templates/header.php");
?>

<body>
    <form class="container form-group mx-auto d-flex flex-column align-items-center justify-content-center"
        action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
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

        <input type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control text-center">
        <a class="btn btn-outline-primary form-control text-center" href="./index.php">Login</a>
        
    </form>
</body>
</html>
