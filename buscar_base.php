<?php 
$host = 'MYSQL5040.site4now.net';
$basededatos = 'db_a66ed0_puebla';
$usuario = 'a66ed0_puebla';
$contrasea = 'astral00';

$conexion =mysqli_connect($host, $usuario,$contrasea, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}

//Recogemos la cadena
$busqueda=$_POST['cadena2'];

$sql_query = "SELECT base from pv where economico=$busqueda";
$resultset = mysqli_query($conexion, $sql_query) or die("SIN BASE");
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) 
{
echo $developer ['base'];
}
?>