<?php
  session_start();
  if(!isset($_SESSION["usuario"])){   //q pasa cuando no hay nada en $_SESSION
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CouchInn</title>
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css" charset="utf-8">
    <style>
      .boton1{
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
      }
      .boton2{
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
      }
    </style>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="couchInnIndexSesionIniciada.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <table id="premium_foto_crearPost">
        <tr>
          <td>
            <span id="cartel_premium">¿Todavía no sos PREMIUM?<br><a href="" id="cartel_premium_sub">¡Hacé click aquí!</a></span>
          </td>
          <td>
            <figure id="sectorImagenUsuario"><a href=""><img src="lenny_concentrado.png" height="90px" width="90px" id="imagenPerfil"/></a>
              <figcaption><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?></figcaption>
            </figure><!--CONECTAR CON BD Y TRAER IMAGEN DEL USUARIO-->
          </td>
        </tr>
      </table>
      <table id="tabla_opciones">
        <tr>
          <td>
            <form id="opcion_usuario" action="Perfil.php" method="post">
              <input class="boton1" type="submit" name="mi_perfil" value="Mi Perfil" id="submit_opcion_usuario">
            </form>
          </td>
          <td>
            <form id="opcion_usuario" action="" method="post">
              <input type="submit" name="publicar" value="Publicar" id="submit_opcion_usuario">
            </form>
          </td>
          <td>
            <form id="opcion_usuario" action="" method="post">
              <input type="submit" name="mis_reservas" value="Mis Reservas" id="submit_opcion_usuario">
            </form>
          </td>
          <td>
            <form id="opcion_usuario" action="" method="post">
              <input type="submit" name="mis_publicaciones" value="Mis Publicaciones" id="submit_opcion_usuario">
            </form>
          </td>
          <td>
            <form id="opcion_usuario" action="" method="post">
              <input type="submit" name="mis_solicitudes" value="Mis Solicitudes" id="submit_opcion_usuario">
            </form>
          </td>
          <td>
            <form id="opcion_usuario" method="post">
              <input class="boton2" type="submit" name="cerrar_sesion" value="Cerrar Sesion" id="submit_opcion_usuario">
            </form>
            <?php if(isset($_POST['cerrar_sesion'])){session_destroy();header("location: index.php");}?>
          </td>
        </tr>
      </table>
    </header>
  </body>
</html>
