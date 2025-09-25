<html>
<body bgcolor="#33BBF">
  <link rel="stylesheet" type="text/css" href="css/responsivo.css">
  <link rel="stylesheet" type="text/css" href="css/formu.css">
<?php
date_default_timezone_set('America/Mexico_City');

$host = 'MYSQL5040.site4now.net';
$basededatos = 'db_a66ed0_puebla';
$usuario = 'a66ed0_puebla';
$contrasea = 'astral00';

$sup=$_POST['n'];
$fecha =date("d,m,y");

echo '<h2>Fecha de hoy: '.$fecha.'</i></h2>';

$conexion =mysqli_connect($host, $usuario,$contrasea, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE LAS UNIDADES INSERTADAS ///////////////////////
?>
<div id="contenedor">
  <div>
    <div id="login">
<form action="buqueda_bus.php" method="post" id="loginform">
  <fieldset>
    <legend>Buscar unidad</legend>
    <input type="number" name="b_uni" placeholder="# unidad" required>
    <input type="submit" name="" value="Buscar unidad" style="font-size: 15px; font-weight: bold;">
  </fieldset>
</form>

<br>
<form action="buqueda_bus_fecha.php" method="post" id="loginform">
  <fieldset>
    <legend>Buscar servicios por fecha</legend>
    <input type="date" name="fecha" required>
    <input type="submit" name="" value="Buscar servicios por fecha" style="font-size: 15px; font-weight: bold;">
  </fieldset>
</form>
<br>
<form action="elimina_bus.php" method="post" id="loginform">
  <fieldset>
    <legend>Eliminar clave de servicio</legend>
    <input type="number" name="clave" placeholder="Clave servicio" required>
    <input type="submit" name="" value="Eliminar clave servicio" style="font-size: 15px; font-weight: bold;">
  </fieldset>
</form>
</div>
</div>
</div>


<!--conteo de servicios totales-->
<?php 
$serv=0;
$sql_query = "SELECT * from informacion where fecha='$fecha' and supervisor like '$sup%'";
$resultset = mysqli_query($conexion, $sql_query) or die("database error:". mysqli_error($conexion));
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) {
$serv=$serv+1;
} 
?>





<b><h2>Autobuses capturados hoy por<?php echo " $sup.<br> Total: $serv"; ?></h2></b>
<!-----------------Mostrar consulta en PHP-------------------->
<div class="container">
<div class="well-sm col-sm-12">
<div class="btn-group pull-right">
</div>
</div>
<table border="2">
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
    /*$m = date("m"); // Month value
    $de = date("d"); // Today's date
    $y = date("Y"); // Year value

    $fe=date('d,m,y', mktime(0,0,0,$m,($de-1),$y));*/

    //echo "<b>Captura del: $fecha</b>"; 
if($sup=="administrador" || $sup=="ADMINISTRADOR" || $sup=="Administrador")
{
  echo "<h2>En el apartado <font color='red'><u>Buscar servicios por fecha</u></font> selecciona una fecha especifica para mostrarte los servicios dados.</h2>";
  $sql_query = "SELECT * from informacion where supervisor='0'";
}

else if($sup=="Oscar" || $sup=="OSCAR" || $sup=="oscar" || $sup=="LUISA" || $sup=="luisa" || $sup=="Luisa")
{
  $m = date("m"); // Month value
  $de = date("d"); // Today's date
  $y = date("Y"); // Year value
  $fecha=date('d,m,y', mktime(0,0,0,$m,($de-1),$y)); 
  $sql_query = "SELECT * from informacion where fecha='$fecha' and supervisor like '$sup%'";

  $serv=0;
$resultset = mysqli_query($conexion, $sql_query) or die("database error:". mysqli_error($conexion));
$datos = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$datos[] = $rows;
}
foreach($datos as $developer) {
$serv=$serv+1;
} 
echo '<b><h2>'.$serv.'</b></h2>';

}

else
{
  $sql_query = "SELECT * from informacion where fecha='$fecha' and supervisor like '$sup%'";
}


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
<button style="font-size: 45px;" onclick="window.location.href='index.php'">Regresar a capturar</button>

</body>
</html>