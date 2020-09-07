<?php 
  session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GrouUp</title>

    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="site-wrapper video-background">
    <a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=S8fzTpBDj1k', containment:'body', autoPlay:true, mute:true, startAt:1, stopAt: 53, opacity:1, }"></a>

    <div class="overlay"></div>

    <div class="site-wrapper-inner">

            <div class="masthead clearfix">
                <div class="inner">
                    <?php 
                    if(isset($_SESSION['login'])){
                        echo "<h3 class='masthead-brand'><img src='img/user.png' width='35' height='35'> ".strtoupper($_SESSION['username'])." <a href='logout.php'><i class='glyphicon glyphicon-off'></i></a></h3>";
                    }
                    else{
                        echo "<h3 class='masthead-brand'><i class='glyphicon glyphicon-log-in'></i><a href='registration.php'> Sign Up</a></h3>";
                    }
                     ?>     
                    <nav>
                        <ul class="nav masthead-nav">
                            <li><a href="upload.php"><i class="glyphicon glyphicon-cloud-upload"></i></a></li>
                            <li><a href="download.php"><i class="glyphicon glyphicon-cloud-download"></i></a></li>
                            <li><a href="list.php"><i class="glyphicon glyphicon-list"></i></a></li>
                            <li><a href="groupchat.php"><i class="fa fa-envelope fa-fw"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="cover-container">
            <div class="inner cover">
                <h1 class="cover-heading">GrouUp</h1>
                <p class="lead">Socialize with strangers.</p>
                <?php 
                    if(isset($_SESSION['login'])){
                        echo "<p class='lead'>Welcome to the club ".strtoupper($_SESSION['username'])."</p>";
                    }
                    else{
                        echo "<p class='lead'><a href='login.php' class='btn btn-lg btn-default'>LOGIN</a></p>";
                    }

                 ?>
            </div>

            <div class="mastfoot">
                <div class="inner">
                    <p>Copyright 2019 &copy; <a href="/">GrouUp</a></p>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- Plugins and Custom JavaScript -->
<script src="js/device.min.js"></script>
<script src="js/jquery.mb.YTPlayer.js"></script>
<script src="js/custom.js"></script>

<!--
Google Analitics
Demo Purpose Only
Change UA-XXXXXXX-X to be your site's ID
 -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-1057679-2', 'auto');
    ga('send', 'pageview');
</script>

</body>
</html>