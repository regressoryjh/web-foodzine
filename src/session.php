<?php
session_start();

$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName="user_db";
$conn=mysqli_connect($hostName,$dbUser, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

