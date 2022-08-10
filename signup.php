<!DOCTYPE html><!--Creamos una estructura html.-->
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilo.css">
        <title>LuckyTime Casino</title>
    </head>
    <body>
        <header>
        <img src="img/LuckyTime.png" class="logo"> <!--Incluimos el logo del casino.-->
        </header>

        <h3 class="font">Regístrate en Lucky Time</h3>
        <!--Creamos el formulario de registro de usuario con los datos que debe rellenar.-->
        <form action="signup.php" method="POST" class="formu">
            <input type="text" name="email" placeholder="Correo Electrónico" class="formu" required>
            <input type="text" name="username" placeholder="Nombre de usuario"class="formu" required>
            <input type="password" name="password" placeholder="Contraseña"class="formu" required>
            <!--Añadimos otro input de contraseña que utilizaremos para compararlas y confirmar que la contraseña que ha escrito es la que quiere utilizar.-->
            <input type="password" name="confirmar_contraseña" placeholder="Confirmar la contraseña" class="formu" required>
            <input type="submit" name="crear" value="Crear Usuario" class="botonformu">
        </form>
        <!--Añadimos la opción de volver a index.php si el usuario ha pulsado por error la opción de crear una cuenta.-->
        <h4 class="font"><a href="index.php">Volver</a> a la página principal.</h4>
        <!--Añadimos el footer de nuestra página web con el logo y la firma del autor del código.-->
        <div class="footer">
            <div>
            <img src="img/LuckytimeInvert.jpg" class="logo">
            </div>
            <div class="signature">
                Código realizado por Julio José González Sánchez - Proyecto LuckyTime, 2022.
            </div>

        </div>
    </body>

<?php
//Incluimos la conexión a la base de datos.
include "database.php";
//Al pulsar el input del formulario enviará los datos a este mismo documento donde se crearán las variables de los datos escritos por el usuario.
if(isset($_POST['crear'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password =$_POST['password'];
    $confirmPass=$_POST['confirmar_contraseña'];
    //El proceso de creación de usuario solo continuará si la contraseña que ha escrito el usuario coincide con el campo de confirmar contraseña. Si no, devolverá una alerta indicando que las contraseñas no coinciden.
    if($password === $confirmPass) {
        //Creamos una consulta a la base de datos para crear el nuevo usuario.
        $sql ="INSERT INTO usuario (user, passw, correo) VALUES ('$username', '$password', '$email')";

        $crearUsuario = mysqli_query($conn, $sql);
        //Si la creación es correcta, se avisará al usuario y será redirigido a index.php.
        if($crearUsuario) {
            echo '<script type="text/javascript">
            alert("Usuario creado correctamente.");
            window.location.href="index.php";
            </script>';
        //Si la creación no se ha realizado por algún problema también será avisado.
        } else {
            echo '<script type="text/javascript">
            alert ("El usuario no ha podido ser creado.");
            window.location.href="signup.php";
            </script>';
        }   

    } else {
        echo '<script type="text/javascript">
            alert ("Las contraseñas no coinciden.");
            window.location.href="signup.php";
            </script>';
    }

    
}

?>

</html>