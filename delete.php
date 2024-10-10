<?php
include('config/db_connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    $sql = "DELETE FROM employee WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        header('Location: modify.php'); 
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
