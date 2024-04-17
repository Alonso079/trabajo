<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); // Inicia o reanuda una sesión

// Simulación de la clase DataBase y su método para este ejemplo
// En un caso real, aquí se incluiría el archivo que contiene la clase DataBase
/*
require 'DataBase.php'; // Incluye la clase DataBase
$db = new DataBase();
*/

// Supongamos que la clase DataBase está definida y tiene este método
class DataBase {
    public function signUp($table, $fullname, $username, $password) {
        // Simula la inserción en la base de datos y devuelve true para indicar éxito
        return true;
    }
    
    public function prepareData($data) {
        // Simula la preparación de datos para evitar inyecciones SQL y XSS
        return htmlspecialchars(stripslashes(trim($data)));
    }
}

$db = new DataBase();

$error = ''; // Inicializa la variable de error

// Verifica que todos los campos del formulario estén presentes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['fullname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        // Verifica que las contraseñas enviadas coincidan
        if ($_POST['password'] === $_POST['confirm_password']) {
            $fullname = $db->prepareData($_POST['fullname']);
            $username = $db->prepareData($_POST['username']);
            $password = $_POST['password']; // La contraseña podría ser hasheada aquí

            // Intenta registrar al usuario en la base de datos
            if ($db->signUp("users", $fullname, $username, $password)) {
                $_SESSION['username'] = $username;
                header('Location: index.php'); // Redirige al usuario a una página de bienvenida
                exit;
            } else {
                $error = "El registro ha fallado. El nombre de usuario puede estar ya en uso, o ha ocurrido un error.";
            }
        } else {
            $error = "Las contraseñas no coinciden.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrarse</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
<div class="overlay"></div>
<div class="scanline"></div>
<div class="wrapper">
  <div class="content clearfix">
    <header class="site clearfix">
      <div class="col one">
        <img src="/fallout-terminal-inspired-style/logo.png" alt="591 Systems" width="740" height="729" id="logo-v" />
      </div>
      <div class="col two">
        <h4>En este lugar, ni dioses ni reyes,<br />tan solo el hombre.</h4>
        <p>----------------------------------------</p>
        <p>Una proclama de independencia y autonomía,</p>
        <p>un homenaje al ingenio y espíritu humano.</p>
        <p>(c)2024 Humanidad Ascendente</p>
        <p>- Libertad para Todos -</p>
      </div>
    </header>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post" id="registerForm">
      <label for="fullname">Nombre Completo: </label>
      <input type="text" name="fullname" id="fullname" required /><br />
      <label for="username">Usuario: </label>
      <input type="text" name="username" id="username" required /><br />
      <label for="password">Contraseña: </label>
      <input type="password" name="password" id="password" required /><br />
      <label for="confirm_password">Confirmar Contraseña: </label>
      <input type="password" name="confirm_password" id="confirm_password" required /><br /><br />
      <input type="submit" value="Registrarse" />
    </form>
  </div>
</div>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://static.tumblr.com/maopbtg/oimmiw86r/jquery.autosize-min.js'></script>
<script src="./script.js"></script>
<script>
  // Aquí mantienes el mismo JavaScript para la validación del lado del cliente
</script>
</body>
</html>
