<?php 

    session_start();
    $php_v = 5;
    $directory = str_replace("PHP-Repos-Browser/DO_NOT_DELETE","",dirname(__FILE__))."/php$php_v"; // Change this thing `
    $contextmenutype  = true;
    $folderNames = $folderStamps = $filter_by_recent = $filtered_Search = $repoIMG = $new_modified_order = []; 

    // Gets all folder/timestamps in the selected directory
    foreach (array_diff(scandir($directory), array('..', '.')) as $fname) {
        array_push($folderNames,$fname);
        array_push($folderStamps,stat($directory."/$fname")["atime"]);
    }

    // Assign foldernames 
    $filtered_Search = $folderNames;

    if(isset($_POST["filtered_Search"]) && $_POST["filtered_Search"] != "<!ORDER!>"){
        // Function to check if the searched term exists in the array of foldernames
        // IF yes return the results otherwise return empty-> no results
        function filtered_Search($word){
            $clean_out_Fname = preg_replace('/[^a-zA-Z]/', "", strtolower($word)); 
            $clean_out_UserSearch = preg_replace('/[^a-zA-Z]/', "", strtolower($_POST["filtered_Search"])); 

            $clean_out_UserSearch = $clean_out_UserSearch?$clean_out_UserSearch:" ";
            return strstr($clean_out_Fname,$clean_out_UserSearch);
        }

        $search_results = array_filter($folderNames,"filtered_Search");

        // Invert results --> So that i remove all resulted repos that don't match search term 
        $filtered_Search =  array_diff($folderNames, $search_results);

        
        // If the search bar is empty display everything instead
        if(preg_replace('/[^a-zA-Z]/', "", strtolower($_POST["filtered_Search"])) == ""){
            $search_results  = $filtered_Search;
        }; 

        echo json_encode((object)["remove"=>$filtered_Search,"appear"=>$search_results]);

    }else if($_POST["filtered_Search"] == "<!ORDER!>"){
        $new_modified_order = [];
        $filter_by_recent = $folderStamps;
        rsort($filter_by_recent);

        // Filtering to most recent using modified dates
        foreach ($filter_by_recent as $key) {
          array_push($new_modified_order,array_search($key,$folderStamps));
        }

        // echo var_dump($filter_by_recent"]),"<====>", var_dump($folderStamps"]);
        echo json_encode((object)["index"=>$new_modified_order,"obj"=>$folderNames]);
    }


    // Handles Context Menu
    if(isset($_POST["ContextMenu"]) && isset($_POST["openWith"]) && isset($_POST["fileName"])){

        switch ($_POST["ContextMenu"]) {
            case "Open":
                system("cd ".$directory.$_POST["fileName"]."&& ".$_POST["openWith"]." .");
            break;

            case "Gallery":
                system("cd ".$directory.$_POST["fileName"]."\gallery && start .");
            break;

            case "Banner":
                system("cd ".$directory.$_POST["fileName"]."\banner && start .");
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