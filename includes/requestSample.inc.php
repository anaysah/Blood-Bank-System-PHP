<?php
session_start();
require_once('main.functions.inc.php');
isLogged('receiver', 'only receiver can request blood');

function isRequestExits($conn, $sample_id, $receiver_id){
    $sql = "SELECT id FROM request WHERE sample_id = ? AND receiver_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $sample_id, $receiver_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Request already exists
            return true;
        }
    }
    return false;
}

function addRequest($conn, $sample_id, $receiver_id) {
    // Insert the request into the "request" table
    $sql = "INSERT INTO request (receiver_id, sample_id, date) VALUES (?, ?, CURDATE())";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $receiver_id, $sample_id);
        if (mysqli_stmt_execute($stmt)) {
            // Request added successfully
            return true;
        }
    }

    // Request could not be added
    return false;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect("../auth", "wrong link bro");
}

require_once('dbh.inc.php');
$sample_id = $_POST['sample_id'];
$receiver_id = $_SESSION['id'];

if(isRequestExits($conn, $sample_id, $receiver_id)) {
    redirect($_SERVER['HTTP_REFERER'], "Request already exits");
}

if (!addRequest($conn, $sample_id, $receiver_id)){
    redirect($_SERVER['HTTP_REFERER'], "Request failed try again later");
}

redirect($_SERVER['HTTP_REFERER'], "Request done");