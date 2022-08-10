<?php //En primer lugar damos los valores que vamos a utilizar para realizar la conexión a la base de datos.
$servername="localhost";
$username="root";
$password="";
$dbname="casino";

//Creamos una variable que aúne estos datos para establecer la conexión a la base de datos.
$conn = new mysqli($servername,$username,$password,$dbname);
//Si la variable $conn falla en su conexión a la base de datos, nos devolverá un error.
if(!$conn) {
    die("Conexión fallida" . mysqli_connect_error());
}

?>

