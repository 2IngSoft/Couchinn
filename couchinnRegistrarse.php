<?php
  require("establece_conexion.php");
  establecer_conexion($conexion);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CouchInn.com</title>
    <link rel="stylesheet" href="EstilosCabeceraEstandar.css" charset="utf-8">
    <link rel="stylesheet" href="EstilosRegistrarse.css" charset="utf-8">
  </head>

  <body>
    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="index.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <!--<div id="linkRegistrarse">
        <a href="couchinnRegistrarse.php">¡Registrate!</a>(es gratis)
      </div>-->
      <form action="iniciar_sesion.php" method="get" id="formularioIniciarSesion">
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
              <a href="calculadora.php" id="mjeContrasenia">¿Olvidaste tu contraseña?</a>
            </td>
            <td></td>
          </tr>
        </table>
      </form>
    </header>

    <p id="cartelRegistrarse">¡Solo necesitamos unos datos tuyos!</p>
    <form action="pruebaValidacionRegistrarse.php" method="get" autocomplete="off" id="formularioRegistrarseDivision">
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
            <input type="date" name="fecha_nac" required="true" min="1920-01-01">
            <!--<input type="day" required="true" maxlength="2" size="1" name="dia" id="dia" placeholder="DD">
            <label> / <input type="number" required="true" maxlength="2" size="1" name="mes" id="mes" placeholder="MM"></label>
            <label> / <input type="text" required="true" maxlength="4" size="2" name="año" id="año" placeholder="AAAA"></label>
            </label><br>
            -->
          </tr>
          <tr>
            <td><label>EMail: </label></td>
            <td><input type="email" name="email" required="true" placeholder="alguien@algo.com"></td>
          </tr>
          <tr>
            <td><label>Telefono: </label></td>
            <td><input type="text" maxlength="20" size="30" name="telefono" id="telefono"></td>
          </tr>
          <tr>
            <td><label>Contraseña: </label></td>
            <td><input type="password" required="true" maxlength="20" size="25" name="contraseña"></td>
          </tr>
          <tr>
            <td><label>Confirmar contraseña: </label></td>
            <td><input type="password"  required="true" maxlength="20" size="25" name="confirma_contraseña" id="confirma_contraseña"></td>
          </tr>
          <tr>
            <td><label>Pregunta de seguridad:</td>
            <td>
              <!--REVISAR-->
              <select name='pregunta_de_seguridad' required='true'>";
                <?php
                  $consulta="SELECT * FROM ";
                  $resultado=mysqli_query($consulta);
                  mysqli_
                ?>
              </select>
              <!--<select name="pregunta_de_seguridad" required="true">
                <option>nombre de tu vieja</option>
                <option>nombre de tu perro</option>
                <option>nombre de tu hermana</option>
              </select>-->
            </td>
            </tr>
            <tr>
              <td><label>Respuesta: </label></td>
              <td><input type="text" name="respuesta_de_seguridad" maxlength="30" required="true"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="enviar" value="Enviar!" id="enviarFormulario"></td>
            </tr>
          </table>
        </form>

  </body>
</html>
