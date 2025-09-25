<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

  header("location: index.php");

  exit;

}
require_once "config.php";
$username = $password = $username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if(empty(trim($_POST["username"])))
    {
        $username_err = "Por favor ingrese su usuario.";
    } 
    else
    {
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"])))
    {
        $password_err = "Por favor ingrese su contraseña.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err))
    {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){

                          
                            session_start();

                            
                            $_SESSION["loggedin"] = true;

                            $_SESSION["id"] = $id;

                            $_SESSION["username"] = $username;                            

                           

                            header("location: index.php");

                        } else{


                            $password_err = "La contraseña que ha ingresado no es válida.";

                        }

                    }

                } else{

                   

                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";

                }

            } else{

                echo "Algo salió mal, por favor vuelve a intentarlo.";

            }

        }

        mysqli_stmt_close($stmt);

    }

    

    // Cerrar laconexión

    mysqli_close($link);

}

?>

 

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<link href="css/style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">



		<title>Inicio de sesión</title>
	</head>
<body>
    <center>
        <img src="img/pue.png">
        <img src="img/lit.png">
        <h2>Inicio de sesión</h2>
        <p>Por favor seleccione su usuario para iniciar sesión.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Usuario</label>
                <br>
                <select name="username">
                                <option value="Belen">Belen</option>
                                <option value="TeperT1">Supervisor TEPER T1</option>
                                <option value="Cristina">Cristina</option>
                                <option value="TeperT2">Supervisor TEPER T2</option>
                                <option value="Oscar">Oscar</option>
                                <option value="Luisa">Luisa</option>
                                <option value="Lupita">Lupita</option>
                                <option value="Ivonne">Ivonne</option>
                                <option value="MauricioTURNO1">Mauricio Turno1</option>
                                <option value="MauricioTURNO2">Mauricio Turno2</option>
                            </select>
                            <br>
                <!--<input type="text" name="username"  value="<?/*php echo $username; ?>">-->
                <span ><?php echo $username_err; ?></span><br>
                <label>Contraseña</label>
                <input type="password" name="password" value="123456" readonly>
                <span ><?php echo $password_err; ?></span><br>
                <br>
                <input type="submit"  value="Ingresar"><br>
                <!--<p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>-->
        </form>
    </center>
  
</body>
</html>

