<?php

$conn = mysqli_connect("localhost", "admin", "admin", "hezekiahinc_db");

if (!$conn) {
    echo "Connection Error:" . mysqli_connect_error();
}
