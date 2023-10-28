<?php
require_once('main.functions.inc.php');
isLogged('hospital');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect("../".$_SESSION['userType'], "unauthoriezed");
}

function isBloodGroupOk($bloodGroup) {
    // Define an array of valid blood groups
    $validBloodGroups = array("A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-");

    // Check if the provided blood group is in the array of valid blood groups
    return in_array($bloodGroup, $validBloodGroups);
}


function isExpiryDateOk($expirationDate, $collectedOn, $acceptableRangeInDays) {
    // Convert the expiration date and collection date to DateTime objects
    $expiryDateObj = new DateTime($expirationDate);
    $collectionDateObj = new DateTime($collectedOn);

    // Calculate the difference in days between expiration date and collection date
    $dateInterval = $collectionDateObj->diff($expiryDateObj);
    $daysBetweenCollectionAndExpiry = $dateInterval->format('%r%a');

    // Check if the difference is within the acceptable range
    return ($daysBetweenCollectionAndExpiry >= 0 && $daysBetweenCollectionAndExpiry <= $acceptableRangeInDays);
}

function isQuantityOk($quantity, $acceptableRangeInMl) {
    // Check if the quantity is within the acceptable range
    return ($quantity >= 0 && $quantity <= $acceptableRangeInMl);
}

function addSample($conn, $bloodGroup, $quantity, $collectedOn, $expirationDate, $hospitalId) {
    // Prepare and execute an SQL query to insert the blood sample
    $sql = "INSERT INTO blood_samples (blood_group, quantity_in_ml, collected_on, expiration_date, hospital_id) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false; // Handle the SQL statement preparation error
    }

    mysqli_stmt_bind_param($stmt, "sissi", $bloodGroup, $quantity, $collectedOn, $expirationDate, $hospitalId);

    if (mysqli_stmt_execute($stmt)) {
        return true; // Blood sample added successfully
    } else {
        return false; // Handle the SQL statement execution error
    }
}

require_once('dbh.inc.php');

$bloodGroup = $_POST["blood_group"];
$quantity = $_POST["quantity"];
$collectedOn = $_POST["collectedOn"];
$expirationDate = $_POST["expirationDate"];
$acceptableRangeInDays = 45;
$acceptableRangeInMl = 500; // Replace with your desired range
$hospitalId = $_SESSION['id'];

if (!isBloodGroupOk($bloodGroup)){
    redirect($_SERVER['HTTP_REFERER'], "invalid Blood Group");
}

if (!isExpiryDateOk($expirationDate, $collectedOn, $acceptableRangeInDays)) {
    redirect($_SERVER['HTTP_REFERER'], "Collectiondate or expirationdate not acceptable");
}

if (!isQuantityOk($quantity, $acceptableRangeInMl)) {
    redirect($_SERVER['HTTP_REFERER'], "The blood sample quantity is outside the acceptable range.");
}

if (!addSample($conn, $bloodGroup, $quantity, $collectedOn, $expirationDate, $hospitalId)) {
    redirect($_SERVER['HTTP_REFERER'], "could not add right now try again later");
}

redirect($_SERVER['HTTP_REFERER'], "added");