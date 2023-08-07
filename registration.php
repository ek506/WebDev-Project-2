<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="mainStyle.css"> 

</head>
<body>
  <?php 
    include "navbar.inc.php";
  ?> 
  <div id="main">
    <h1 id="registration-title" class="move-down">Registration</h1>
    <table id="avatar-selection">
      <tr>
        <td class="table-form"><div>
            <form method="POST" action="processform.inc.php">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" pattern="[^!@#%&*()+^{}[\]\-—;:'`<>?/]+" >
              <p class="error-message hide"></p>
              <?php if (isset($_GET['error']) && $_GET['error'] == "emptyinput") { ?>
                <script>
                  errorMessage = document.querySelector('.error-message');
                  errorMessage.innerHTML = "Please enter a username";
                  errorMessage.classList.remove("hide");
                </script>
                <?php } ?>
              <script type="text/javascript">
                const usernameInput = document.getElementById('username');
                const errorMessage = document.querySelector('.error-message');
            
                // Add an event listener to the input field to check for invalid characters
                usernameInput.addEventListener('input', () => {

                  const invalidChars = new Set(["!", "@", "#", "%", "&", "*", "(", ")", "+", "=", "^", "{", "}", "[", "]", "-", ";", ":", "\"", "'", "<", ">", "?", "/"]);
                  const enteredText = usernameInput.value;
                  // Check if the entered text contains any invalid characters
                  for (let char of enteredText) {
                    if (invalidChars.has(char)) {
                      // Show an error message and highlight the input field in red
                      errorMessage.style.display = "block";
                      errorMessage.classList.remove("hide");
                      errorMessage.innerText = 'Username cannot contain "'+char+'"';
                      return;
                    }
                  }
                  // If no invalid characters are found, clear the error message and reset the input field style
                  errorMessage.innerText = '';
                  errorMessage.style.display = "none";
                  usernameInput.style.border = '';
                });
                </script>
              <br>
              <lable for="eyes">Eyes:</lable>
              <select id="eyes" name="eyes"class="dropdown">
                <option value="closed" selected>Closed</option>
                <option value="laughing">Laughing</option>
                <option value="long">Long</option>
                <option value="normal">Normal</option>
                <option value="rolling">Rolling</option>
                <option value="winking">Winking</option>
              </select>
              <br>
              <lable for="mouth">Mouth:</lable>
              <select id="mouth" name="mouth" class="dropdown">
                <option value="open" selected>Open</option>
                <option value="sad">Sad</option>
                <option value="smiling">Smiling</option>
                <option value="straight">Straight</option>
                <option value="surprise">Surprise</option>
                <option value="teeth">Teeth</option>
              </select>
              <br>
              <lable for="skin">Skin:</lable>
              <select id="skin" name="skin" class="dropdown">
                <option value="green" selected>Green</option>
                <option value="red">Red</option>
                <option value="yellow">Yellow</option>
              </select>
              <br>
              <button type="submit" name="submit" class="button register-button">Register</button>
            </form>
          </div></td>
        <td>
          <div> 
            <img id="eyes-img" src="./emoji assets/eyes/closed.png" style="z-index: 3;">
            <img id="mouth-img" src="./emoji assets/mouth/open.png" style="z-index: 3;">
            <img id="skin-img" src="./emoji assets/skin/green.png" style="z-index: 1;">
          </div>
        </td></tr>
    </table>


    <script>
      // Get references to the dropdowns and images
      const eyesDropdown = document.getElementById("eyes");
      const mouthDropdown = document.getElementById("mouth");
      const skinDropdown = document.getElementById("skin");
      const eyesImg = document.getElementById("eyes-img");
      const mouthImg = document.getElementById("mouth-img");
      const skinImg = document.getElementById("skin-img");

      // Update the image sources when a dropdown value is changed
      eyesDropdown.addEventListener("change", function() {
        eyesImg.src = `./emoji assets/eyes/${eyesDropdown.value}.png`;
      });

      mouthDropdown.addEventListener("change", function() {
        mouthImg.src = `./emoji assets/mouth/${mouthDropdown.value}.png`;
      });

      skinDropdown.addEventListener("change", function() {
        skinImg.src = `./emoji assets/skin/${skinDropdown.value}.png`;
      });
    </script>

  </div>
</body>
</html>
