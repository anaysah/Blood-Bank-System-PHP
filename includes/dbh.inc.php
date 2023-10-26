<?php

$serverName = "localhost";
$DBusername = "root";
$DBpass = "";
$DBname = "BloodBankSystem";
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$domain = $_SERVER['HTTP_HOST'];
$websiteUrl = $protocol . $domain;

$conn = mysqli_connect($serverName,$DBusername,$DBpass,$DBname);

if(!$conn){
    die("connection failed". mysqli_connect_error());
}