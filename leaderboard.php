<!DOCTYPE html>
<?php
 session_start();
  $filename = './leaderboard.csv';
  //Read data currently on leaderboard
  $leaderboard = array();
  if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $leaderboard[] = $data; 
    }
    fclose($handle);
  }

  //Add new data to leaderboard if needed
  if (isset($_POST["submit"])) {
    $score = $_POST["score"];
    $time = $_POST['time'];
    if (isset($_SESSION["username"]) && $_SESSION['score-submitted']===false){
      $username = $_SESSION["username"];
      $newscore = array($username, $score, $time);
      $leaderboard[]=$newscore; //add to leaderboard
      $_SESSION['score-submitted'] = true;
      //Sort leaderboard by score
      usort($leaderboard, function($a, $b) {
        return $b[1] - $a[1];
      });
      $leaderboard = array_slice($leaderboard, 0, 10); //Leaderboard is 10 items long
      //Overwrite leaderboard with new data
      $handle = fopen($filename, 'w');
      foreach ($leaderboard as $row) {
        fputcsv($handle, $row);
      }
      fclose($handle);
    }
  } 

  

?>
<html>
<head>
  <title>Leaderboard</title>
  <link rel="stylesheet" type="text/css" href="mainStyle.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php 
      include "navbar.inc.php"; 
  ?> 
  <div id="main">
    <h1 class="move-down">Leaderboard</h1>
    <div id="leaderboard">
    <table>
      <thead>
        <tr>
          <th>Rank</th>
          <th>Username</th>
          <th>Points</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $counter = 1; 
        foreach ($leaderboard as $row): ?>
          <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</body>
</html>
