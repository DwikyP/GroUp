<?php 
  include 'connection.php';
    session_start();
//check if there is no login session
    if(!isset($_SESSION['login'])){
      header("Location: index.php");
      exit;
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

    <title>List Files</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="regis_style.css" rel="stylesheet">
    <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
      background-color: #000000;
      color: white;
    }
    </style>
</head>
<body>
<ul>
  <li><a class="active" href="index.php"><img src='img/home.png' width='35' height='35'></a></li>
</ul>

<form action="" method="post">
  <div class="container">
    <h1>List of Files</h1>
    <hr>
    <table>
        <tr>
          <th>File Name</th>
          <th>Size</th>
          <th>Date Modified</th>
        </tr>
        <?php 
           exec("java -Xmx512m -jar DwikyPutra_25.jar",$output);
           for ($i=0; $i < count($output); $i = $i + 3) { 
             echo "<tr><td>".$output[$i]."</td><td>".$output[$i+1]."</td><td>".$output[$i+2]."</td></tr>";
           }
        ?>
    </table>
    <hr>
  </div>
</form>

</body>
</html>