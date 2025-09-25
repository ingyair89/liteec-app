<html>
<body bgcolor="#33BBF">
  <link rel="stylesheet" type="text/css" href="css/responsivo.css">
<?php
date_default_timezone_set('America/Mexico_City');
$host = 'MYSQL5040.site4now.net';
$basededatos = 'db_a66ed0_puebla';
$usuario = 'a66ed0_puebla';
$contrasea = 'astral00';

$f=$_POST['fecha'];
$arre1=str_split($f);
$fe="$arre1[8]$arre1[9],$arre1[5]$arre1[6],$arre1[2]$arre1[3]";


$conexion =mysqli_connect($host, $usuario,$contrasea, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE unidad buscada ///////////////////////
?>

<b><h2>Servicios con fecha <?php echo " $fe"; ?>:</h2></b>
<b><h2>TALLER ADO</h2></b>
<!-----------------Mostrar consulta en PHP-------------------->
<div class="container">
<div class="well-sm col-sm-12">
<div class="btn-group pull-right">
</div>
</div>
<table border="1">
<tr bgcolor="greenyellow" style="font-size:16px;">
<th>Clave servicio</th>
<th>Fecha</th>
<th>Unidad</th>
<th>Marca</th>
<th>Servicio</th>
<th>Supervisor</th>
<th>Turno</th>
<th>Empleado</th>
<th>Lugar</th>
</tr>
<tbody>
<?php 
   
  $sql_query = "SELECT * from informacion where fecha='$fe' and lugar='TALLER'";

$resultset = mysqli_query($conexion, $sql_query) or die("database error:". mysqli_error($conexion));
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) { ?>
<tr>
<td><?php echo $developer ['id_servicio']; ?></td>
<td><?php echo $developer ['fecha']; ?></td>
<td><?php echo $developer ['unidad']; ?></td>
<td><?php echo $developer ['marca']; ?></td>
<td><?php echo $developer ['servicio']; ?></td>
<td><?php echo $developer ['supervisor']; ?></td>
<td><?php echo $developer ['turno']; ?></td>
<td><?php echo $developer ['empleado']; ?></td>
<td><?php echo $developer ['lugar']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<br>
<b><h2>CAPU</h2></b>
<div class="container">
<div class="well-sm col-sm-12">
<div class="btn-group pull-right">
</div>
</div>
<table border="1">
<tr bgcolor="greenyellow" style="font-size:16px;">
<th>Clave servicio</th>
<th>Fecha</th>
<th>Unidad</th>
<th>Marca</th>
<th>Servicio</th>
<th>Supervisor</th>
<th>Turno</th>
<th>Empleado</th>
<th>Lugar</th>
</tr>
<tbody>
<?php 
   
  $sql_query = "SELECT * from informacion where fecha='$fe' and lugar='CAPU'";

$resultset = mysqli_query($conexion, $sql_query) or die("database error:". mysqli_error($conexion));
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) { ?>
<tr>
<td><?php echo $developer ['id_servicio']; ?></td>
<td><?php echo $developer ['fecha']; ?></td>
<td><?php echo $developer ['unidad']; ?></td>
<td><?php echo $developer ['marca']; ?></td>
<td><?php echo $developer ['servicio']; ?></td>
<td><?php echo $developer ['supervisor']; ?></td>
<td><?php echo $developer ['turno']; ?></td>
<td><?php echo $developer ['empleado']; ?></td>
<td><?php echo $developer ['lugar']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<br>
<button style="font-size: 45px;" onclick="window.location.href='index.php'">Regresar a captura</button>

</body>
</html>