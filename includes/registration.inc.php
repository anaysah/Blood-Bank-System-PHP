<?php
require_once('main.functions.inc.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect("../auth");
}

require_once('dbh.inc.php');
require_once('auth.functions.inc.php');

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$postalCode = $_POST["postalCode"];
$phoneNumber = $_POST["phoneNumber"];
$userType = $_POST["userType"];

$bloodGroups = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
if (isset($_POST["blood_group"]) && $userType == "receiver"){
    $bloodGroup = $_POST["blood_group"];
    if (!in_array($bloodGroup, $bloodGroups))
        redirect($_SERVER['HTTP_REFERER'], "invalid Blood Group");
}

$attributes = array($name, $email, $password, $repassword, $address, $city, $state, $postalCode, $phoneNumber);
if (isInputEmpty($attributes) !== false) {
    redirect($_SERVER['HTTP_REFERER'], "Empty Input");
}

if ($password != $repassword) {
    redirect($_SERVER['HTTP_REFERER'], "Both password are not same");
}

if (invalidEmailId($email) !== false) {
    redirect($_SERVER['HTTP_REFERER'], "invalid Email");
}

if (emailExists($conn, $email, $userType) !== false) {
    redirect($_SERVER['HTTP_REFERER'], "User already exit pls forgat password");
}

if ($userType=='receiver'){
    $userData = createUser($conn, $email, $name, $password, $address, $city, $state, $postalCode, $phoneNumber, $userType, $bloodGroup);
}else{
    $userData = createUser($conn, $email, $name, $password, $address, $city, $state, $postalCode, $phoneNumber, $userType);
}

if ($userData === false) {
    redirect($_SERVER['HTTP_REFERER'], "Not Created try again");
}

redirect($_SERVER['HTTP_REFERER'], "User is created");