<?php
//Añadimos database.php y el inicio de sesión para establecer conexión con la base de datos.
include "database.php";
session_start();
//Cuando el usuario pulsa el botón de envío del formulario del login, es redirigido aquí para comprobar los datos que ha introducido.
if(isset($_POST['conectar'])) {
    //se almacenan los datos que ha escrito el usuario en variables para compararlos con los datos de la base de datos.
    $username = $_POST['username'];
    $password =$_POST['password'];
    //Se crean las queries correspondientes para la comparación de los datos.
    $sql = "SELECT user FROM usuario WHERE user='$username'";
    $sql2 = "SELECT passw FROM usuario WHERE user= '$username' AND passw='$password'";
    //Posteriormente, creamos las variables que lanzarán la consulta.
    $login = mysqli_query($conn, $sql);
    $login2 = mysqli_query($conn, $sql2);
    //En primer lugar, si alguna de las dos queries es false, lanzará un error.
    if(!$login){
        echo mysqli_error($mysqli);
        exit;
    }
    if (!$login2) {
        echo mysqli_error($mysqli);
        exit;
    }
    //Si no lanzan error, se comprobará que el usuario y la contraseña coinciden con los elementos de la base de datos. Si es correcto, se ejecutará el siguiente código.
    if($username = mysqli_fetch_assoc($login) && $password = mysqli_fetch_assoc($login2)) {
        $_SESSION['sesion']=$_POST['username']; //Le damos el valor del usuario a la sesión.
        header("Location: main.php"); //Redirecccionamos al usuario a la página principal del casino.
    } else {
        //Si no son correctos los datos, el usuario recibirá un aviso y será redirigido a la página "index.php" para que lo intente de nuevo o se registre como nuevo usuario.
        echo '<script type="text/javascript">
        alert ("El usuario o la contraseña son incorrectos, por favor, inténtelo de nuevo o regístrese.");
        window.location.href="index.php";
        </script>';
    }



}
?>