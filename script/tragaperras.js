//En primer lugar creamos el array con el que obtendremos las imágenes de la tragaperras.
var imgList = ["aubergine.png","banana.png","carrots.png","cherries.png","dollar.png","lemon.png","orange.png","peach.png","potato.png","tomato.png"];

//Creamos variables para obtener los números y randomizarlos correctamente y más tarde poder repartir los premios correctamente.
var actualNum1 = 0;
var actualNum2 = 0;
var actualNum3 = 0;
//

//Creamos la función que se utilizará para realizar la tirada y desde la que llamaremos al resto de funciones que necesitaremos para la máquina tragamonedas.
function pullJackpot() {
    var cash = parseInt(document.getElementById("totalMoney").innerHTML);
    if(cash < 1)  {
        alert('Por favor, inserta monedas para jugar.');
    } else {
        cash = cash -1;
        document.getElementById("totalMoney").innerHTML = cash;
        actualNum1 = randomNumber();
        changeimg1(actualNum1);
        actualNum2 = randomNumber();
        changeimg2(actualNum2);
        actualNum3 = randomNumber();
        changeimg3(actualNum3);

        rewards(actualNum1,actualNum2,actualNum3);
    }
}
//Creamos una función para darle valores aleatorios dentro de la longitud del array a las variables creadas anteriormente.
function randomNumber(actual) {
    do {
        var azar=Math.floor(Math.random()*imgList.length);
    } while (azar == actual) {
        return azar;
    }
}
//Creamos las funciones para dar dicho valor aleatorio a la máquina tragamonedas y cambiar así el dibujo que se muestra en cada uno de los slots.
function changeimg1(newImg) {
    for (var x = 0; x < document.getElementsByClassName("boxClass").length; x++) {
        document.getElementById("boximg1").src="img/imgtrag/"+imgList[newImg];
    }
}
function changeimg2(newImg) {
    for (var x = 0; x < document.getElementsByClassName("boxClass").length; x++) {
        document.getElementById("boximg2").src="img/imgtrag/"+imgList[newImg];
    }
}
function changeimg3(newImg) {
    for (var x = 0; x < document.getElementsByClassName("boxClass").length; x++) {
        document.getElementById("boximg3").src="img/imgtrag/"+imgList[newImg];
    }
}

//Creamos la función que se encargará de dar los premios si el usuario acierta alguna combinación.
function rewards(valor1, valor2, valor3) {
    //Si salen tres monedas, se desarrollará el siguiente código.
    if (valor1 == 4 && valor2 == 4 && valor3 == 4) {
        cash = parseInt(document.getElementById("totalMoney").innerHTML);
        cash = cash + 10;
        document.getElementById("totalMoney").innerHTML = cash;
        alert("¡Tres MONEDAS! Ganas 10 monedas.");

    }   //Si salen dos monedas, se desarrollará el siguiente código.
        else if (valor1 == 4 && valor2 == 4 || valor1 == 4 && valor3 == 4 || valor2 == 4 && valor3 == 4) {
            cash = parseInt(document.getElementById("totalMoney").innerHTML);
            cash = cash + 4;
            document.getElementById("totalMoney").innerHTML = cash;
            alert("¡Dos MONEDAS! Ganas 4 monedas");

        } //Si sale una moneda y dos frutas u hortalizas iguales, se desarrollará el siguiente código.   
        else if (valor1 == 4 && valor2 == valor3 || valor2 == 4 && valor1 == valor3 || valor3 == 4 && valor1 == valor2) {
            cash = parseInt(document.getElementById("totalMoney").innerHTML);
            cash = cash + 3;
            document.getElementById("totalMoney").innerHTML = cash;
            alert("¡Dos IGUALES y una MONEDA! Ganas 3 monedas.");
            
            } //Si sale una moneda y ninguna fruta u hortaliza iguales, se desarrollará el siguiente código.   
            else if (valor1 == 4 || valor2 == 4 || valor3 == 4) {
                    cash = parseInt(document.getElementById("totalMoney").innerHTML);
                    cash = cash + 1;
                    document.getElementById("totalMoney").innerHTML = cash;
                    alert("¡Una MONEDA! Ganas 1 moneda.");

                } //Si salen tres frutas u hortalizas iguales y no son monedas, se desarrollará el siguiente código.  
                else if (valor1 == valor2 && valor2 == valor3) {
                        cash = parseInt(document.getElementById("totalMoney").innerHTML);
                        cash = cash + 5;
                        document.getElementById("totalMoney").innerHTML = cash;
                        alert("¡Tres IGUALES! Ganas 5 monedas.");

                    } //Si salen dos frutas u hortalizas iguales y ninguna moneda, se desarrolla el siguiente código.
                     else if (valor1 == valor2 || valor1 == valor3 || valor2 == valor3) {
                            cash = parseInt(document.getElementById("totalMoney").innerHTML);
                            cash = cash + 2;
                            document.getElementById("totalMoney").innerHTML = cash;
                            alert("¡Dos IGUALES! Ganas 2 monedas.");
                            
                        } 

}