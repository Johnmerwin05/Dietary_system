<?php

include '../connection/database.php';

$pages = range(10000,100000);
// Shuffle numbers
shuffle($pages);
// Get a page
$page = array_shift($pages);

    $ticket = $page;
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $sur1 = $_POST['sur1'];
    $sur2 = $_POST['sur2'];
    $sur3 = $_POST['sur3'];
    $sur4 = $_POST['sur4'];
    $eGFR = $_POST['eGFR'];
    $blood_min = $_POST['blood_min'];
    $blood_max = $_POST['blood_max'];
    $Urine = $_POST['Urine'];
    $sugar = $_POST['sugar'];

    if ($eGFR >= 90){

        $eGFR_result = "STAGE 1";
        $status = "NORMAL";

    }else if ($eGFR >= 60 && $eGFR <= 89){

        $eGFR_result = "STAGE 2";
        $status = "MILD LOSE";

    }else if ($eGFR >= 30 && $eGFR <= 59){

        $eGFR_result = "STAGE 3";
        $status = "MILD TO MODERATE";

    }else if ($eGFR >= 15 && $eGFR <= 29){

        $eGFR_result = "STAGE 4";
        $status = "SEVERE";

    }else{

        $eGFR_result = "STAGE 5";
        $status = "FAILURE";

    }

    if($blood_min <= 120 && $blood_min >= 91 && $blood_max <= 80 && $blood_max >= 61){
        $blood = "Normal";
    }else if($blood_min <= 90 && $blood_max <= 60){
        $blood = "Low Blood";
    }else if($blood_min <= 129 && $blood_min >= 120  && $blood_max <= 80){
        $blood = "Elevated";
    }else if($blood_min <= 139 && $blood_min >= 130  && $blood_max <= 89 && $blood_max >= 80){
        $blood = "High Blood Pressure (Hypertension) Stage 1";
    }else if($blood_min >= 140 && $blood_min <= 179  && $blood_max >= 80 && $blood_max <= 119){
        $blood = "High Blood Pressure (Hypertension) Stage 2";
    }else if ($blood_min >= 180  && $blood_max >= 120){
        $blood = "Hypertensive Crisis";
    }



    if ($Urine >= 30 && $Urine <= 300){

        $Urine_result = "microalbuminuria";

    }else if ($Urine > 300){

        $Urine_result = "macroalbuminuria";

    }else {

        $Urine_result = "Normal";
    }



    if ($sugar >= 70 && $sugar <= 100){

        $sugar_result = "Normal";

    }else if ($sugar >= 101 && $sugar <= 125){

        $sugar_result = "Pre-Diabetes";

    }else if ($sugar > 126){

        $sugar_result = "Diabetes";

    }else if ($sugar < 70) {

        $sugar_result = "Low Blood Sugar (Hypoglycemia)";
        
    }


    //check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $has_errors = false; 

    if (empty($_POST['name']) || empty($_POST['age']) || empty($_POST['gender']) || empty($_POST['contact']) || empty($_POST['sur1']) || empty($_POST['sur2']) || empty($_POST['sur3']) || empty($_POST['sur4']) || empty($_POST['eGFR']) || empty($_POST['blood_min']) || empty($_POST['blood_max']) || empty($_POST['Urine']) || empty($_POST['sugar']) ) {
        $has_errors = true;
    }

    if ($has_errors) {
        echo "error";
        exit();
    }


    //insert form data into database
    $sql = "INSERT INTO checkup (ticket, name, age, gender, contact, eGFR, blood, Urine, sugar, status)
    VALUES ('$ticket','$name', '$age', '$gender', '$contact', '$sur1', '$sur2', '$sur3', '$sur4', '$eGFR_result', '$blood', '$Urine_result', '$sugar_result', '$status')";

    if(mysqli_query($conn, $sql)){

        if($eGFR_result == "STAGE 1"){

            echo "stage1?ticket=$ticket";

        }else if ($eGFR_result == "STAGE 2"){

            echo "stage1?ticket=$ticket";

        }else if ($eGFR_result == "STAGE 3"){

            echo "stage1?ticket=$ticket";

        }else if ($eGFR_result == "STAGE 4"){

            echo "stage4?ticket=$ticket";

        }else if ($eGFR_result == "STAGE 5"){

            echo "stage5?ticket=$ticket";
            
        }else{
            echo "failed";
        }
            
    } else {
        echo "failed";
    }

    mysqli_close($conn);
?>
