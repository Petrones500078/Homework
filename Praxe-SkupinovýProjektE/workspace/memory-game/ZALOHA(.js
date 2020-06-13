const cards = document.querySelectorAll('.memory-card');

let hasFlippedCard = false;
let firstCard, secondCard;
let lockBoard = false;

var clicks = 0;
var clickReducer = 0;
var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var end = document.getElementById("gameover");
var totalSeconds = 0;
var gameOver = 0;


/*

GAME ENGINE

*/

function flipCard(){
    if(lockBoard) return; 
    if(this === firstCard) return;

    this.classList.add('flip');

    if(!hasFlippedCard){
        //první kliknutí
        hasFlippedCard = true;
        firstCard = this;

    }else{
        //druhé kliknutí
        secondCard = this;

        checkForMatch();
    }
}


function unFlipCards() {
    lockBoard = true;
    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');

        resetBoard();
    },1500);
}


function checkForMatch() {
    //shodují se karty?
    let isMatch = firstCard.dataset.cardmatch === secondCard.dataset.cardmatch;
    isMatch ? disableCards() : unFlipCards();
}


function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);

    //proměná, která řeší počet otočených karet (řeší tak konec hry)
    gameOver += 1;
    console.log(gameOver);

    gameEnd();

    resetBoard();
}


(function shuffle(){
    cards.forEach( card => {
        let randomPosition = Math.floor(Math.random()*12);
        card.style.order = randomPosition;
    });
})();



/*

počet tahů a gameover

*/


function clickCount() {
    clicks += 1;
    
    Time();
    clickReducer += 1;
    if (clickReducer == 2) {
        clickReducer = 0;
    }
    if(clickReducer == 1){
        clicks--;     
    }

    document.getElementById("clicks").innerHTML = "Počet tahů: " + clicks;
};


function gameEnd(){
    if(gameOver == 6){
        end.innerHTML = "GAMEOVER";
        console.log("GAMEOVER");
        stopTime();
    }
}


/*

ČASOVAČ

*/

function Time() {
    if (clicks == 1 && totalSeconds == 0) {
        //začátek odpočítávání
        totalSeconds = 1;
        Timecount = setInterval(setTime, 1000);
    }
}


function setTime() {
  ++totalSeconds;
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}


function stopTime(){
    secondsLabel.innerHTML = pad(totalSeconds % 60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
    clearInterval(Timecount);
}

function resetTime(){
    totalSeconds = 0;
    stopTime();
}


function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}


/*

RESETY

*/


function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
}


function Reset(){
    resetTime();
    document.getElementById("clicks").innerHTML = "Počet tahů: " + 0;
    gameOver = 0;
    clicks = 0;
    end.innerHTML = "";

    cards.forEach( card => {
        setTimeout(() => {
            card.classList.remove('flip');
            card.addEventListener('click', flipCard);
            resetBoard();
        },100);
        setTimeout(() => {
            let randomPosition = Math.floor(Math.random()*12);
            card.style.order = randomPosition;
        },500);

    });
}


cards.forEach(card => card.addEventListener('click', flipCard));
