<?php
  session_start();
  if((!isset($_SESSION["usuario"]))||($_SESSION["usuario"]!="angelica.portacelutti@gmail.com")){
    header("location: index.php");
  } else {
    $_SESSION['pagAnterior']="indexAdmin.php";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="EstilosIndexSesionIniciada.css"charset="utf-8">
    <title>Página del admin</title>
    <style media="screen">
      .Derecha{
        float: right;
        margin-right: 20px;
      }
      .Izquierda{
        float: left;
        margin-top: 3.4%;
        margin-left: 10%;
      }
    </style>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="indexAdmin.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <h2 class="Izquierda">!PÁGINA DE ADMINISTRADOR :D!</h2>
      <table id="tabla_opciones" class="Derecha">
        <tr>
          <td>
            <form action="agregarTipoDeHospedaje.php" method="post">
              <input id="submit_opcion_usuario" type="submit" name="editar_tipos_de_hospedajes" value="Editar tipos de hospedajes">
            </form>
          </td>
          <td>
            <form method="post">
              <input id="submit_opcion_usuario" type="submit" name="cerrar_sesion" value="Cerrar Sesion">
            </form>
            <?php if(isset($_POST["cerrar_sesion"])){session_destroy(); header("location: index.php");} ?>
            </td>
        </tr>
      </table>
    </header>
  </body>
</html>
