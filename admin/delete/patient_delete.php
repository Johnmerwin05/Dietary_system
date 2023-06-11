<?php 
include '../t/db_conn.php';

 $id = $_GET['id'];

 $query = mysqli_query($conn, "DELETE FROM contact WHERE id = '$id'");

 header('location: ../patient.php?=1');

?>