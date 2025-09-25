<?php
date_default_timezone_set('America/Mexico_City');
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$host = 'MYSQL5040.site4now.net';
$basededatos = 'db_a66ed0_puebla';
$usuario = 'a66ed0_puebla';
$contrasea = 'astral00';

$fecha =date("d,m,y");

echo '<h2 style="color: white;">Fecha de hoy: '.$fecha.'</i></h2>';


$conexion =mysqli_connect($host, $usuario,$contrasea, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno() 
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE LOS ///////////////////////

//$trabajador="SELECT cut,nombre,turno,area,lugar FROM trabajador order by cut";
//$queryTrabajador= $conexion->query($trabajador);

?>

<html lang="es">
	<head>
		<title></title>
		<link rel="icon" href="img/ico.png">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<link rel="stylesheet" href="css/estilos.css" rel="stylesheet">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

		<script>
    		$(function(){
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
				});
				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
		</script>

	</head>
	<body onload="cambio()">
		<div style="background-color: #3e77b6; opacity: .9;">
		<hr>
		<form action="info.php" method="post" name="f">
			<input type="text" style="position: relative; left: 1px;" required name="n" value="<?php echo $_SESSION['username']?>" readonly>
			<input type="submit" value="Ver captura del día">
		</form>
		<hr>
	</div>
				<header>
			<div class="alert alert-info">
				<h1>Bienvenid@ <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
				<a href="logout.php">Cerrar sesión</a><br>
			<h2>Sistema TALLER - CAPU</h2>
			</div>



			<script type="text/javascript">
			function cambio()
			{
				var s = "<?php echo $_SESSION['username']?>";
				
				if(s=="MauricioTURNO1" || s=="MauricioTURNO2" || s=="Lupita" || s=="Ivonne" || s=="TeperT1" || s=="TeperT2")
				{
					document.getElementById("ex").options.item(1).selected = 'selected';
				}
				
			}

		</script>



		</header>
		<section>
				
			<form method="post">				
				<h3 class="bg-primary text-center pad-basic no-btm">Captura de servicios</h3>
				<table class="table bg-info"  id="tabla">
					
					<tr class="fila-fija">
						<td><input type="number" style="width: 70px;" required minlength="1" maxlength="6" name="cut[]" placeholder="# Bus" onkeyup="buscar_ajax(this.value);"/></td>
						<!--<td><input required name="nombre[]" placeholder="Nombre"/></td>|-->
					</tr>
						<tr class="fila-fija">
						<td><select name="servicio" id="ex">
					   <option value="Rutinario">Rutinario</option>
					   <option value="Express">Express</option>
					   <option value="F">F</option>
					   <option value="Paso">De paso</option>
			   	  </select></td>
			   	  </tr><!--Caja para marca-->
			   	  <td><input type="text" name="marca" id="mostrar"></td>


			   	  <tr class="fila-fija">
						<td><input required style="text-transform:uppercase;" minlength="2" maxlength="20" style="width: 65px;" name="lun[]" placeholder="Empleado"/></td>
						</tr>

					</tr>
				</table>
				<div class="btn-der">
					<input type="submit" name="insertar" value="Insertar datos" class="btn btn-info"/>
					
				</div>
				<br><br><br>
			</form>
			<?php
				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))
				{
				$items1 = ($_POST['cut']);
				//$items2 = ($_POST['nombre']);
				$items3 = ($_POST['lun']);
				
				///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
				while(true) {
				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    //$item2 = current($items2);
				    $item3 = current($items3);
				    
				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $cut=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    //$nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $lu=(( $item3 !== false) ? $item3 : ", &nbsp;");

				    $dato=$_SESSION["username"];
				      if ($dato=="Belen" || $dato=="TeperT1")
				    {
				    	$turno="T1";
				    	$lugar="TALLER";
				    }
				     
				    else if ($dato=="Cristina" || $dato=="TeperT2")
				    {
				    	$turno="T2";
				    	$lugar="TALLER";
				    }

				    else if ($dato=="Oscar" || $dato=="Luisa")
				    {
				    	$m = date("m"); // Month value
    					$de = date("d"); // Today's date
    					$y = date("Y"); // Year value
    					$fecha=date('d,m,y', mktime(0,0,0,$m,($de-1),$y)); 
				    	$turno="T3";
				    	$lugar="TALLER";
				    }
				    else if ($dato=="Lupita")
				    {
				    	$turno="T1";
				    	$lugar="CAPU";
				    }
				    else if ($dato=="Ivonne")
				    {
				    	$turno="T2";
				    	$lugar="CAPU";
				    }
				    else if ($dato=="MauricioTURNO1")
				    {
				    	$turno="T1";
				    	$lugar="CAPU";
				    }
				     else if ($dato=="MauricioTURNO2")
				    {
				    	$turno="T2";
				    	$lugar="CAPU";
				    }




				    $valores='("'.$cut.'","'.$_POST['servicio'].'","'.$fecha.'","'.$_SESSION["username"].'","'.$turno.'","'.$lu.'","'.$lugar.'","'.$_POST['marca'].'"),';




				    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
				    $valoresQ= substr($valores, 0, -1);
				    ///////// QUERY DE INSERCIÓN ///////////////////////////
				    $sql = "insert into informacion (unidad, servicio, fecha, supervisor, turno,empleado,lugar,marca) values $valoresQ";
					$sqlRes=$conexion->query($sql) or mysqli_error();
				    // Up! Next Value
				    $item1 = next( $items1 );
				    //$item2 = next( $items2 );
				    $item3 = next( $items3 );

				    //echo $n_e.'  '. $tur.' '.$fecha;
				    echo '<script type="text/javascript">
                     alert("Unidad ingresada correctamente.");
                     window.location.href = "index.php";
                     </script>';
				    
				    // Check terminator
				    if($item1 === false && $item3 === false) break;
    
				}
		
				}

			?>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	function buscar_ajax(cadena){
		$.ajax({
		type: 'POST',
		url: 'buscar.php',
		data: 'cadena=' + cadena,
		success: function(respuesta) {
			//Copiamos el resultado en #mostrar
			$('#mostrar').html(respuesta);
			document.getElementById('mostrar').style.color="red";
			document.getElementById('mostrar').value=respuesta;
	   }
	});
	}
	</script>




		</section>
		<footer>
		</footer>
	</body>

</html>