<?php

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $state = $_POST["state"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $host = "localhost";
    $dbUserName = "root";
    $dbPassword = "1234";
    $dbName = "Members";


    // create connection 
    $conn = new mysqli($host, $dbUserName, $dbPassword, $dbName);
    
    if(mysqli_connect_error()){

        die("Connection Error(".mysqli_connect_errno().")".mysqli_connect_error());

    }else{

        if(!empty($firstName)){
            // User wants to Creating Account 

            $sql = "INSERT INTO MemberDetails (firstName, lastName, gender, state, email, password) values ('$firstName','$lastName','$gender','$state','$email','$password')";

            
            // $dbEmails = "SELECT * FROM MemberDetails WHERE (email='$email');";
            // $results = mysql_query($conn,$dbEmails);
            // && mysql_num_rows($results) > 0)

            // Re-Check connection
            if($conn->query($sql)){
              echo "Your account has been created";

            // Set timeout here   
              header("Location: /PHP/Website/Dashboard.html");
              die();

            }else{
                echo "Something went wrong";  
            }

        }else if(!empty($password)){
            // User wants to Login
            echo "Login in proccess";


        }else{
            header("Location: /PHP/Website/Login.html");
            die();
        }


    }

?>




<!-- Proccess -->
<!-- Install XAMPP -->
