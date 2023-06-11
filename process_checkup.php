<?php
// Import php-ml library
require __DIR__ . '/vendor/autoload.php';
use Phpml\Classification\NaiveBayes;
include 'connection/database.php';

// Get input values
$name = $_POST['name'];
$blood_min = $_POST['blood_min'];
$blood_max = $_POST['blood_max'];
$eGFR = floatval($_POST['eGFR']);
$Urine = $_POST['Urine'];
$sugar = $_POST['sugar'];
$serum_Potassium = $_POST['serum_Potassium'];
$serumCr = $_POST['serumCr'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$height = $_POST['height'];


// Calculate blood pressure average
$blood_result = ($blood_min + 2*$blood_max) / 3;

// Check blood pressure level
if ($blood_result < 90/60) {
    $blood_results = "Low blood";
} elseif ($blood_result >= 90/60 && $blood_result <= 120/80) {
    $blood_results = "Normal blood";
} elseif ($blood_result > 120/80) {
    $blood_results = "High blood";
}


// Calculate urine albumin-to-creatinine ratio
$Urine_result = $Urine / $serumCr;

// Check sugar level
if ($sugar >= 126) {
    $sugar_result = 'Diabetes';
} else if ($sugar >= 100) {
    $sugar_result = 'Prediabetes';
} else {
    $sugar_result = 'Normal';
}

$features = [
    [90.0],
    [60.0],
    [45.0],
    [30.0],
    [15.0],
    [14.0],
];
$targets = [
    'Stage 1 normal',
    'Stage 2 Mild',
    'Stage 3A Moderate',
    'Stage 3B Moderate',
    'Stage 4 Severe',
    'Stage 5 End Stage',
];

$classifier = new NaiveBayes();
$classifier->train($features, $targets);

$input_data = [$eGFR];
$predicted_stage = $classifier->predict([$input_data])[0];


// Task 2: Creatinine Level Prediction

$training_data = [
    ['Male', 114.9],
    ['Female', 97.2],
    ['Male', 61.8],
    ['Female', 52],
    ['Male', 115],
    ['Female', 97.3],
];

$training_labels = [
    'Normal',
    'Normal',
    'Low',
    'Low',
    'High',
    'High',
];

$classifier = new NaiveBayes();
$classifier->train($training_data, $training_labels);

if ($gender == 'Male') {
    $creatinine_clearance_cg = ((140 - $age) * $weight) / ($serumCr * 72);
} else {
    $creatinine_clearance_cg = ((140 - $age) * $weight) / ($serumCr * 72 * 0.85);
}

$input_data = [$gender, $creatinine_clearance_cg];
$creatinine_level = $classifier->predict([$input_data])[0];

// Task 3: Serum Potassium Level Prediction

$training_data = [
    [5.1], 
    [3.4], 
    [5.0], 
];

$training_labels = [
    'High',
    'Low',
    'Normal',
]; 

$classifier = new NaiveBayes();
$classifier->train($training_data, $training_labels);

$potassium = 0.993 * pow($serum_Potassium, -0.205) * pow($weight, 0.5);

$input_data = [$potassium];

$potassium_level_array = $classifier->predict([$input_data])[0];


// Task 4: BMI Category Prediction

$training_data = [
    [18.5],
    [24.9], 
    [25],
    [30], 
];

$training_labels = [
    'Underweight',
    'Normal',
    'Overweight',
    'Obese',
];

$classifier = new NaiveBayes();
$classifier->train($training_data, $training_labels);

$bmi = ($weight / ($height * $height)) * 10000;

$input_data = [$bmi];

$bmi_category = $classifier->predict([$input_data])[0];


$predicted_stage_string = (string) $predicted_stage;
$bmi_sting = (string) $bmi;
$bmi_category_string = (string) $bmi_category;
$potassium_string = (string) $potassium;
$potassium_level_array_string = (string) $potassium_level_array;
$creatinine_clearance_cg_string = (string) $creatinine_clearance_cg;
$creatinine_level_string = (string) $creatinine_level;

$sql = "INSERT INTO checkup (name, age, Gender, Weight, Height, eGFR, CKD_Status, BMI, Blood, UACR, Blood_sugar, Potassium, Creatinine)
VALUES ('$name', '$age', '$gender', '$weight kg', '$height cm', '$eGFR mL/min/1.73m²', '$predicted_stage_string', CONCAT(ROUND($bmi_sting, 2), ' -> ', '$bmi_category_string'), CONCAT(ROUND($blood_result, 2), ' -> ', '$blood_results'), ROUND($Urine_result, 2), '$sugar_result', CONCAT(ROUND($potassium_string, 2), ' mmol/L', '$potassium_level_array_string'), CONCAT(ROUND($creatinine_clearance_cg_string, 2), ' µmol/L ->', '$creatinine_level_string'))";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Dietary plan & Food recommendation</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo1.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <style>
    @media print {
        body * {
            margin: 0;
            visibility: hidden;

        }

        #printmoko, #printmoko *{
            visibility: visible;

        }

        #print-button *{
            display: none;
        }

        header, footer {
            display: none;
        }


    
    }
</style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-content">
            <h3>Cooking in progress..</h3>
            <div id="cooking">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div id="area">
                    <div id="sides">
                        <div id="pan"></div>
                        <div id="handle"></div>
                    </div>
                    <div id="pancake">
                        <div id="pastry"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area bg-img bg-overlay" style="background-image: url(img/bg-img/header.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <div class="col-12 col-sm-6">
                        <!-- Top Social Info -->
                        <div class="top-social-info">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-5 col-xl-4">
                        <!-- Top Search Area -->
                        <div class="top-search-area">
                            <form action="#" method="post">
                                <input type="search" name="top-search" id="search-input" placeholder="Search">
                                <button type="submit" class="btn" ><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo Area -->
        <div class="logo-area">
            <a href="index.html"><img src="img/core-img/logo.png" alt="" width="60%"></a>
        </div>

        <!-- Navbar Area -->
        <div class="bueno-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="buenoNav">

                        <!-- Toggler -->
                        <div id="toggler"><img src="img/core-img/toggler.png" alt=""></div>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="plan.html">Diet Plans</a></li>
                                    <li><a href="food.html">Food recommendation</a></li>
                                    <li><a href="treat.html">Treatments</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>

                                <!-- Login/Register -->
                                <div class="login-area">
                                    <a href="checkup.php">Online Check-Up</a>
                                </div>
                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Treading Post Area Start ##### -->
    <div class="treading-post-area" id="treadingPost">
        <div class="close-icon">
            <i class="fa fa-times"></i>
        </div>

        <h4>Treading Post</h4>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/9.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Friend eggs with ham</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/10.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Mushrooms with pork chop</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/11.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Birthday cake with chocolate</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/9.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Friend eggs with ham</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/10.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Mushrooms with pork chop</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>

        <!-- Single Blog Post -->
        <div class="single-blog-post style-1 d-flex flex-wrap mb-30">
            <!-- Blog Thumbnail -->
            <div class="blog-thumbnail">
                <img src="img/bg-img/11.jpg" alt="">
            </div>
            <!-- Blog Content -->
            <div class="blog-content">
                <a href="#" class="post-tag">The Best</a>
                <a href="#" class="post-title">Birthday cake with chocolate</a>
                <div class="post-meta">
                    <a href="#" class="post-date">July 11, 2018</a>
                    <a href="#" class="post-author">By Julia Stiles</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Treading Post Area End ##### -->


     <!-- ##### Post Details Area Start ##### -->
     <section class="post-news-area section-padding-100-0 mb-70">
        <div class="container" id="printmoko">
            <div class="row justify-content-center">
                <!-- Post Details Content Area -->
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="post-details-content mb-100">
                        <div class="blog-thumbnail mb-50">

                        <div class="button-print" id="print-button">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
                        <!--<button type="button" class="btn btn-success" onclick="window.print()">Print</button>-->

                        </div>
                            
                        </div>
                        <div class="blog-content">
                            <a href="#" class="post-tag">Result</a>
                            <h4 class="post-title">PRE-DIALYSIS CHRONIC KIDNEY DISEASE </h4>
                            <div class="post-meta mb-50">   
                                <a href="#" class="post-date">Learning tips</a>
                                <a href="#" class="post-author">by Dietary plan</a>
                            </div>

                            <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Name:&nbsp;&nbsp;&nbsp; <?= $name ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Age:&nbsp;&nbsp;&nbsp; <?= $age ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Gender:&nbsp;&nbsp;&nbsp; <?= $gender ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Weight:&nbsp;&nbsp;&nbsp; <?= $weight ?> Kg</p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Height:&nbsp;&nbsp;&nbsp; <?= $height ?> Cm</p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">eGFR:&nbsp;&nbsp;&nbsp; <?= $eGFR, " mL/min/1.73m²<br>" ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <p style="font-weight: 600;">CKD Status:&nbsp;&nbsp;&nbsp; <?= $predicted_stage_string ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">BMI:&nbsp;&nbsp;&nbsp; <?= round($bmi_sting, 2), " -> ", $bmi_category_string ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Blood:&nbsp;&nbsp;&nbsp; <?= round($blood_result,2)," -> ", $blood_results ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <p style="font-weight: 600;">UACR:&nbsp;&nbsp;&nbsp; <?= round($Urine_result,2) ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Blood sugar:&nbsp;&nbsp;&nbsp; <?= $sugar_result ?></p>
                                </div>
                                <div class="col-md-4">
                                <p style="font-weight: 600;">Potassium:&nbsp;&nbsp;&nbsp; <?= round($potassium_string, 2), " mmol/L  -> ", $potassium_level_array_string ?></p>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-6">
                                <p style="font-weight: 600;">Creatinine:&nbsp;&nbsp;&nbsp; <?= round($creatinine_clearance_cg_string, 2), " µmol/L  -> ", $creatinine_level_string ?></p>
                                </div>
                            </div>
                            </div>
                            <div class="blog-content mt-70">
                                    <a href="#" class="post-tag">recommendation</a>
                            <?php
                            if($creatinine_level == "Normal"){
                                ?>
                                    <p class="post-title" style="font-size: large;">Foods you must eat with Normal Creatinine</p>  
                                        <div class="gg ml-50 mr-50 mt-50 ">
                                        <div class="row">
                                            <div class="col-md-4">
                                            <li style="font-weight: 600;">Fatty fish</li>
                                            </div>
                                            <div class="col-md-4">
                                            <li style="font-weight: 600;">Leafy greens </li>
                                            </div>
                                            <div class="col-md-4">
                                            <li style="font-weight: 600;">Whole grains</li>
                                            </div>
                                            <div class="col-md-4">
                                            <li style="font-weight: 600;">Berries</li>
                                            </div>
                                            <div class="col-md-4">
                                            <li style="font-weight: 600;">Garlic</li>
                                            </div>
                                        </div>
    
                                    </div>    

                            <?php
                            }else if ($creatinine_level == "High"){
                            ?>
                                <p class="post-title" style="font-size: large;">Foods you must eat with High Creatinine</p>  
                                    <div class="gg ml-50 mr-50 mt-50 ">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">apples</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">berries</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">cabbage</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">carrots</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">green beans</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">onions</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">bread</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">rice</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">pasta</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">avocados</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">nuts</li>
                                        </div>
                                        <div class="col-md-4">
                                        <li style="font-weight: 600;">olive oil</li>
                                        </div>
                                    </div>

                                </div>   

                            <?php
                            }else {
                            ?>
                            <p class="post-title" style="font-size: large;">Foods you must eat with Low Creatinine</p>  
                                <div class="gg ml-50 mr-50 mt-50 ">
                                <div class="row">
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Red meats</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Seafood</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Milk</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">cheese</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">yogurt</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Eggs</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Beans</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">legumes</li>
                                    </div>
                                </div>

                            </div> 
                            <?php
                            }                            
                            if($potassium_level_array == "High"){
                                ?>
                                <br><br><br><br>
                                <p class="post-title" style="font-size: large;">Foods you must eat with High Potassium</p>  
                                <div class="gg ml-50 mr-50 mt-50 ">
                                <div class="row">
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Bananas</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Sweet potatoes</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Spinach</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Avocado</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Lentils</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Salmon</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Yogurt</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Tomatoes</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Mushrooms</li>
                                    </div>
                                </div>
                            </div> 

                            <?php
                            }else if ($potassium_level_array == "Normal"){
                            ?>
                            <br><br><br><br>
                                <p class="post-title" style="font-size: large;">Foods you must eat with Normal Potassium</p>  
                                <div class="gg ml-50 mr-50 mt-50 ">
                                <div class="row">
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Broccoli</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Carrots</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Eggs</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Grapes</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Quinoa</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Oats</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Almonds</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Chicken breast</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Beef</li>
                                    </div>
                                </div>
                            </div> 
                            <?php
                            }else {
                            ?>
                            <br><br><br><br>
                                <p class="post-title" style="font-size: large;">Foods you must eat with Low Potassium</p>  
                                <div class="gg ml-50 mr-50 mt-50 ">
                                <div class="row">
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Apples</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Blueberries</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Cauliflower</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Cucumber</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Green beans</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Rice</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Noodles</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Bread</li>
                                    </div>
                                    <div class="col-md-4">
                                    <li style="font-weight: 600;">Beef</li>
                                    </div>
                                </div>
                            </div> 
                            <?php
                            }
                            ?>
                            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Post Details Area End ##### -->


    <!-- ##### Instagram Area Start ##### -->
    <div class="instagram-feed-area d-flex flex-wrap">
        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta1.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta1.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta2.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta2.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta3.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta3.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta4.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta4.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta5.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta5.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta6.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta6.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta7.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta7.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta8.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta8.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta9.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta9.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>

        <!-- Single Instagram -->
        <div class="single-instagram">
            <img src="img/bg-img/insta10.jpg" alt="">
            <!-- Image Zoom -->
            <a href="img/bg-img/insta10.jpg" class="img-zoom" title="Instagram Image">+</a>
        </div>
    </div>
    <!-- ##### Instagram Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-5">
                    <!-- Copywrite Text -->
                    <p class="copywrite-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> CKD Monitoring & Food recommendation </a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
                <div class="col-12 col-sm-7">
                    <!-- Footer Nav -->
                    <div class="footer-nav">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li class="active"><a href="plan.html">Diet Plans</a></li>
                            <li><a href="food.html">Food recommendation</a></li>
                            <li><a href="treat.html">Treatments</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>
