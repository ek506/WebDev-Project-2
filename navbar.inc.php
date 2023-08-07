
<style>
  nav div li {
    margin: 0 20px;
  }

  nav {
    font-family: Verdana, sans-serif;
    font-size: 12px;
    font-weight: bold;
    background-color: blue;
    height: 50px;
    z-index: 100;
  }
  #nav-username{
    color: white; 
  }
  .no-gap{
    margin: 0;
  }
  .gap{
    margin-left:50px;
  }

</style>


<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" name="home">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
          <?php if (isset($_SESSION['eyes'])&&isset($_SESSION['mouth'])&&isset($_SESSION['skin'])) { ?>
            <li class="nav-item no-gap">
              <a class="nav-link" id="nav-username"><?php echo "User:  ".$_SESSION['username']?></a>
            </li>
            <li class="nav-item no-gap">
              <div class="nav-avatar" style="position: relative;">
                <img src="<?php echo "./emoji assets/eyes/".$_SESSION['eyes'].".png"?>" style=" position: absolute; z-index: 3; top: 0; left: 0; width:30px; height: auto;">
                <img src="<?php echo "./emoji assets/mouth/".$_SESSION['mouth'].".png"?>" style="position: absolute; z-index: 3; top: 0; left: 0; width:30px; height: auto;">
                <img src="<?php echo "./emoji assets/skin/".$_SESSION['skin'].".png"?>" style="position: absolute; z-index: 1; top: 0; left: 0; width:30px; height: auto;">
              </div>
            </li>
          <?php } ?>

        <li class="nav-item gap">
          <a class="nav-link" href="pairs.php" name="memory">Play Pairs</a>
        </li>
        <!-- Shows either leaderboard or register -->
        <?php if (isset($_SESSION['username'])) { ?>
          <li class="nav-item">
          <a class="nav-link" href="leaderboard.php" name="leaderboard">Leaderboard</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="logout.inc.php" name="leaderboard">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
          <a class="nav-link" href="registration.php" name="register">Register</a>
          </li>
        <?php } ?> 

        
      </ul>
    </div>
  </div>
</nav>


