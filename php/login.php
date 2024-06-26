<<?php
session_start(); // Asegúrate de que session_start() se llama al principio del script

require "/var/www/html/libertad/base/DataBase.php";

// Habilitar el reporte de errores para desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new DataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        if ($db->logIn("usuarios", $username, $password)) {
            // Autenticación exitosa
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit; // Detener la ejecución después de la redirección
        } else {
            // Error de login
            $login_error = "Inicio de sesión fallido. El nombre de usuario o la contraseña pueden ser incorrectos.";
        }
    } else {
        // Campos no llenados
        $login_error = "Todos los campos son obligatorios.";
    }
}

// Aquí podrías incluir tu HTML o cualquier otro código relevante
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <audio autoplay loop>
    <source src="song/song.mp3" type="audio/mp3">
    Tu navegador no soporta el elemento de audio.
  </audio>
  <div class="overlay"></div>
  <div class="scanline"></div>
  <div class="wrapper">
    <header>
      <div class="content clearfix">
        <div class="col one">
          <img src="/recursos/logo.png" alt="591 Systems" width="740" height="729" id="logo-v" />
        </div>
        <div class="col two">
          <h4>En este lugar, ni dioses ni reyes, tan solo el hombre.</h4>
          <hr>
          <p>Una proclama de independencia y autonomía,</p>
          <p>un homenaje al ingenio y espíritu humano.</p>
          <p>&copy;2024 Humanidad Ascendente</p>
          <p>- Libertad para Todos -</p>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form action="/php/login.php" method="post" id="loginForm">
        <fieldset>
          <legend>Iniciar Sesión</legend>
          <label for="username">Usuario: </label>
          <input type="text" name="username" id="username" required /><br />
          <label for="password">Contraseña: </label>
          <input type="password" name="password" id="password" required /><br /><br /><br />
          <input type="submit" value="Iniciar Sesión" />
        </fieldset>
      </form>
    </section>
    <footer>
      <p>Derechos reservados © 2024 Humanidad Ascendente</p>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/js/script.js"></script>
</body>
</html>
