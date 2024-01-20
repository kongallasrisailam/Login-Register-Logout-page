<?php
if(isset($_GET['path'])) {

    if($_GET['path'] == "login") {
        login($_POST,$conn);
    } else if($_GET['path'] == "register") {
        register($_POST,$conn);
    }else if($_GET['path'] == "logout") {
        logout($_POST,$conn);
    }else if($_GET['path'] == "profile_update"){
        profileUpdate($_POST,$conn);
    }


} else {
    index();
}
?>