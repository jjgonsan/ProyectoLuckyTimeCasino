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
        <script type="text/javascript" src="script/tragaperras.js"></script>
        <!--Para no estropear la dinámica de toda la web, incluimos una configuración especial para el body de nuestra máquina tragamonedas en una etiqueta <style>.-->
        <style>
            body {background-color:#006400;
            }
        </style>
        <title>Lucky Time Casino</title>
    </head>
    <body>
        <div class="container">
            <header class="header"> 
                <!--Creamos un div para organizar el menú que se encontrará en nuestro header.-->
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
            <h3 class="font">Bienvenido, <?php echo $_SESSION['sesion'] ?> a la máquina tragamonedas de LuckyTime.</h1> 
            <!--Creamos un div para situar al monedero bajo el nombre de usuario para que sea más cómodo añadir dinero para empezar a jugar.-->
            <div class="monedero">
                <h5 class="font"> Saldo en el monedero =</h5>
                <h5 class="font" id="totalMoney">0</h5>
                <button class="botonformu" type="reset" id="resetMoney" onclick="resetMoney(totalMoney)">Reiniciar Monedero</button>
                <h5 class="font, formu" id="warn"> Añade saldo para comenzar a jugar. </h5>
                <input type="number" id="money" value="0">
                <button type="submit" id="addMoney" onclick="confirmMoney(money)">Añadir saldo</button>
            </div>
            <!--Creamos un div que utilizaremos para englobar la máquina tragamonedas.-->
            <div id="jackpot">
                <!--Creamos tres contenedores, uno para cada imagen de la tragaperras. Utilizaremos las ids de las imagenes para cambiarlas, y las clases para darles estilo.-->
                <div class="boxClass">
                    <img id="boximg1" class="boxImg" src="img/imgtrag/pingu.png"> 
                </div>
                <div class="boxClass">
                    <img id="boximg2" class="boxImg" src="img/imgtrag/pingu.png">
                </div>
                <div class="boxClass">
                    <img id="boximg3" class="boxImg" src="img/imgtrag/pingu.png">
                </div>
                <!--Por último añadimos el botón que hará que el usuario haga realice una tirada en nuestra tragaperras.-->
                <button id="jackpotBut" onclick="pullJackpot(totalMoney)"> Jugar </button>
            </div>
            <!--Por último añadimos el formulario para añadir al juego a favoritos.-->
            <form method="POST" action="tragaPerIndex.php">
                <!--Este input no se verá y contiene la id del juego, lo utilizaremos cuando se use el botón de favoritos para obtener su valor.-->
                <input type="text" name="favorito" value="1" hidden>
                <!--Al pulsar este input lanzará el código php que se encuentra abajo del código html.-->
                <input type="submit" id="favBtn" name="fav" value="Agregar juego a favoritos">
            </form>
        </div>
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
//Comprobamos que el botón ha sido activado y almacenamos los datos de la sesión y el input invisible que contiene la id del juego en variables.
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
        //Guardamos en la variable query3 si existe algún resultado al buscar la id del juego.
        $query3 = "SELECT id_juego FROM favoritos WHERE id_user='$id' AND id_juego='$favorito'";
        $result3 = mysqli_query($conn, $query3);
        //De nuevo comprobamos que la query no de ningún error.
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