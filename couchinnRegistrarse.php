<?php session_start();
      $_SESSION['llamada']="couchinnRegistrarse.php"?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CouchInn.com</title>
    <link rel="stylesheet" href="Estilos/EstilosCabeceraEstandar.css" charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosRegistrarse.css" charset="utf-8">
  </head>

  <body>

    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="index.php"><img src="Imagenes/CouchInnLogo.png" width="270px" height="80px"/></a></figure>

      <form action="iniciar_sesion.php" method="post" id="formularioIniciarSesion">
        <table>
          <tr>
            <td>
              <label>Correo electrónico: <input type="email" name="email" placeholder="alguien@algo.com" required="true"></label>
            </td>
            <td>
              <label>Contraseña: <input type="password" name="contraseña" required="true"></label>
            </td>
            <td>
              <input type="submit" name="iniciar_sesion" value="Ingresar!">
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <a href="olvidaste_tu_contrasenia.php" id="mjeContrasenia">¿Olvidaste tu contraseña?</a>
            </td>
            <td></td>
          </tr>
        </table>
      </form>
    </header>

    <p id="cartelRegistrarse">¡Solo necesitamos unos datos tuyos!</p>
    <form action="pruebaValidacionRegistrarse.php" method="post" autocomplete="off" id="formularioRegistrarseDivision">
      <table id="formularioRegistrarse">
        <tr>
          <td><label>Nombre:</label></td>
          <td><input type="text" required="true" autofocus maxlength="20" size="40" name="nombre_usuario" id="nombre_usuario"></td>
        </tr>
        <tr>
          <td><label>Apellido: </label></td>
          <td><input type="text" required="true" maxlength="20" size="40" name="apellido_usuario" id="apellido_usuario"></td>
        </tr>
        <tr>
          <td><label>Cumpleaños:</label></td>
          <td>
            <input type="date" name="fecha_nac" required="true" min="1920-01-01" max="<?php $año=date('Y')-13; echo date('$fecha'-'m'-'d'); ?>">
          </tr>
          <tr>
            <td><label>EMail: </label></td>
            <td><input type="email" name="email_usuario" required="true" placeholder="alguien@algo.com"></td>
          </tr>
          <tr>
            <td><label>Telefono: </label></td>
            <td><input type="text" maxlength="20" size="30" name="telefono" id="telefono"></td>
          </tr>
          <tr>
            <td><label>Contraseña: </label></td>
            <td><input type="password" required="true" maxlength="20" size="25" name="contraseña_usuario"></td>
          </tr>
          <tr>
            <td><label>Confirmar contraseña: </label></td>
            <td><input type="password"  required="true" maxlength="20" size="25" name="confirma_contraseña" id="confirma_contraseña"></td>
          </tr>
          <tr>
            <td><label>Pregunta de seguridad:</td>
            <td>
              <!--REVISAR-->
              <?php
                require("establece_conexion.php");
                establecer_conexion($conexion);
                $sql="SELECT * FROM `preguntasdeseguridad`";
                $resultado=mysqli_query($conexion,$sql);
                echo "<select name='pregunta_de_seguridad' required='true'>";
                while ($fila=mysqli_fetch_row($resultado)) {
                  echo "<option>";
                  echo $fila[1] ;
                  echo "</option>";
                }
                echo "</select>";
              ?>
            </td>
            </tr>
            <tr>
              <td><label>Respuesta: </label></td>
              <td><input type="text" name="respuesta_de_seguridad" maxlength="30" required="true"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="enviar" value="Enviar!" id="enviarFormulario"></td>
            </tr>
            <tr>
              <td>
                <?php
                if(isset($_SESSION["error"]))
                  echo '<script> alert("'.$_SESSION["error"].'");</script>';
                  unset($_SESSION["error"]);
                ?>
              </td>
            </tr>
          </table>
        </form>
        <?php
        if(isset($_SESSION["error"])){
          echo '<script> alert("'.$_SESSION["error"].'");</script>';
          unset($_SESSION["error"]);
        }
        ?>

  </body>
</html>
