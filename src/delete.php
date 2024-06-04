<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM user_form WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if ($stmt) {
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>Record deleted successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error deleting record.</div>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<div class='alert alert-danger'>Error preparing statement.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error initializing statement.</div>";
    }
}
mysqli_close($conn);
header("Location: login.php"); // Redirect to the login page 
exit();
