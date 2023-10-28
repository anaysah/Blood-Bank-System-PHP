<?php
// Start or resume the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/header.css">
</head>

<body>
    <main>
        <header class="mb-4 bg-primary text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <h3 class="my-2">Blood Bank System</h3>
                <nav>
                    <ul class="list-unstyled m-0 d-flex gap-2">
                        <li><a href="/" class="text-white">Home</a></li>
                        <?php if (!isset($_SESSION['userType'])): ?>
                            <li><a href="/auth" class="text-white">Login</a></li>
                        <?php endif; ?>
                        <div class="dropdown">
                            <a class="text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Register
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/auth/registration/receiver.php">as Receiver</a>
                                </li>
                                <li><a class="dropdown-item" href="/auth/registration/hospital.php">as Hospital</a>
                                </li>
                            </ul>
                        </div>
                        <?php if (isset($_SESSION['userType'])): ?>
                            <li><a href='/includes/logout.inc.php' class="text-white">Logout</a></li>
                            <li><a href="/<?= $_SESSION['userType'] ?>" class="text-white">Dashbaord</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>