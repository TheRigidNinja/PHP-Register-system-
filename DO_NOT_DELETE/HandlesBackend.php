<?php 

    session_start();

    $repoIMG = array();
    $php_v = 5;
    $directory = str_replace("PHP-Repos-Browser\DO_NOT_DELETE","",dirname(__FILE__))."php$php_v"; // Change this thing 
    $contextmenutype  = true;
    $_SESSION["folderNames"]  = array();
    $_SESSION["folderStamps"]  = array();
    $_SESSION["filtered_Search"]  = array();


    // Gets all folder/timestamps in the selected directory
    foreach (array_diff(scandir($directory), array('..', '.')) as $fname) {
        array_push($_SESSION["folderNames"],$fname);
        array_push($_SESSION["folderStamps"],stat($directory."/$fname")["atime"]);
    }

    // Assign foldernames 
    $_SESSION["filtered_Search"] = $_SESSION["folderNames"];

    if(isset($_POST["filtered_Search"])){
        // Function to check if the searched term exists in the array of foldernames
        // IF yes return the results otherwise return empty-> no results
        function filtered_Search($word){
            $clean_out_Fname = preg_replace('/[^a-zA-Z]/', "", strtolower($word)); 
            $clean_out_UserSearch = preg_replace('/[^a-zA-Z]/', "", strtolower($_POST["filtered_Search"])); 

            $clean_out_UserSearch = $clean_out_UserSearch?$clean_out_UserSearch:" ";
            return strstr($clean_out_Fname,$clean_out_UserSearch);
        }

        $search_results = array_filter($_SESSION["folderNames"],"filtered_Search");

        // Invert results --> So that i remove all resulted repos that don't match search term 
        $_SESSION["filtered_Search"] =  array_diff($_SESSION["folderNames"], $search_results);

        
        // If the search bar is empty display everything instead
        if(preg_replace('/[^a-zA-Z]/', "", strtolower($_POST["filtered_Search"])) == ""){
            $search_results  = $_SESSION["filtered_Search"];
        }; 

        echo json_encode((object)["remove"=>$_SESSION["filtered_Search"],"appear"=>$search_results]);
    }




    // Handles Context Menu
    if(isset($_POST["ContextMenu"]) && isset($_POST["openWith"]) && isset($_POST["fileName"])){

        switch ($_POST["ContextMenu"]) {
            case "Open":
                system("cd ".$directory.$_POST["fileName"]."&& ".$_POST["openWith"]." .");
            break;

            case "Gallery":
                system("cd ".$directory.$_POST["fileName"]."\gallery && start.");
            break;

            case "Banner":
                system("cd ".$directory.$_POST["fileName"]."\banner && start.");
            break;
        
            default:
                # code...
                break;
        }
        // echo $_POST["ContextMenu"];
    }

    

//   var_dump($folders)
    // echo system("cd php5 && ls")

    // code filename
?>