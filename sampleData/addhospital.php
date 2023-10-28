<?php
require_once('../includes/dbh.inc.php');
?>
<?php

// Sample hospital data
// Sample hospital data
$sampleData = array(
    array("Sample Hospital 1", "samplehospital1@example.com", password_hash("samplepassword1", PASSWORD_DEFAULT), "123 Main Street", "Sample City", "Sample State", "12345", "123-456-7890"),
    array("Sample Hospital 2", "samplehospital2@example.com", password_hash("samplepassword2", PASSWORD_DEFAULT), "456 Elm Street", "Sampleville", "Test State", "54321", "987-654-3210"),
    array("Healthcare Center", "safecare@example.com", password_hash("password123", PASSWORD_DEFAULT), "789 Oak Street", "Citytown", "Medicare State", "67890", "456-789-1234"),
    array("City General Hospital", "cityhospital@example.com", password_hash("securepass", PASSWORD_DEFAULT), "321 Hospital Lane", "Metro City", "Healthstate", "56789", "345-678-2345"),
    array("Sunshine Medical Center", "sunshinemed@example.com", password_hash("sunpass123", PASSWORD_DEFAULT), "101 Sunny Avenue", "Sunnyville", "Healthstate", "34567", "234-567-3456"),
    array("MediCare Central Hospital", "medicarecentral@example.com", password_hash("medipass", PASSWORD_DEFAULT), "555 Wellness Road", "Medi City", "Healtherland", "98765", "123-234-4567"),
    array("Community Care Hospital", "communitycare@example.com", password_hash("carepass321", PASSWORD_DEFAULT), "999 Caring Circle", "Community Town", "Caring State", "23456", "789-890-5678"),
    array("LifeSaver Hospital", "lifesaver@example.com", password_hash("savelives", PASSWORD_DEFAULT), "777 Life Way", "Rescueville", "Life Nation", "87654", "567-678-7890"),
    array("Wellness Medical Center", "wellnessmed@example.com", password_hash("wellness123", PASSWORD_DEFAULT), "333 Wellness Drive", "Healthyville", "Healtherland", "65432", "456-567-6789"),
    array("Hope Hospital", "hopehospital@example.com", password_hash("hope4all", PASSWORD_DEFAULT), "222 Hope Street", "Hope City", "Healthstate", "54321", "123-234-3456"),
    array("Sunrise Medical Institute", "sunrisemed@example.com", password_hash("sunrise789", PASSWORD_DEFAULT), "123 Sunrise Lane", "Dawnville", "Healthland", "43210", "567-678-7890"),
    array("Pioneer Healthcare", "pioneerhealth@example.com", password_hash("pioneerpass", PASSWORD_DEFAULT), "111 Progress Road", "Innovation City", "Wellness State", "76543", "234-345-4567"),
    array("Eternal Hope Hospital", "eternalhope@example.com", password_hash("hopeeternal", PASSWORD_DEFAULT), "888 Eternal Avenue", "Hopeville", "Healthland", "21098", "678-789-8901"),
    array("Medical Excellence Center", "medicalexcellence@example.com", password_hash("excellence123", PASSWORD_DEFAULT), "444 Excellence Drive", "Excellence Town", "Healtherland", "12345", "345-456-5678"),
    array("SafeCare Medical Clinic", "safecare@example.com", password_hash("safeandcare", PASSWORD_DEFAULT), "555 Safe Lane", "Safety City", "Healthstate", "87654", "234-345-4567")
    // Add more sample data here as needed
);

// SQL query to insert data into the Hospital table
$sql = "INSERT INTO hospital (name, email, password, address, city, state, postal_code, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURDATE())";

$stmt = $conn->prepare($sql);

foreach ($sampleData as $data) {
    $stmt->bind_param("ssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
    
    if ($stmt->execute()) {
        echo "Data added successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

// Close the database connection
$stmt->close();
$conn->close();
?>
