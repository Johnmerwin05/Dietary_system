<?php
include 't/db_conn.php';
    $sql = "SELECT COUNT(*) as total FROM checkup WHERE gender = 'Male'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $male = $row['total'];

    $sql = "SELECT COUNT(*) as total FROM checkup WHERE gender = 'Female'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $female = $row['total'];

    mysqli_close($conn);

    echo json_encode(array('male' => $male, 'female' => $female));

?>