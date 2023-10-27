<?php

function redirect($url, $message = NULL) #i will use message later to show error or message after redirect
{
    if ($message !== NULL) {
        setcookie("message", $message, time() + 86400,"/");
    }

    header("location: " . $url);
    exit();
}

function isLogged($userType = "") {
    // Start or resume the session
    session_start();

    // Check if a user is logged in
    if (isset($_SESSION['id']) && isset($_SESSION['userType'])) {
        // Check if the user type matches (if specified)
        if ($_SESSION['userType'] === $userType) {
            return true;
        }else{
            redirect("/".$_SESSION['userType'],"unauthoriezed");
        }
    }

    redirect('/auth','please login first');
}