////////////////////////////APUESTAS CON NÚMEROS EN LA RULETA /////////////////////////////////////////////////////

//En primer lugar creamos un botón para añadir la apuesta del usuario con la que va a jugar.
function addBet() {
  var num = 0;
  var num = document.getElementById("putBet").value;
  var color = document.getElementById("selectColor").value;
  if (num < 0 || num > 32) {
    alert("Por favor, apuesta por un número entre el 0 y el 32.");
  } else {
    document.getElementById("colorSelected").innerHTML = color;
    document.getElementById("bet").innerHTML = num;
    document.getElementById("roulettePlay").style.display="flex";
    document.getElementById("rouletteBtn").style.display="none";
    document.getElementById("selectColor").style.display="none";
  }
}


//Creamos la función a la que llamará el usuario cuando pulse el botón de apostar en la ruleta.
function spinRoulette() {
  var cash = parseInt(document.getElementById("totalMoney").innerHTML);
  var numberBet = parseInt(document.getElementById("putBet").value);
  if(cash < 1)  {
      alert('Por favor, inserta monedas para jugar.');
  } else {
        cash = cash -1;
      document.getElementById("totalMoney").innerHTML = cash;
      random();
      document.getElementById("roulettePlay").style.display="none";
      document.getElementById("rouletteBtn").style.display="flex";
      }
}

//Creamos una función para obtener un número al azar entre los que utilizaremos para nuestra ruleta.
function random() {
  var ran = Math.floor(Math.random() * 33);
  
//Comprobamos el resultado del número aleatorio que hemos conseguido y damos el resultado.
  if (ran % 2 == 0) {
    document.getElementById("rewards").style.color="red";
    document.getElementById("rewards").innerHTML = ran + ", Rojo.";
  } else {
    document.getElementById("rewards").style.color="black";
    document.getElementById("rewards").innerHTML = ran + ", Negro.";
  } 
  if (ran == 0) {
    document.getElementById("rewards").style.color="white";
    document.getElementById("rewards").innerHTML = "Ha tocado el número " + ran;
  }
  betRewards(ran);
}
//Hacemos una función para crear los posibles premios de la ruleta comparando tanto el color elegido en la apuesta como los números.
function betRewards(ran) {
  var num = parseInt(document.getElementById("bet").innerHTML);
  var compareColor = document.getElementById("colorSelected").innerHTML;
  if (ran % 2 == 0 && compareColor == "Rojo") {
    alert("¡Has acertado la apuesta al color Rojo! Obtienes 2 monedas.")
    var cash = cash = parseInt(document.getElementById("totalMoney").innerHTML);
      cash = cash + 2;
      document.getElementById("totalMoney").innerHTML = cash;
      document.getElementById("roulettePlay").style.display="flex";
      document.getElementById("rouletteBtn").style.display="none";
      document.getElementById("selectColor").style.display="flex";
      document.getElementById("bet").innerHTML = "";
  }else if (ran % 2 != 0 && compareColor == "Negro"){
    alert("¡Has acertado la apuesta al color Negro! Obtienes 2 monedas.")
    var cash = cash = parseInt(document.getElementById("totalMoney").innerHTML);
      cash = cash + 2;
      document.getElementById("totalMoney").innerHTML = cash;
      document.getElementById("roulettePlay").style.display="flex";
      document.getElementById("rouletteBtn").style.display="none";
      document.getElementById("selectColor").style.display="flex";
      document.getElementById("bet").innerHTML = "";
  }
        if (num == ran && ran == 0) {
        alert("¡Has ganado la apuesta al número 0! Recibes 20 monedas.")
        var cash = cash = parseInt(document.getElementById("totalMoney").innerHTML);
        cash = cash + 30;
        document.getElementById("totalMoney").innerHTML = cash;
        document.getElementById("roulettePlay").style.display="flex";
        document.getElementById("rouletteBtn").style.display="none";
        document.getElementById("selectColor").style.display="flex";
        document.getElementById("bet").innerHTML = "";
        }
       else if (num == ran) {
        alert("¡Has ganado la apuesta al número! Recibes 10 monedas.")
        var cash = cash = parseInt(document.getElementById("totalMoney").innerHTML);
        cash = cash + 10;
        document.getElementById("totalMoney").innerHTML = cash;
        document.getElementById("roulettePlay").style.display="flex";
        document.getElementById("rouletteBtn").style.display="none";
        document.getElementById("selectColor").style.display="flex";
        document.getElementById("bet").innerHTML = "";
        } else {
            document.getElementById("roulettePlay").style.display="flex";
            document.getElementById("rouletteBtn").style.display="none";
            document.getElementById("selectColor").style.display="flex";
            document.getElementById("bet").innerHTML = "";
          }
}