<?php
include '../connection/database.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $has_errors = false;

    // check if any form fields are empty or contain invalid data
if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])) {
        $has_errors = true;
    }

    if ($has_errors) {
        echo "error";
        exit();
    }

    //insert form data into database
    $sql = "INSERT INTO contact (name, email, message)
    VALUES ('$name', '$email', '$message')";

    if(mysqli_query($conn, $sql)){
        echo "success";
    } else {
        echo "failed";
    }

    mysqli_close($conn);
?>
