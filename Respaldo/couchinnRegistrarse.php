<?php
  session_start();
  $_SESSION['llamada']="couchinnRegistrarse.php";
  if(isset($_SESSION['nombre'])){
    $nombre=$_SESSION['nombre'];
  }
  if(isset($_SESSION['apellido'])){
    $apellido=$_SESSION['apellido'];
  }
  if(isset($_SESSION['nac'])){
    $nac=$_SESSION['nac'];
  }
  if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
  }
  if(isset($_SESSION['tel'])){
    $tel=$_SESSION['tel'];
  }
  if(isset($_SESSION['contra'])){
    $contra=$_SESSION['contra'];
  }
  if(isset($_SESSION['confirma'])){
    $confirma=$_SESSION['confirma'];
  }
  if(isset($_SESSION['res'])){
    $res=$_SESSION['res'];
  }
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
    <script type="text/javascript">
      function validarPasswd(){
        var p1 = document.getElementById("contrasenia").value;
        var p2 = document.getElementById("confirmaContrasenia").value;
        if(p1.length >= 8){
          var espacios = false;
          var cont = 0;
          while (!espacios && (cont < p1.length)) {
            if (p1.charAt(cont) == " ")
              espacios = true;
            cont++;
          }
          if (espacios) {
            alert ("La contraseña no puede contener espacios en blanco");
            return false;
          }
          if (p1 != p2) {
            alert("La contraseña y la confirmacion no coinciden");
            return false;
          } else {
            return true;
          }
        } else {
          alert("La contraseña debe tener al menos 8 caracteres.")
          return false;
        }
      }
    </script>

    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="index.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>

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
    <form onSubmit="return validarPasswd()" action="pruebaValidacionRegistrarse.php" method="post" autocomplete="off" id="formularioRegistrarseDivision">
      <table id="formularioRegistrarse">
        <tr>
          <td><label>Nombre:</label></td>
          <td><input type="text" required="true" autofocus maxlength="20" size="40" name="nombre_usuario" id="nombre_usuario" <?php if(isset($_SESSION['nombre'])){echo "value=$nombre";unset($_SESSION['nombre']);}?>></td>
        </tr>
        <tr>
          <td><label>Apellido: </label></td>
          <td><input type="text" required="true" maxlength="20" size="40" name="apellido_usuario" id="apellido_usuario" <?php if(isset($_SESSION['apellido'])){echo "value=$apellido";unset($_SESSION['apellido']);}?>></td>
        </tr>
        <tr>
          <td><label>Cumpleaños:</label></td>
          <td>
            <?php
              $hoy=getdate();
              $año=$hoy['year'] . "<br>";
              $mes=$hoy['mon'];
              $dia=$hoy['mday'];
              if($mes < 10){
                $mes = 0 . $mes;
              }
              if($dia < 10){
                $dia = 0 . $dia;
              }
              $mayorDeEdad=$año-18 . "-" . $mes . "-" . $dia;
            ?>
            <input type="date" name="fecha_nac" id="cumple" required="true" min="1920-01-01" max="<?php echo $mayorDeEdad;?>" onfocus=advertencia() <?php if(isset($_SESSION['apellido'])){echo "value=$nac";unset($_SESSION['nac']);}?>>
            <script>
              document.getElementById("cumple").addEventListener("focus", advertencia);
              function advertencia(e){
                e.target.removeEventListener(e.type, advertencia);
                alert("ADVERTENCIA: USTED DEBE SER MAYOR DE EDAD PARA REGISTRARSE EN ESTE SITIO.");
              }
            </script>
          </tr>
          <tr>
            <td><label>EMail: </label></td>
            <td><input type="email" name="email_usuario" required="true" placeholder="alguien@algo.com" <?php if(isset($_SESSION['email'])){echo "value=$email";unset($_SESSION['email']);}?>></td>
          </tr>
          <tr>
            <td><label>Telefono: </label></td>
            <td><input type="number" maxlength="20" size="30" name="telefono" id="telefono" <?php if(isset($_SESSION['tel'])){echo "value=$tel";unset($_SESSION['tel']);}?>></td>
          </tr>
          <tr>
            <td><label>Contraseña: </label></td>
            <td><input type="password" required="true" maxlength="20" size="25" name="contraseña_usuario" id="contrasenia" placeholder="Debe tener 8 caracteres o más." <?php if(isset($_SESSION['contra'])){echo "value=$contra";unset($_SESSION['contra']);}?>></td>
          </tr>
          <tr>
            <td><label>Confirmar contraseña: </label></td>
            <td><input type="password"  required="true" maxlength="20" size="25" name="confirma_contraseña" id="confirmaContrasenia" <?php if(isset($_SESSION['confirma'])){echo "value=$confirma";unset($_SESSION['confirma']);}?>></td>
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
                unset($_SESSION['preg']);
                echo "<select name='pregunta_de_seguridad' required='true'>";
                while ($fila=mysqli_fetch_row($resultado)) {
                  echo "<option>";
                  echo $fila[1] . "</option>";
                }
                echo "</select>";
              ?>
            </td>
            </tr>
            <tr>
              <td><label>Respuesta: </label></td>
              <td><input type="text" name="respuesta_de_seguridad" maxlength="30" required="true" <?php if(isset($_SESSION['res'])){echo "value=$res";unset($_SESSION['res']);}?>></td>
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
