<!--incluimos los documentos en php necesarios para mantener la sesión del usuario iniciada-->
<?php
include "database.php";
include "auth.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilo.css"> <!--Añadimos el archivo CSS al html para darle estilo a nuestra página web.-->
        <script type="text/javascript" src="script/utilidades.js"></script> <!--Añadimos el archivo Javascript con el que vamos a trabajar las utilidades en esta página.-->
        <script type="text/javascript" src="script/ruleta.js"></script><!--Añadimos el archivo Javascript con el que vamos a hacer funcionar la ruleta.-->
        <!--Agregamos el color estándar de los tapetes de mesa de ruleta para dar mejor estilo a nuestra web.-->
        <style>
            body {background-color:#006400;}
        </style>
        <title>Lucky Time Casino</title>
    </head>
    <body>
        <div class="container">
            <header class="header"> 
                <div class="menuNav">
                    <img onclick="moveToMain()" src="img/LuckytimeInvert.jpg">
                    <!--Añadimos un botón para viajar a Main por si el usuario desconoce que puede acceder a Main clicando el logo de Lucky Time Casino-->
                    <a onclick="moveToMain()">Home</a>
                    <!--Agregamos un link a los datos de usuario que podrá utilizar para ver sus credenciales y la información de su cuenta.-->
                    <!--Se realiza a base de funciones para mantener el color y el estilo de los hipervínculos en la web.-->
                    <a onclick="moveToData()">Mi Perfil</a>
                    <!--Colocamos un link hacia los juegos favoritos del usuario.-->
                    <a onclick="moveToFav()">Juegos favoritos</a>
                    <!--Incluimos una sección About us para explicar qué es Lucky Time Casino al usuario -->
                    <a onclick="moveToAbout()">Sobre LuckyTime</a>
                    <!--Añadimos una opción para finalizar la sesión del usuario en nuestro header.-->
                    <a onclick="endSession()">Cerrar sesión</a>
                </div>
                <div class="audiocontainer">
                    <!--Permitimos la repetición automática y los controles para que el usuario pueda activar o desactivar la música -->
                    <!--Por defecto está desactivada la reproducción automática ya que el audio no se puede controlar previamente a la reproducción automática y puede sonar muy fuerte.-->
                    <audio loop controls> 
                        <source src="sound/casino.mp3" type="audio/mp3">
                    </audio>
                </div>
            </header>
            <h3 class="font">Bienvenido, <?php echo $_SESSION['sesion'] ?> a la Ruleta de LuckyTime.</h1> 
            <div class="monedero"> <!--Creamos un div para situar al monedero bajo el nombre de usuario para que sea más cómodo añadir dinero al monedero para empezar a jugar.-->
                <h5 class="font"> Saldo en el monedero =</h5>
                <h5 class="font" id="totalMoney">0</h5>
                <button class="botonformu" type="reset" id="resetMoney" onclick="resetMoney(totalMoney)">Reiniciar Monedero</button>
                <h5 class="font, formu" id="warn"> Añade saldo para comenzar a jugar. </h5>
                <input type="number" id="money" value="0">
                <button type="submit" id="addMoney" onclick="confirmMoney(money)">Añadir saldo</button>
            </div>
            <!--Creamos el div donde irá organizada nuestra ruleta con sus respectivas etiquetas.-->
            <div id="roulette">
                <!--En este párrafo el usuario verá el número por el que apuesta.-->
                <p id="placedBet">Has apostado por el número: <p id="bet"></p> y por el color: <p id="colorSelected"></p></p>
                <br>
                <!--En este párrafo se mostrará el resultado de la tirada-->
                <h2 id="rewards"></h2>
                <br>
                <!--Creamos el input y el selector para poder realizar la apuesta al número y si también lo prefiere a algún color de la ruleta.-->
                <input type="number" id="putBet" size="2" value="0">
                <select id="selectColor">
                    <option> Ningún Color </option>
                    <option id="red"> Rojo </option>
                    <option id="black"> Negro </option>
                </select>   
                <!--Creamos un botón para añadir la apuesta, el cual desaparecerá una vez se haga. -->
                <input type="submit" id="rouletteBtn" value="Elegir número" onclick="addBet()"> 
                <br>
                <!--Creamos un botón para jugar, que aparecerá una vez se haga la apuesta. Desaparecerá cuando se juegue una vez para hacer reaparecer el botón de añadir apuesta.-->
                <input type="submit" id="roulettePlay" value="Apostar" onclick="spinRoulette()">
            </div>
        </div>
        <!--Creamos el formulario para añadir el juego a favoritos.-->
        <form method="POST" action="ruletIndex.php">
            <input type="text" name="favorito" value="2" hidden>
            <input type="submit" id="favBtn" name="fav" value="Agregar juego a favoritos">
        </form>
        <div class="footer"> <!--Añadimos el footer al HTML-->
            <div>
                <img src="img/LuckytimeInvert.jpg" class="logo">
            </div>
            <div class="signature">
                Código realizado por Julio José González Sánchez - Proyecto LuckyTime, 2022.
            </div>
        </div>
    </body>
</html>
<?php
if($_POST['fav'] == true) {
    $favorito = $_POST['favorito']; 
    $usrname = $_SESSION['sesion'];
    //Filtramos los datos del usuario mediante una consulta para obtenerlos.
    $query = "SELECT * FROM usuario WHERE user = '$usrname'";
    //Conectamos a la base de datos y guardamos el valor de vuelta 
    $result = mysqli_query($conn, $query);
    if(!$result){ // En caso de que falle la consulta, devolveremos un error.
        echo mysqli_error($mysqli);
        exit; // Mediante un exit saldremos de la consulta errónea.
    }
    while($row = mysqli_fetch_array($result)){
        $id=$row['idusuario'];
        //Ahora que tenemos la id del juego almacenada en una variable, debemos de comprobar que el usuario no la tenga añadida a favoritos.
        //Hacemos una consulta para saber si el usuario tiene ya agregado dicho juego a favoritos.
        $query2 = "SELECT id_user FROM favoritos WHERE id_user='$id' AND id_juego='$favorito'";
        $result2 = mysqli_query($conn, $query2);
        if(!$result2) {
            echo mysqli_error($mysqli);
            exit;
        }
        //Guardamos en la variable sql3 si existe algún resultado al buscar la id del juego.
        $query3 = "SELECT id_juego FROM favoritos WHERE id_user='$id' AND id_juego='$favorito'";
        $result3 = mysqli_query($conn, $query3);

        if(!$result3) {
            echo mysqli_error($mysqli);
            exit; // Mediante un exit saldremos de la consulta errónea.
        }
        //Comparamos los resultados para saber si el juego ya había sido agregado a favoritos por el usuario.
        if($result2 === $id && $result3 === $favorito) {
            echo '<script type="text/javascript"> 
                alert("Ya tienes este juego añadido a favoritos");
                </script>';
        //en el caso de que no tuviera agregado el juego a favoritos, introduciremos un nuevo registro en la tabla favoritos para que quede registrado.
        }else{ 
            $query4 = "INSERT INTO favoritos (id_user, id_juego) VALUES ( '$id', '$favorito')";
            $savedata = mysqli_query($conn, $query4);
            if($savedata){
                echo '<script type="text/javascript">
                    alert("Juego añadido a favoritos correctamente");
                    </script>';
            }else {
                echo '<script type="text/javascript">
                alert("El juego ya está entre tus juegos favoritos.");
                </script>';
            }

        }
    }

}

?>