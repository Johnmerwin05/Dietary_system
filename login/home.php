
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link href="../assets/img/rrr1.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

    <style type="text/css">

   .form-group a {
      text-decoration:none;
   }


</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Welcome to CDK Monitoring.</p>
                    <div class="form-group">
                        <a href="login-user.php" class="form-control button" ><span><center>Patient</center></span></a>
                    </div>

                    <div class="form-group">
                        <a href="../admin/t/index.php" class="form-control button" ><span><center>Admin</center></span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>