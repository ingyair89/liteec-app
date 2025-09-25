<?php

// se incluye el archivo de configuración

require_once "config.php";

 

// Definir variables e inicializar con valores vacíos

$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";

 

// Procesamiento de datos del formulario cuando se envía el formulario

if($_SERVER["REQUEST_METHOD"] == "POST"){

 

    // Validar el nombre de usuario

    if(empty(trim($_POST["username"]))){

        $username_err = "Por favor ingrese un usuario.";

    } else{

        // Preparar la consulta

        $sql = "SELECT id FROM users WHERE username = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Vincular variables a la declaración preparada como parámetros

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            

            // asignar parámetros

            $param_username = trim($_POST["username"]);

            

            // Intentar ejecutar la declaración preparada

            if(mysqli_stmt_execute($stmt)){

                /* almacenar resultado*/

                mysqli_stmt_store_result($stmt);

                

                if(mysqli_stmt_num_rows($stmt) == 1){

                    $username_err = "Este usuario ya fue tomado.";

                } else{

                    $username = trim($_POST["username"]);

                }

            } else{

                echo "Al parecer algo salió mal.";

            }

        }

         

        // Declaración de cierre

        mysqli_stmt_close($stmt);

    }

    

    // Validar contraseña

    if(empty(trim($_POST["password"]))){

        $password_err = "Por favor ingresa una contraseña.";     

    } elseif(strlen(trim($_POST["password"])) < 6){

        $password_err = "La contraseña al menos debe tener 6 caracteres.";

    } else{

        $password = trim($_POST["password"]);

    }

    

    // Validar que se confirma la contraseña

    if(empty(trim($_POST["confirm_password"]))){

        $confirm_password_err = "Confirma tu contraseña.";     

    } else{

        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($password_err) && ($password != $confirm_password)){

            $confirm_password_err = "No coincide la contraseña.";

        }

    }

    

    // Verifique los errores de entrada antes de insertar en la base de datos

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        

        // Prepare una declaración de inserción

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

         

        if($stmt = mysqli_prepare($link, $sql)){

            // Vincular variables a la declaración preparada como parámetros

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            

            // Establecer parámetros

            $param_username = $username;

			$param_password = password_hash($password, PASSWORD_DEFAULT); // Crear una contraseña hash

            

            // Intentar ejecutar la declaración preparada

            if(mysqli_stmt_execute($stmt)){

                // Redirigir a la página de inicio de sesión (login.php)

                header("location: login.php");

            } else{

                echo "Algo salió mal, por favor inténtalo de nuevo.";

            }

        }

         

        // claración de cierre

        mysqli_stmt_close($stmt);

    }

    

    // Cerrar la conexión

    mysqli_close($link);

}

?>

 

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

	<!link href="CSS/estilo_form.css" rel="stylesheet" type="text/css">

    <title>Registro</title>

</head>

<body>

    

        <h2>Registro</h2>

        <p>Por favor complete este formulario para crear una cuenta.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <label>Usuario</label>

                <input type="text" name="username"  value="<?php echo $username; ?>">

                <span><?php echo $username_err; ?></span><br>

            

                <label>Contraseña</label>

                <input type="password" name="password"  value="<?php echo $password; ?>">

                <span><?php echo $password_err; ?></span><br>

            

            

                <label>Confirmar contraseña</label>

                <input type="password" name="confirm_password"  value="<?php echo $confirm_password; ?>">

                <span><?php echo $confirm_password_err; ?></span><br>

            

                <input type="submit"  value="Ingresar">

                <input type="reset"  value="Borrar"><br>

            

            <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>

        </form>

    

</body>

</html>