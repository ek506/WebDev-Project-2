<?php
session_start(); 

function invalidUsername($username) {
    $result;
    // check this make it work
    if (preg_match("/[!@#%&*()+^{}\[\]\-;:\"\'<>?\/]/",$username)){ 
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

if (isset($_POST["submit"])){
    $username = $_POST["username"];
    $eyes = $_POST["eyes"];
    $mouth = $_POST["mouth"];
    $skin = $_POST["skin"];

    if (empty($username)){
        header("location: registration.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false){
        header("location: registration.php?error=invalidUsername");
        exit();
    } 

    // Store the form data in the session
    $_SESSION['username'] = $username;
    $_SESSION['eyes'] = $eyes;
    $_SESSION['mouth'] = $mouth;
    $_SESSION['skin'] = $skin;
    header("location: index.php?error=none");
    exit();


} else{
    header("location: registration.php");
    exit();
}





