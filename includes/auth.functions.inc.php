<?php
function isInputEmpty($attributes)
{
    $result = false;
    foreach ($attributes as $attribute) {
        if (empty($attribute)) {
            $result = true;
            break; // Exit the loop as soon as an empty attribute is found
        }
    }
    return $result;
}

function invalidEmailId($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emailExists($conn, $email, $userType)
{
    $sqlQ = "SELECT * FROM " . $userType . " WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sqlQ)) {
        redirect($_SERVER['PHP_SELF'], "STMP fail");
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultDATA = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultDATA);
    mysqli_stmt_close($stmt);

    if ($row) {
        return $row;
    } else {
        return false;
    }
}

function createUser($conn, $email, $name, $pass, $address, $city, $state, $postalCode, $phoneNumber, $userType, $bloodGroup = NULL)
{
    $sql_query = "INSERT INTO {$userType} (name, email, password, address, city, state, postal_code, phone_number, registration_date";
    $bindParams = "ssssssiis";
    $paramValues = [$name, $email, password_hash($pass, PASSWORD_DEFAULT), $address, $city, $state, $postalCode, $phoneNumber, date("Y-m-d")];

    if ($userType === 'receiver' && $bloodGroup !== NULL) {
        $sql_query .= ", blood_group";
        $bindParams .= "s";
        $paramValues[] = $bloodGroup;
    }

    $sql_query .= ") VALUES (?" . str_repeat(", ?", count($paramValues) - 1) . ")";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql_query)) {
        redirect($_SERVER['HTTP_REFERER'], "STMP fail");
    }

    mysqli_stmt_bind_param($stmt, $bindParams, ...$paramValues);

    $result = false;

    if (mysqli_stmt_execute($stmt)) {
        $result = ["id" => mysqli_insert_id($conn)];
    }

    mysqli_stmt_close($stmt);

    return $result;
}
