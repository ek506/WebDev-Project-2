<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Pairs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Nova Flat' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="mainStyle.css"> 
</head>
<body>
  <?php 
        include "navbar.inc.php"; 
    ?> 
  <div id="main">
    <h1 id="main-title">Pairs </h1>
    <?php if (isset($_SESSION['username'])) { ?>
      <p class="register">
        Welcome to Pairs<br>
        <a href="pairs.php"><button class="button">Click here to play</button></a>
      </p>
    <?php } else { ?>
      <p class="register">You're not using a registered session?<br>  
         <a href="registration.php">Register now</a>
      </p>
    <?php } ?> 
  </div>
</body>
</html>
