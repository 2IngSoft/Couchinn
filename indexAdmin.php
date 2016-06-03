<?php
  session_start();
  if(!(isset($_SESSION['email']) && $_SESSION['email']=="angelica.portacelutti@gmail.com")){
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Página del admin</title>
  </head>
  <body>
    <h1>!PÁGINA DE ADMINISTRADOR :D!</h1>
    <form method="post">
      <input type="submit" name="cerrar_sesion" value="Cerrar Sesion">
    </form>
    <?php if(isset($_POST["cerrar_sesion"])){session_destroy(); header("location: index.php");} ?>
  </body>
</html>
