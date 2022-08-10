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
        <!--Mostramos un mensaje indicando el usuario conectado y posteriormente los datos de dicho usuario.-->
        <h3 class="font">Datos del usuario <?php echo $_SESSION['sesion'] ?></h1> 
        <!--Creamos una tabla que englobará el código PHP que extrae los datos del usuario para mostrarlos dentro de ella.-->
        <table>
            <tr>
                <!--Creamos las etiquetas de los títulos de las columnas.-->
                <th class="idTable">ID del Usuario</th>
                <th class="idTable">Usuario</th>
                <th class="idTable">Contraseña</th>
                <th class="idTable">Correo Electrónico</th>
            </tr>
            <?php
            //Obtenemos el nombre de usuario de la sesión y creamos una query para extraer los datos de la base de datos de dicho usuario.
            $user = $_SESSION['sesion'];

            $query = "SELECT * FROM usuario WHERE user = '$user'";
            $result = mysqli_query($conn, $query);

            if(!$result) {
                echo mysqli_error($mysqli);
                exit;
            }
            //Mediante un bucle while recorremos el array que devuelve para mostrarlo en la tabla.
            while($row=mysqli_fetch_array($result)) {
            ?>
            <!--El código PHP se fragmenta y se cierra el bucle while tras dibujar los elementos para evitar errores.-->
            <tr>
                <td><?php echo $row['idusuario'];?></td>
                <td><?php echo $row['user'];?></td>
                <td><?php echo $row['passw'];?></td>
                <td><?php echo $row['correo'];?></td>
            </tr>
            <!--Cerramos el bucle de PHP tras mostrar los datos para que aparezcan correctamente en nuestra página web.-->
            <?php
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