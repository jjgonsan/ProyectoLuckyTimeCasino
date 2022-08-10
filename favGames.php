<!--incluimos los documentos en php necesarios para mantener la sesión del usuario iniciada-->
<?php
include "database.php";
include "auth.php";
session_start();
?>
<!--Establecemos una estructura html básica con la que trabajaremos.-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css"> <!--Añadimos el archivo CSS al html para darle estilo a nuestra página web.-->
    <script type="text/javascript" src="script/utilidades.js"></script> <!--Añadimos el archivo Javascript con el que vamos a trabajar las utilidades en esta página.-->
    <title>Lucky Time Casino</title>
</head>
<body>
    <!--Dentro del body creamos un div container para mantener una estructura elegante con nuestro header y footer. De esta forma, La página no se "deformará" a la hora de añadir nuevas etiquetas.-->
    <div class="container">
        <!--Creamos un header específico dentro de nuestro div container que podremos reutilizar en el resto de páginas de nuestra aplicación web.-->
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
        <!--Damos la bienvenida a nuestro usuario recién conectado.-->
        <h3 class="font"><?php echo $_SESSION['sesion'] ?> Estos son tus juegos favoritos:</h1>
        <table id="tablestyle">
            <tr>
                <th class="idTable">Nombre</th>
                <th class="idTable">Proveedor</th>
            </tr>
            <?php
            //Guardamos el nombre de usuario para mostrar sus juegos favoritos.
                $usrname=$_SESSION['sesion'];
            
            //Guardamos en una variable la consulta donde vamos a recoger los datos del usuario que filtraremos por su nombre de usuario.
            $query = "SELECT * FROM usuario WHERE user='$usrname'";
            $result=mysqli_query($conn, $query);
            if(!$result) {
                echo mysqli_error($mysqli);
                exit;
            }
            //Recorremos los datos que hemos obtenido del usuario mediante un while.
            while($row = mysqli_fetch_array($result)) {
                //Guardamos la id del usuario que es la que utilizaremos para obtener los datos de sus juegos favoritos.
                $id =$row['idusuario']; 
                $query2 = "SELECT * FROM favoritos WHERE id_user='$id'"; //Creamos otra consulta filtrando la tabla de favoritos por el id del usuario.
                $result2 = mysqli_query($conn, $query2);
                //abrimos otro while para recorrer los datos de la tabla favoritos y obtener así la id de los juegos almacenados en favoritos por el usuario.
                while($row2 = mysqli_fetch_array($result2)) {
                    //Almacenamos las id de los juegos en una variable.
                    $gameId = $row2['id_juego'];
                    //Creamos otra query que obtendrá los datos de la tabla juegos para mostrar en la lista de juegos favoritos del usuario aquellos que este haya elegido como favoritos accediendo a ellos.
                    $query3 = "SELECT * FROM juegos WHERE idjuegos='$gameId'";
                    $result3 = mysqli_query($conn, $query3);
                    //de nuevo, recorremos los datos con un tercer while, para recorrer la tabla juegos y obtener los datos de estos para mostrarlos en una tabla. 
                    while($row3 = mysqli_fetch_array($result3)){
            ?>
            <?php
                //Imprimimos la tabla mediante otro código PHP separado para evitar posibles errores.
                $juego = $row3['nombre'];
                $proveedor = $row3['proveedor'];
                echo '<tr>';
                echo '<td class="idTable">' .$juego. '</td>';
                echo '<td class="idTable">' .$proveedor. '</td>';
                echo '</tr>';
            ?>
            <?php
            //Cerramos los bucles de todos los while al final de todo el código abriendo otra etiqueta php para evitar errores.
                    }
                }
            }
            ?>
        </table> 



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