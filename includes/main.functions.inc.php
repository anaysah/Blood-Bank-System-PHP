<?php

function redirect($url, $message = NULL) #i will use message later to show error or message after redirect
{
    if ($message !== NULL) {
        setcookie("message", $message, time() + 86400,"/");
    }

    header("location: " . $url);
    exit();
}