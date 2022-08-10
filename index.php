
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/estilo.css"> <!--Añadimos el archivo CSS al html para darle estilo a nuestra página web.-->
        <title>Lucky Time Casino</title>
    </head>

    <body>
        <!--Incluimos todo el contenido del body en un div que permita mantener la estructura al aumentar o disminuir el tamaño de la pantalla con respecto al footer y Header.-->
        <div class=container>
            <!--Creamos un header concreto para nuestra página inicial que será distinto al que el usuario verá una vez se conecte.-->
            <header>
                <!--Incluimos el audio en un div para colocarlo en la esquina superior derecha.-->
                <div class="audiocontainer">
                    <!--Permitimos la repetición automática y los controles para que el usuario pueda activar o desactivar la música -->
                    <!--Por defecto está desactivada la reproducción automática ya que el audio no se puede controlar previamente a la reproducción automática y puede sonar muy fuerte.-->
                    <audio loop controls> 
                        <source src="sound/casino.mp3" type="audio/mp3">
                    </audio>
                </div>
                <!--Incluimos el logo del casino y la bienvenida.-->
                <img src="img/LuckyTime.png" class="logo"> 
                <h2 class="font">Bienvenido a Luckytime Casino</h2>
            </header>

            <h3 class="font">Ingresa tu usuario y contraseña.</h3>
            <!--A continuación, añadimos un formulario para ejecutar la autenticación del usuario. Estos datos se enviarán a auth.php para realizar las respectivas queries a la Base de Datos del casino.-->
            <form method="POST" action="auth.php">
                <input type="text" name="username" placeholder="Usuario" class="formu" required>
            
                <input type="password" name="password" placeholder="Contraseña" class="formu" required>
            
                <input type="submit" name="conectar" value="Login" class="botonformu">
            </form>
            <!--Tras el formulario, añadimos la opción de poder registrarse como nuevo usuario si no posee una cuenta. Esto lo enviará a signup.php para realizar el registro de nuevo usuario.-->
            <span class="new-user">¿Nuevo en LuckyTime? Regístrate gratis pulsando <a href="signup.php">Aquí</a></span>
        </div>
        <!--Por último añadimos el footer y la firma del código. Fuera de nuestro div container para que hagamos lo que hagamos en nuestro body, quede estructurado fuera del footer.-->
        <div class="footer">
            <div>
                <img src="img/LuckytimeInvert.jpg" class="logo">
            </div>
            <div class="signature">
                Código realizado por Julio José González Sánchez - Proyecto LuckyTime, 2022.
            </div>
        </div>
    </body>
</html>