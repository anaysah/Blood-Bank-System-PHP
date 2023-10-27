<?php
require_once('main.functions.inc.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['userType'])) {
    redirect("../auth", "wrong link bro");
}

require_once('dbh.inc.php');
require_once('auth.functions.inc.php');

$email = $_POST["email"];
$password = $_POST["password"];
$userType = $_POST["userType"];

$attributes = array($email, $password, $userType);
if (isInputEmpty($attributes) !== false) {
    redirect($_SERVER['HTTP_REFERER'], "Empty Input");
}

if (invalidEmailId($email) !== false) {
    redirect($_SERVER['HTTP_REFERER'], "invalid Email");
}

$data = emailExists($conn, $email, $userType); #if the email exist then it will return the data of it which i will use it to login
if ($data === false) {
    redirect($_SERVER['HTTP_REFERER'], "Email is not registered");
}

if (!loginUser($conn, $data['id'], $password, $data['password'], $userType)) {
    redirect($_SERVER['HTTP_REFERER'], "password is wrong");
}

redirect("/$userType", "Loged in");