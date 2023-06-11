<?php
include 'connection/database.php';
session_start();
if (!isset($_SESSION["email"]) || $_SESSION["email"] == false){

    header("Location: login/login-user.php");
    exit;
}

$email = $_SESSION['email']; 
$query="SELECT * FROM usertable WHERE email = '$email'";  
$connect=mysqli_query($conn,$query);  
$num=mysqli_num_rows($connect);



if ($num > 0) {
  while ($data = mysqli_fetch_assoc($connect)) {
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
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                <input type="search" name="top-search" id="topSearch" placeholder="Search">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
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
                                    <a href="login/logout-user.php">Log out</a>
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

    <!-- ##### Search Area Start ##### -->
    <div class="bueno-search-area section-padding-100-0 pb-70 bg-img" style="background-image: url(img/core-img/pattern.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="process_checkup.php" method="post" id="checkup-form">
                        <div class="row">
                        <h3 style="color: rgb(122, 122, 122); margin-bottom: 5%; font-weight: 600;">Demographic Information</h3>

                        <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $data['name'] ?>" readonly>
                                </div> 
                            </div>
                            <?php
  }}

                            ?>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Age</label>
                                <input type="text" name="age" class="form-control" maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Weight</label>
                                <input type="text" name="weight" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary">Kg</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Height</label>
                                <input type="text" name="height" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary">cm</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Gender</label>
                                    <select class="form-control" id="recipe" name="gender">
                                      <option selected="true" disabled="disabled">Select gender</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Serum Creatinine:</label>
                                <input type="text" name="serumCr" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> 
                                &nbsp;<span class="badge bg-secondary">µmol/L</span>                               
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                            <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Glomerular filtration rate (eGFR):</label>
                                <input type="text" name="eGFR" class="form-control" readonly>                                
                            </div>
                            </div>

                            <script>
                            // Add the event listeners inside the <form> tag
                            const genderSelect = document.getElementById("recipe");
                            const ageInput = document.getElementsByName("age")[0];
                            const weightInput = document.getElementsByName("weight")[0];
                            const heightInput = document.getElementsByName("height")[0];
                            const creatinineInput = document.getElementsByName("serumCr")[0];
                            const eGFRInput = document.getElementsByName("eGFR")[0];

                            // add event listeners to calculate eGFR when inputs are changed
                            genderSelect.addEventListener("change", calculateEGFR);
                            ageInput.addEventListener("input", calculateEGFR);
                            weightInput.addEventListener("input", calculateEGFR);
                            creatinineInput.addEventListener("input", calculateEGFR);

                            function calculateEGFR() {
                                // get the input values
                                const gender = genderSelect.value;
                                const age = ageInput.value;
                                const weight = weightInput.value;
                                const creatinine = creatinineInput.value; // convert from mg/dL to µmol/L

                                // calculate eGFR using MDRD equation for adults or CKD-EPI equation for all ages
                                let eGFR;
                                if (age >= 18) {
                                if (gender === "Male") {
                                    eGFR = 175 * Math.pow(creatinine / 100, -1.154) * Math.pow(age, -0.203) * Math.pow(weight, -0.711) * 1.212;
                                } else if (gender === "Female") {
                                    eGFR = 175 * Math.pow(creatinine / 100, -1.154) * Math.pow(age, -0.203) * Math.pow(weight, -0.711) * 0.742;
                                }
                                } else {
                                if (gender === "Male") {
                                    eGFR = 141 * Math.min(Math.pow(creatinine / 81, -0.411), 1) * Math.pow(0.993, age) * Math.pow(weight, -0.633) * 1.212;
                                } else if (gender === "Female") {
                                    eGFR = 141 * Math.min(Math.pow(creatinine / 72, -0.329), 1) * Math.pow(0.993, age) * Math.pow(weight, -0.329) * 0.742;
                                }
                                }

                                // display eGFR on the input field
                                displayEGFR(eGFR.toFixed(2));
                            }

                            function displayEGFR(value) {
                                const bsa = Math.pow((heightInput.value * weightInput.value * 0.007184), 0.5);
                                const egfrPerBSA = value / bsa;
                                eGFRInput.value = egfrPerBSA.toFixed(2) + " mL/min/1.73m²";
                            }
                            </script>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Serum Potassium:</label>
                                <input type="text" name="serum_Potassium" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">   
                                &nbsp;<span class="badge bg-secondary">mmol/L</span>                             
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30 ">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Blood pressure:</label>
                                <div class="form-check-inline">
                                <input type="text" name="blood_min" class="form-control col-lg-3 " pattern="\d{3}" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary mr-2">min</span>
                                <input type="text" name="blood_max" class="form-control col-lg-3  " pattern="\d{2}" maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary">max</span>

                                </div>
                                </div>
                        
                                </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Urine albumin-to-creatinine ratio:</label>
                                <input type="text" name="Urine" class="form-control" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary">mg/g</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group mb-30 ">
                                <label style="font-family: Montserrat; font-weight: 600; color: rgb(122, 122, 122);">Blood sugar:</label> 
                                <input type="text" name="sugar" class="form-control" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                &nbsp;<span class="badge bg-secondary">mg/dl</span>
                                
                        
                                </div>
                            </div>

                            </div>
                            <center>
                            <div class="col-lg-3">
                                <div class="form-group mb-30">
                                    <button class="btn bueno-btn w-100">Submit</button>                                   
                                </div>
                            </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Search Area End ##### -->

    <!-- ##### Catagory Area Start ##### -->
    <div class="post-catagory section-padding-100">
        <div class="container">
            <div class="row">
                <!-- Single Post Catagory -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-post-catagory mb-30">
                        <img src="img/bg-img/4.jpg" alt="">
                        <!-- Content -->
                        <div class="catagory-content-bg">
                            <div class="catagory-content">
                                <a href="chicken.html" class="post-tag">The Best</a>
                                <a href="chicken.html" class="post-title">Meats Dishes</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Post Catagory -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-post-catagory mb-30">
                        <img src="img/bg-img/5.jpg" alt="">
                        <!-- Content -->
                        <div class="catagory-content-bg">
                            <div class="catagory-content">
                                <a href="#" class="post-tag">The Best</a>
                                <a href="#" class="post-title">Vegetable Foods</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Post Catagory -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-post-catagory mb-30">
                        <img src="img/bg-img/6.jpg" alt="">
                        <!-- Content -->
                        <div class="catagory-content-bg">
                            <div class="catagory-content">
                                <a href="#" class="post-tag">The Best</a>
                                <a href="#" class="post-title">Drinks Dishes</a>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            
        </div>
    </div>
    <!-- ##### Catagory Area End ##### -->

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
                            <li><a href="plan.html">Diet Plans</a></li>
                            <li><a href="food.html">Food Catagories</a></li>
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

    <script>
        
    </script>
</body>

</html>