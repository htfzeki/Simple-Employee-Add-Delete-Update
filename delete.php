<?php
include('config/db_connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // Safely handle the 'id' parameter

    $sql = "DELETE FROM employee WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect after deletion
        header('Location: modify.php'); // Adjust to your actual employee list page
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
