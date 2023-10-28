<?php
require_once('../includes/dbh.inc.php');

// Sample data for testing
$sampleData = [
    // Row 4
    [
        "name" => "Mary Johnson",
        "email" => "mary@example.com",
        "password" => password_hash("marypass", PASSWORD_DEFAULT),
        "blood_group" => "AB+",
        "address" => "567 Pine Street",
        "city" => "Hometown",
        "state" => "IL",
        "postal_code" => "54321",
        "phone_number" => "555-789-0123",
        "registration_date" => "2023-04-05",
    ],
    // Row 5
    [
        "name" => "David Lee",
        "email" => "david@example.com",
        "password" => password_hash("davidpass", PASSWORD_DEFAULT),
        "blood_group" => "A-",
        "address" => "321 Cedar Avenue",
        "city" => "Villageville",
        "state" => "OH",
        "postal_code" => "12345",
        "phone_number" => "555-987-6543",
        "registration_date" => "2023-05-15",
    ],
    // Row 6
    [
        "name" => "Sarah Brown",
        "email" => "sarah@example.com",
        "password" => password_hash("sarahpass", PASSWORD_DEFAULT),
        "blood_group" => "B+",
        "address" => "987 Redwood Lane",
        "city" => "Metropolis",
        "state" => "GA",
        "postal_code" => "56789",
        "phone_number" => "555-543-2109",
        "registration_date" => "2023-06-20",
    ],
    // Row 7
    [
        "name" => "Michael Wilson",
        "email" => "michael@example.com",
        "password" => password_hash("michaelpass", PASSWORD_DEFAULT),
        "blood_group" => "O-",
        "address" => "246 Birch Street",
        "city" => "Smalltown",
        "state" => "SC",
        "postal_code" => "43210",
        "phone_number" => "555-321-7654",
        "registration_date" => "2023-07-01",
    ],
    // Row 8
    [
        "name" => "Karen Davis",
        "email" => "karen@example.com",
        "password" => password_hash("karenpass", PASSWORD_DEFAULT),
        "blood_group" => "A+",
        "address" => "654 Oakwood Road",
        "city" => "Villageton",
        "state" => "FL",
        "postal_code" => "12345",
        "phone_number" => "555-789-4321",
        "registration_date" => "2023-08-10",
    ],
    // Add more rows here...
];


// Insert sample data into the "receiver" table
foreach ($sampleData as $data) {
    $sql = "INSERT INTO receiver (name, email, password, blood_group, address, city, state, postal_code, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $data['name'], $data['email'], $data['password'], $data['blood_group'], $data['address'], $data['city'], $data['state'], $data['postal_code'], $data['phone_number'], $data['registration_date']);
        mysqli_stmt_execute($stmt);
    }
}

// Close the database connection
mysqli_close($conn);

echo "Sample data inserted successfully.";
?>
