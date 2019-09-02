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
    $dbName = "MemberDATA";

    // create connection 
    function handleConnectionToDB(){
        $conn = new mysqli($host, $dbUserName, $dbPassword, $dbName);

        // check if i can connect otherwise spit out the error 
        $checkConnection = mysqli_connect_error() ? die("Connection Error(".mysqli_connect_errno().")".mysqli_connect_error()):true;
        
        return checkConnection;
    }


    function handleUserSignIn(){

        // Creating user account
        if(!empty($firstName)){
            $sql = "INSERT INTO MemberDetails (firstName, lastName, gender, state, email, password) values ('$firstName','$lastName','$gender','$state','$email','$password')";

            $dbEmails = "SELECT * FROM MemberDetails WHERE (email='$email');";
            $results = mysql_query($conn,$dbEmails);
            // && mysql_num_rows($results) > 0)
            echo $results;

            // Re-Check connection
            if($conn->query($sql)){
                echo "Your account has been created";
            }else{ 
                echo "Something wrong has happened to the database";  
            }

            //         // Set timeout here   
            //   header("Location: /PHP/Website/Dashboard.html");
            //   die();

            // Logging in 
        }else{
            echo "Login in proccess";
        }
    }

    handleConnectionToDB();
    handleUserSignIn();

?>





<!-- Proccess -->
<!-- Install XAMPP -->
