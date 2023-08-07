# Link to VM 
(to index.php)
http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:60199/index.php

### Nav bar (all pages)
- Shows 'register' if not logged in  
- Shows 'Leaderboard' and 'logout' if logged in   
- Shows avatar and username if logged in

### index.php
- Shows 'Welcome to Pairs' with play button if logged in  
- Shows link to register if not logged in  

### registration.php (complex)
- Assemble avatar by selecting features
- Error message if username contains invalid characters
- Error message if user submits without entering username

### pairs.php (complex)
- 5 levels with increasing number of cards
- Creates cards with random images and shuffles them to random positions for every level
- Each level has 'Incorrect guesses' count (different for each level) that shows 'You lose' screen when reached 
- 'Incorrect guesses' has been set to high numbers so that the game is easy to complete for marking purposes
- Timer and move count records time taken and moves used to complete game
- Once final level complete 'You Win' screen has 'sumbmit score' to add to leaderboard if logged in and 'register' if not logged in

## leaderboard.php
- Shows the top 10 best scores. Data stored in csv file
- Points calculated using moves and time

