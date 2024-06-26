<?php
// Iniciar sesión y verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario_autenticado']) || $_SESSION['usuario_autenticado'] !== true) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

// Inicialización de variables para evitar errores en caso de que se acceda directamente
$name = $email = $subject = $message = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? ''; // Obtener el nombre desde el formulario
    $email = $_POST['email'] ?? ''; // Obtener el email desde el formulario
    $subject = $_POST['subject'] ?? ''; // Obtener el asunto desde el formulario
    $message = $_POST['message'] ?? ''; // Obtener el mensaje desde el formulario
    // Aquí puedes añadir el código para procesar estos datos, como enviar un email o guardar en una base de datos
}

// Título dinámico para la página
$tituloPagina = "Formulario de Contacto";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>hola</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
<div class="overlay"></div>
<div class="scanline"></div>
<div class="wrapper">
  <div class="content clearfix">
    <!-- Encabezado y logo -->
    <header class="site clearfix">
      <div class="col one">
        <img src="/recursos/logo.png" alt="591 Systems" width="740" height="729" id="logo-v" />
      </div>
      <div class="col two">
        <h4>En este lugar, ni dioses ni reyes, tan solo el hombre.</h4>
        <p>----------------------------------------</p>
        <p>Una proclama de independencia y autonomía,</p>
        <p>un homenaje al ingenio y espíritu humano.</p>
        <p>(c)2024 Humanidad Ascendente</p>
        <p>- Libertad para Todos -</p>
      </div>
    </header>

    <nav class="site clear">
      <ul>
        <li><a href="#" title="">menu principal</a></li>
        <li><a href="#" title="">block</a></li>
        <li><a href="#" title="">Contacto</a></li>
        <li><a href="#" title="">usuarios</a></li>
      </ul>
    </nav>

    <p>Desafío a los Ideales</p>
    <p>Vigilante de la Libertad - Mack Richardson</p>
    <p class="clear"><br /></p>
    <p>Ante el vasto océano de posibilidades, cada ola representa no un engaño, sino un desafío; no una utopía perdida, sino un faro de lo que podría ser. En la encrucijada de caminos que construimos, reconocemos que el libre mercado forja competidores, no enemigos; y la moralidad, aunque a veces eclipsada, es la brújula que nos guía hacia nuestro verdadero potencial.</p>
    <p>Invocamos a los pioneros, a los inventores de mañana, a sumergirse en el mar de la innovación y enviar sus visiones. Que cada acción tomada aquí marque el inicio de una nueva era de descubrimiento. Mack Richardson, el Vigilante de la Libertad, se compromete a navegar junto a ustedes por estos mares, descubriendo no solo lo que somos, sino lo que podemos llegar a ser.</p>
    <p>Gracias por unirse a esta expedición hacia la excelencia, por creer en el poder del individuo para forjar el destino de todos.</p><br />

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label>Name >></label><input type="text" name="name" /><br />
      <label>Email >></label><input type="text" name="email" /><br />
      <label>Subject >></label><input type="text" name="subject" /><br />
      <label>Message >></label><textarea id="text" name="message" rows="1"></textarea><br /><br /><br />
      <input type="submit" value="Submit" />
      <a class="button" alt="" href="index.html">Cancel</a>
    </form>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="./script.js"></script>
</body>
</html>
