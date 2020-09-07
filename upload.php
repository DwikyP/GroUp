<?php 
  include 'connection.php';
    session_start();
    //check if there is no login session
    if(!isset($_SESSION['login'])){
      header("Location: index.php");
      exit;
   }

  if (isset($_POST['upload'])) {
    $directory = $_POST['directory'];
    $filename = $_POST['filename'];
    
    exec("java -Xmx512m -jar DwikyPutra_23.jar $directory $filename",$output);

    foreach ($output as $value) {
      echo "<script type='text/javascript'>alert('$value');</script>";
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

    <title>Upload</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="regis_style.css" rel="stylesheet">

</head>
<body>
<ul>
  <li><a class="active" href="index.php"><img src='img/home.png' width='35' height='35'></a></li>
</ul>

<form action="" method="post">
  <div class="container">
    <h1>Upload a File</h1>
    <hr>
     <p><center>
        <label for="directory"><b>Directory</b></label>
        <input type="text" placeholder="e.g: D:\Folder\abc.txt (Without Space)" name="directory" required>
    </center>
    </p>
    <p>
      <center>
        <label for="filename"><b>File Name</b></label>
        <input type="text" placeholder="e.g: FileName.txt (Without Space)" name="filename" required>
      </center>
    </p>
    <hr>
    <center><button type="submit" class="btn btn-lg btn-default registerbtn" name="upload">Upload</button></center>
  </div>
</form>

</body>
</html>