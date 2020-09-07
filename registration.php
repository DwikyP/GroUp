<?php 
  include 'connection.php';
  session_start();
//check if there's session login
    if(isset($_SESSION['login'])){
      header("Location: index.php");
      exit;
    }

  $errors = array();
  if(isset($_POST["register"])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $emailvalid = preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email);
    //validating the user input
    $query = "SELECT * FROM users Where username = '$username'";
    $sql = mysqli_query($conn,$query);
    //create list of errors
    if ($pass !== $cpass){
      array_push($errors,"Password must match with the confirm password !");
    }
    if (mysqli_num_rows($sql) > 0 ){
      array_push($errors,"Username has already been used !");
    }
    if (!$emailvalid){
      array_push($errors,"Email not valid !");
    }
    $query = "SELECT * FROM users Where email = '$email'";
    $sql = mysqli_query($conn,$query);
    if (mysqli_num_rows($sql) > 0){
      array_push($errors,"Email has been registered !");
    }
    if (strlen($pass) < 8){
      array_push($errors,"Password at least 8 characters !");
    }

    //if there is no more errors, then the data will be inputted to database
    if (count($errors) == 0){
      $pass = password_hash($pass, PASSWORD_DEFAULT);
      $query = "INSERT INTO Users VALUES('', '$username', '$email', '$pass')";
      $sql = mysqli_query($conn,$query);
      $message = "Registration is success";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
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

    <title>Sign Up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="regis_style.css" rel="stylesheet">

</head>
<body>
<ul>
  <li><a class="active" href="index.php"><img src='img/home.png' width='35' height='35'></a></li>
</ul>
<form action="" method="post">
  <div class="container">
    <h1>Registration Form</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
     <p><center>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
    </center>
    </p>
    <p><center>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
    </center>
    </p>
    <p>
      <center>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pass" required>
      </center>
    </p>
    <p>
      <center>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="cpass" required>
      </center>
    </p>
    <hr>
    <!-- Print list of errors -->
    <?php if (count($errors) > 0) :?>
    <center><div id="show">
      <p>Sorry there are some wrong inputs :</p>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach ?>
    </div></center>
    <?php endif ?>
    <center><button type="submit" name="register" class="btn btn-lg btn-default registerbtn">REGISTER</button></center>
    <center><p>Already have an account? <a href="login.php">Sign in</a>.</p></center>
  </div>
</form>

</body>
</html>
