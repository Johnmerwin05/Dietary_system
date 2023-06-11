<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<script language="javascript" type="text/javascript">
window.history.forward();
</script>
	<title>LOGIN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
  
  <style type="text/css">

.pass input {
   margin-bottom: 5%
}


</style>
</head>
<body>

<div class="center">
      <h1>Admin | Login</h1>
     <form action="login.php" method="post">
     	<?php 
     	
     	
     	if (isset($_GET['error'])) { ?>
     	     
     	
     	
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		 
		 <div class="txt_field">  
          <input type="text" name="uname" >
          <span></span>
          <label>Username</label>
        </div>

		 <div class="txt_field">
          <input type="password" name="password">
          <span></span>
          <label>Password</label>
        </div>

      
        <div class="button"><input type="submit" value="Login"></div>
        

        <div class="signup_link"> <!-- Dont have an account?<a href="signup.php">Signup</a> -->
        </div>



     </form>
</body>
</html>