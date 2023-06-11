<?php 
include '../t/db_conn.php';

 $id = $_GET['id'];

 $query = mysqli_query($conn, "DELETE FROM admins WHERE id = '$id'");

 header('location: ../admins.php?=1');

?>
