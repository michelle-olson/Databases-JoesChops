<!DOCTYPE html>
<?php 
	if(isset($_POST['Username'])){
		$username = $_POST['Username'];
		$url = "plan.php?Username=" . $username;
		header('Location: ' . $url);
		exit();
	}
?>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Joe's Chops Login</title>
    <link rel="stylesheet" href="style.css"
  </head>
  <body>
    <div class="login">
      <img src="user.png" alt="" class="user">
      <h1>Welcome to Joe's Chops! The best car customizing service!</h1>
      <h2>Login Here</h2>
        <form action="index.php" method="post">
          <p>Username</p>
          <input type="text" name="Username" value="" placeholder="Enter Username">
          <form>
            <input type="submit" value="Log in" name="submit" />
          </form>
 
          <a href="#">Don't have an Account</a>
        </form>
    </div>
  </body>
</html>
