const moves = document.getElementById("move-count");
const time = document.getElementById("time-taken");
const incorrectGuesses = document.getElementById("incorrect-guesses");
const startButton = document.getElementById("start-btn");
const stopButton = document.getElementById("stop-btn");
const playagainButton = document.getElementById("playagain-btn");
const tryagainButton = document.getElementById("try-again-btn");
const winscreen = document.getElementById("win-screen");
const loseScreen = document.getElementById("lose-screen");
const nextLevelScreen = document.getElementById("next-level-screen");
const gameboard = document.getElementById("gameboard");
const results = document.getElementById("results");
const gamewrapper = document.querySelector(".game-wrapper");

const title = document.querySelector("#main h1");

let firstCard = false, secondCard = false;
let movesCount = 0, matchedCount = 0;
let seconds = 0;
let numCards;
let timer;
let guessesLeft;
let cardValues;
let score;
let level;
let cardsPerLevel = {
    1: 4,
    2: 8,
    3: 12,
    4: 16,
    5: 20
  };
  let guessesPerLevel = {
    1: 3,
    2: 8,
    3: 13,
    4: 18,
    5: 25
  };

  

const eyes = [
    { name: "closed", image: "./emoji assets/eyes/closed.png" },
    { name: "laughing", image: "./emoji assets/eyes/laughing.png" },
    { name: "long", image: "./emoji assets/eyes/long.png" },
    { name: "normal", image: "./emoji assets/eyes/normal.png" },
    { name: "rolling", image: "./emoji assets/eyes/rolling.png" },
    { name: "winking", image: "./emoji assets/eyes/winking.png" }
  ];
const mouth = [
    { name: "open", image: "./emoji assets/mouth/open.png" },
    { name: "sad", image: "./emoji assets/mouth/sad.png" },
    { name: "smiling", image: "./emoji assets/mouth/smiling.png" },
    { name: "straight", image: "./emoji assets/mouth/straight.png" },
    { name: "suprise", image: "./emoji assets/mouth/surprise.png" },
    { name: "teeth", image: "./emoji assets/mouth/teeth.png" }
]
const skin = [
    { name: "green", image: "./emoji assets/skin/green.png" },
    { name: "red", image: "./emoji assets/skin/red.png" },
    { name: "yellow", image: "./emoji assets/skin/yellow.png" }
]

const initialstats=()=>{
    level = 1;
    seconds = 0;
    timer = setInterval(addTime, 1000);
    movesCount = 0;
    moves.innerHTML = `<span>Moves:</span> 0`;
    time.innerHTML = `<span>Time: </span> 00`;
}

const addMove=()=>{
    movesCount+=1;
    moves.innerHTML = `<span>Moves:</span> ${movesCount}`;
}

const addTime=()=> {
    seconds += 1;
    let secondsValue = seconds < 10 ? `0${seconds}` : seconds;
    time.innerHTML = `<span>Time: </span>${secondsValue}`;
  }
const loseGuess=()=>{
    guessesLeft-=1;
    incorrectGuesses.innerHTML = `<span>Incorrect Guesses Left: </span> ${guessesLeft}`;
}
const setUpGuesses=(guesses)=>{
    guessesLeft=guesses;
    incorrectGuesses.innerHTML = `<span>Incorrect Guesses Left: </span> ${guessesLeft}`;
}
//Selects eyes, mouth and skin to create 'size' number of cards
const generateCardCombos = (size) => {
    let cardValues = [];
    let cardCodes = []
    while (cardValues.length<size){
        let indexEyes = Math.floor(Math.random() * eyes.length);
        let indexMouth = Math.floor(Math.random() * mouth.length);
        let indexSkin = Math.floor(Math.random() * skin.length);
        let combo = [eyes[indexEyes], mouth[indexMouth], skin[indexSkin]];
        let code = `${indexEyes}${indexMouth}${indexSkin}`;
        if (cardCodes.indexOf(code) === -1) { //If combo doesn't exist, add it
            cardValues.push(combo);
            cardCodes.push(code);
        } 
    }
    return cardValues; //Array containing image cominations
  };

const createCards= (cardValues) => {
    gameboard.innerHTML = "";
    cardValues = [...cardValues, ...cardValues]; //Doubles each card
    cardValues.sort(() => Math.random() - 0.5);   //simple shuffle
    let size=cardValues.length;
    for (let i = 0; i < cardValues.length; i++) {
      /*
          Create Cards
          before => front side (contains question mark)
          after => back side (contains actual image);
          data-card-values is a custom attribute which stores the names of the cards to match later
        */
      let value = cardValues[i][0].name +"-"+cardValues[i][1].name+"-"+cardValues[i][2].name;
      gameboard.innerHTML += `
       <div class="card-container" data-card-value="${value}">
          <div class="card-before">?</div>
          <div class="card-after">
          <img src="${cardValues[i][0].image}" class="image" style="z-index: 3;" />
          <img src="${cardValues[i][1].image}" class="image" style="z-index: 3;"/>
          <img src="${cardValues[i][2].image}" class="image" style="z-index: 1;"/></div>
       </div>
       `;
    }
    //number of cards per column
    let cols = 2;
    if (size>4){
        cols = 4;
    }
    gameboard.style.gridTemplateColumns = `repeat(${cols},auto)`;  //Grid
  }

const playGame= (numCards) => { //numcards is total cards (doubled)
    cards = document.querySelectorAll(".card-container");
    cards.forEach((card) => { //Add function to every card
        card.addEventListener("click", () => {
            if (!card.classList.contains("matched")&& !card.classList.contains("selected")){
                card.classList.add("selected");
                card.classList.add("flipped");
                if (!firstCard){ //if card is first card
                    firstCard = card;
                    firstCardValue = card.getAttribute("data-card-value");
                } else { //card is second card
                    addMove();
                    let tempFirst = firstCard;
                    let tempSecond = card;
                    secondCardValue = card.getAttribute("data-card-value");
                    if (firstCardValue===secondCardValue){ //matched
                        tempFirst.classList.add("matched");
                        tempSecond.classList.add("matched");

                        matchedCount += 1;
                        if (matchedCount===numCards/2){
                            let delay = setTimeout(() => { //Adds delay before flipping back
                                winGame(numCards);
                              }, 1000);
                            
                        }
                    } else { //not matched
                        let delay = setTimeout(() => { //Adds delay before flipping back
                            tempFirst.classList.remove("flipped");
                            tempSecond.classList.remove("flipped");
                            loseGuess();
                            if (guessesLeft===0){
                                loseGame();
                            }
                          }, 900);
                    }        
                    firstCard = false;
                    secondCard = false;      
                    tempFirst.classList.remove("selected");
                    tempSecond.classList.remove("selected");      
                }
            } 
        });
    });
}

const setUpGame = (numCards) => {
  matchedCount = 0;
  setUpGuesses(guessesPerLevel[level]);
  cardValues = generateCardCombos(numCards/2);
  createCards(cardValues);
  playGame(numCards);
}

const winGame= () => {
    clearInterval(timer);
    if (level === 5){
        score = 1000 - (movesCount * 5) - (seconds * 3);
        score = (score < 0) ? 0 : score;
        gameboard.innerHTML="";
        const elements = gamewrapper.children;
        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.add("hide");
        }
        results.innerHTML=`<p>Moves: ${movesCount}<br>
                            Time: ${seconds}<br>
                            Score: ${score}                            
                            </p>`;
        winscreen.classList.remove("hide");
        //Update values in form for post request 
        const formScore = document.querySelector('input[name="score"]');
        const formTime = document.querySelector('input[name="time"]');
        formScore.value=`${score}`;
        formTime.value=`${seconds}`;
    } else {
        gameboard.innerHTML="";
        const elements = gamewrapper.children;
        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.add("hide");
        }
        let levelComplete = document.querySelector("#next-level-screen p");
        levelComplete.innerHTML=`Level ${level} Complete`;
        nextLevelScreen.classList.remove("hide");
    }

}
const loseGame = () => {
    clearInterval(timer);
    gameboard.innerHTML="";
    const elements = gamewrapper.children;
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.add("hide");
    }
    loseScreen.classList.remove("hide");
}

startButton.addEventListener('click', function() {
  startButton.classList.add("hide");
  title.classList.add("hide");
  gamewrapper.classList.remove("hide");
  numCards = cardsPerLevel[1];
  initialstats();
  setUpGame(numCards);
});

nextLevelScreen.addEventListener('click', function(){
    let elements = gamewrapper.children;
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.remove("hide");
    }
    let screens = document.querySelectorAll('.screen');
    for (let i = 0; i < screens.length; i++) {
        screens[i].classList.add("hide");
    }
    level+=1;
    timer = setInterval(addTime, 1000);
    numCards = cardsPerLevel[level];
    setUpGame(numCards);
})

playagainButton.addEventListener('click', function() {
    let elements = gamewrapper.children;
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.remove("hide");
    }
    let screens = document.querySelectorAll('.screen');
    for (let i = 0; i < screens.length; i++) {
        screens[i].classList.add("hide");
    }
    numCards = cardsPerLevel[1];
    clearInterval(timer);
    initialstats();
    setUpGame(numCards);
});

tryagainButton.addEventListener('click', function() {
    let elements = gamewrapper.children;
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.remove("hide");
    }
    let screens = document.querySelectorAll('.screen');
    for (let i = 0; i < screens.length; i++) {
        screens[i].classList.add("hide");
    }
    numCards = cardsPerLevel[1];
    clearInterval(timer);
    initialstats();
    setUpGame(numCards);
});

stopButton.addEventListener("click", (stopGame = () => {
      startButton.classList.remove("hide");
      title.classList.remove("hide");
      gamewrapper.classList.add("hide");
      clearInterval(timer);
    })
  );

