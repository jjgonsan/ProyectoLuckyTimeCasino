<?php //Creamos la destrucción de sesión del usuario para llamarla desde la función de javascript.
session_destroy();
session_unset();
//Alertamos al usuario del cierre de su sesión y lo devolvemos a index.php.
echo '<script type="text/javascript">
alert ("Has cerrado sesión en LuckyTime correctamente. ¡Vuelve pronto!");
window.location.href="index.php";
</script>';
?>