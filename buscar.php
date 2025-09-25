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
$busqueda=$_POST['cadena'];

$sql_query = "SELECT marca from pv where economico=$busqueda";
$resultset = mysqli_query($conexion, $sql_query) or die("Falta # unidad...");
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) 
{
echo $developer ['marca'];
}
?>