<?php 
  include 'connection.php';
  session_start();
    //check if there's session login
    if(isset($_SESSION['login'])){
      header("Location: index.php");
      exit;
   }

    if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    //search existing user in database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$username'");


    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      //match the password with the username/email
      if(password_verify($password, $row["password"])){
        $_SESSION["login"] = true;
        $_SESSION["username"] = $row['username'];
        $_SESSION["user_id"] = $row['user_id'];

        header("Location: index.php");
        exit;
      }
    }
    $error = true;
  }

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  <title>Login</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="regis_style.css" rel="stylesheet">

</head>
<body>
<ul>
  <li><a class="active" href="index.php"><img src='img/home.png' width='35' height='35'></a></li>
</ul>

<form action="" method="post">
  <div class="container">
    <h1>Login Form</h1>
    <hr>
     <p><center>
        <label for="username"><b>Username or Email</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
    </center>
    </p>
    <p>
      <center>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
      </center>
    </p>
    <hr>
    <?php
      //notify the user if the username or/and the password is/are wrong 
      if(isset($error)){
        echo "<center>username / password wrong</center>";
      }
    ?>
    <center><button type="submit" class="btn btn-lg btn-default registerbtn" name="login">LOGIN</button></center>
    <center><p>Doesn't have an account? <a href="registration.php">Sign up</a>.</p></center>
  </div>
</form>

</body>
</html>