<?php 
    require "DO_NOT_DELETE/HandlesBackend.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Respos</title>
    <link rel="stylesheet" href="DO_NOT_DELETE/css/bulma.min.css">
    <script src="./DO_NOT_DELETE/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css" href="DO_NOT_DELETE/css/style.css" />
</head>

<body oncontextmenu="return false">
<input type="text" value="" id="clipboard"/>


    <!-- Body elements -->
    <div class="php-v_container">
        <span id="php-v"><?php echo "PHP - 5"?></span>
    </div>


    <!-- Top Search bar -->
    <section class="topbar">
        <div class="control has-icons-left">
            <input class="input is-link is-rounded" type="text" id="topbarsearch"
                oninput="Search_input(event.target.value)" placeholder="Search for Repos..." autofocus>

            <span class="icon is-left">
                <img src="DO_NOT_DELETE/img/icons/search-solid.svg" alt="Search" id="SearchIcon">
            </span>
        </div>

        <div class="nav-btn">
            <button class="button is-link is-rounded"><?php echo "Switch to PHP - 7"?></button>
            <button class="button is-danger is-rounded" onclick="Recents()">Recents</button>
        </div>
    </section>


    <!-- All repos are displayed in here -->
    <section class="repos" id="repos">
        <div class="title notification is-danger repoDisplayCls">NOPE! 😞 Couldn't find it!</div>


        <?php foreach($_SESSION["filtered_Search"] as $name):?>
            <a href="##" target="_black" class="repoBox repoBoxElm">
                <span class="tag is-warning is-medium"><?php echo $name; ?></span>
            </a>
        <?php  endforeach?>
    </section>

    <!-- Show right click options -->
    <section class="right_click">
        <div class="dropdown-content">
            <?php if($contextmenutype):?>
            <a href="#" class="dropdown-item" onclick="ContextmenuHandler('Open')"><strong>Open</strong></a>
            <a href="#" class="dropdown-item" onclick="ContextmenuHandler('BitBucket')">Open in BitBucket</a>
            <a href="#" class="dropdown-item" onclick="ContextmenuHandler('Gallery')">Gallery</a>
            <a href="#" class="dropdown-item" onclick="ContextmenuHandler('Banner')">Banner</a>
            <a href="#" class="dropdown-item" onclick="ContextmenuHandler('CopyName')">Copy Name</a>
            <hr class="dropdown-divider">
            <?php endif;?>
            <div class="divided">
                <label class="dropdown-item"><strong>Open With:</strong></label>
                <label class="radio dropdown-item"><input class="openwith" type="radio" value="code" name="openType" checked> VS Code</label>
                <label class="radio dropdown-item"><input class="openwith" type="radio" value="phpStorm" name="openType"> PhpStorm</label>
            </div>
        </div>
    </section>

</body>



<script>
    var textmenu = $(".right_click"),
    repoBoxElm = document.querySelectorAll(".repoBoxElm");

    // Handles Searching 
    function Search_input(data) {
        getPhpInfo({"filtered_Search":data});
    }

    function Recents(){

    }

    // Interacting with PHP server at HandlesBackend
    function getPhpInfo(data){
        $.ajax({
            url: "DO_NOT_DELETE/HandlesBackend.php",
            method: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (response) {

                Object.keys(response["remove"]).forEach((element) => {
                    repoBoxElm[element].classList.add("repoDisplayCls");
                });

                Object.keys(response["appear"]).forEach((element) => {
                    repoBoxElm[element].classList.remove("repoDisplayCls");
                });

                // Add / Remove warning
                if(response["appear"] == "" ){
                    document.querySelector(".title").classList.remove("repoDisplayCls");
                }else{
                    document.querySelector(".title").classList.add("repoDisplayCls");
                }

            }
        });
    }


    // Handling Contextmenu
    function ContextmenuHandler(type){
        var openWith = document.querySelectorAll(".openwith"),
        filename = document.querySelector("#clipboard").value;
        openWith = openWith[0].checked?openWith[0].value:openWith[1].value;

        // //
        if(["BitBucket","CopyName"].includes(type)){
            switch (type) {
                case "BitBucket":
                    var win = window.open("https://www.w3schools.com/jsref/met_win_open.asp", '_blank');
                    win.focus();
                break;
                case "CopyName":
                    var copyText = document.querySelector("#clipboard");
                    copyText.select();
                    document.execCommand("copy");
                break;
                default:
                    break;
            }
        }else{
            $.ajax({
                url: "DO_NOT_DELETE/HandlesBackend.php",
                method: 'POST',
                data: {"ContextMenu":type,"openWith":openWith,"fileName":"\\"+filename},
                dataType: 'JSON',
                success: function (response) {
                }
            });
        }
    }



    // Handling of Context Menu
    function Contextmenu(type, e) {
        // gets class for elment to make sure you're click on context menu
        var checkClass1 = e.target.parentNode.parentNode.getAttribute("class"),
            checkClass2 = e.target.parentNode.getAttribute("class"),
            checkClass3 = e.target.getAttribute("class");

        switch (true) {
            case type == "MouseDown":
                textmenu.css({"left":(e.clientX - 10),"top":(e.clientY - 10),"display":"block"});

                // Writes to clipboard
                var getvalueC = e.target.querySelector(".tag");
                    getvalueP = getvalueC?getvalueC.innerHTML:e.target.innerHTML;
                    document.querySelector("#clipboard").value = getvalueP;
                break;

            case type == "Click" && (["divided", "dropdown-content", "right_click"].includes(checkClass1) || ["divided",
                "dropdown-content", "right_click"
            ].includes(checkClass2) || ["divided", "dropdown-content", "right_click"].includes(checkClass3)):
                if(["Open","Open in BitBucket","Gallery","Banner","Copy Name"].includes(e.target.innerText)){
                    textmenu.css("display","none");
                }
                break;
            default:
                textmenu.css("display","none");
                break;
        }
    }
    

    $(window).on("mousedown", (e) => {
        if (e.button == 2) {
            Contextmenu("MouseDown", e);
        }
    });

    $(window).on("click", (e) => {
        Contextmenu("Click", e);
    });


</script>




</html>