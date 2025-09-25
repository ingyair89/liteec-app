<html>
<body bgcolor="#33BBF">
<?php
/*$host = 'localhost';
$basededatos = '458498';
$usuario = '458498';
$contrasea = 'astral00';*/

/*$host = 'localhost';
$basededatos = 'oaxaca';
$usuario = 'root';
$contrasea = '';*/

$host = 'MYSQL5040.site4now.net';
$basededatos = 'db_a66ed0_puebla';
$usuario = 'a66ed0_puebla';
$contrasea = 'astral00';

$cl=$_POST['clave'];

$conexion =mysqli_connect($host, $usuario,$contrasea, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE unidad eliminada ///////////////////////
$sql_query = "DELETE from informacion where id_servicio=$cl";

$resultset = mysqli_query($conexion, $sql_query) or die("database error:". mysqli_error($conexion));

echo "<script type='text/javascript'>  alert('Registro eliminado, checa tu captura.');  window.location.href = 'index.php';";
?>

</script>
</body>
</html>