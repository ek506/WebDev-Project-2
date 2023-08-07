<?php
 session_start();
 $_SESSION['score-submitted'] = false;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pairs Game</title>
  <link rel="stylesheet" type="text/css" href="mainStyle.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- CSS and JavaScript links go here -->
</head>
<body>
  <?php 
      include "navbar.inc.php"; 
  ?> 
  <div id="main">
  <h1 id="game-title" class="title">Pairs Game</h1>
    <div class="game-wrapper hide">
      <div class="stats-container">
          <div id="incorrect-guesses"><span>Incorrect Guesses Left:</span> 0</div>
          <div id="move-count"><span>Moves:</span> 0</div>
          <div id="time-taken"><span>Time:</span> 0</div>
      </div>
      <div id="gameboard"></div>
      <div class="stop-btn-container">
        <button id="stop-btn" class="button stop">Stop game</button>
      </div>
      <div id="win-screen" class="screen hide">
        <h1>You win</h1><br>
        <p id="results">Moves: 0<br>
        Time: 0<br>
        Score: 0                            
        </p> <br>
        <button id="playagain-btn" class="button win-button" >Play again!</button>
        <?php if (isset($_SESSION['username'])) { ?>
          <form method="post" action="leaderboard.php" class="win-button" >
          <input type="hidden" name="score" value="">
          <input type="hidden" name="time" value="">
          <input type="submit" name="submit" value="Submit" id="submit-btn" class="button" style="width:100%">
        </form>
        <?php } else { ?>
            <a href="registration.php"><button class="button win-button">Register now</button></a>
        <?php } ?>   
      </div>
      <div id="next-level-screen" class="screen hide"> 
        <h1>Well Done!</h1><br><br>
        <p>Level</p>
        <button id="nextlvl-btn" class="button win-button" >Next level</button>
      </div>
      <div id="lose-screen" class="screen hide">
        <h1>You Lose!</h1><br><br>
        <p>You ran out of guesses</p>
        <button id="try-again-btn" class="button win-button" >Try Again</button>
      </div>
    </div>
    <div class="start-btn-container">
      <button id="start-btn" class="button start">Start the game</button>
    </div>
  </div>
  <script src="gameLogic.js"></script>
</body>
</html>
