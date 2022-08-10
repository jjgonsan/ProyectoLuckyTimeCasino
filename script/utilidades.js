//Añadimos las funcionalidades que queremos que posea nuestra página web en este js. 
//La función confirmMoney nos sirve para añadir monedas al monedero para empezar a jugar.
function confirmMoney(coins) {
    var coins = 0;
    var coins = document.getElementById("money").value;

    if (coins < 1) {
        alert ("Por favor, introduce un número positivo de monedas.");
    } else {
        alert ("Se han añadido " + coins + " moneda/s al monedero.");
        document.getElementById("totalMoney").innerHTML = coins;
        document.getElementById("addMoney").disabled=true;
        document.getElementById("resetMoney").style.display="flex";
        document.getElementById("warn").style.display="none";
    }
}
//La función resetMoney nos sirve para retirar las monedas del monedero y acabar nuestra partida.
function resetMoney(resetCoins) {
   var resetCoins = 0;
   var resetCoins = document.getElementById("totalMoney").innerHTML;
   document.getElementById("money").value = resetCoins;
   alert("Has terminado la sesión de juego con un total de " + resetCoins + " moneda/s.");
   document.getElementById("totalMoney").innerHTML = "0";
   document.getElementById("addMoney").disabled = false;
   document.getElementById("warn").style.display = "flex";
   document.getElementById("resetMoney").style.display = "none";
}
//Con esta función podremos hacer que el usuario vaya a la máquina tragamonedas.
function moveToJackpot() {
    window.location.href="tragaPerIndex.php";
}
//Con esta función podremos hacer que el usuario vaya a la ruleta.
function moveToRoulette() {
    window.location.href="ruletIndex.php";
}
//Con esta función podremos hacer que el usuario vuelva a la página principal de nuestra web.
function moveToMain() {
    window.location.href="main.php";
}
//Con esta función moveremos el usuario a los datos de usuario.
function moveToData() {
    window.location.href="userData.php";
}
//Con esta función moveremos al usuario a la página de sus juegos favoritos.
function moveToFav() {
    window.location.href="favGames.php";
}
//Con esta función moveremos al usuario a la página "About us" de Lucky Time Casino.
function moveToAbout() {
    window.location.href="about.php";
}
//Creamos una función para acceder a logout.php y realizar el cierre de sesión del usuario.
function endSession() {
    window.location.href="logout.php"
}