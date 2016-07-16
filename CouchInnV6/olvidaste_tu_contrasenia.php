<?php
  session_start();
  $_SESSION['llamada']="olvidaste_tu_contrasenia.php";
  if(isset($_POST['valida_respuesta'])){
    $email=addslashes($_POST['email_2']);
    $res_usuario=addslashes($_POST['respuesta']);
    $res_consulta=addslashes($_POST['respuesta_consulta']);
    if($res_usuario==$res_consulta){
      session_start();
      $_SESSION['usuario']=$email;
      $_SESSION["nombre"]=$_POST["nombre_envio"];
      $_SESSION["apellido"]=$_POST["apellido_envio"];
      $_SESSION['bienvenida']=true;
      header("location: cambiar_contrasenia_olvidaste_contrasenia.php");
    } else {
      echo "<script type='text/javascript'>
              alert('La respuesta ingresada es incorrecta.');
            </script>";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="EstilosCabeceraEstandar.css" charset="utf-8">
    <link rel="stylesheet" href="EstilosOlvidasteContrasenia.css" charset="utf-8">
    <title>CouchInn</title>
    <style>
      .filaInferior{
        border-top-color: green;
        border-top-style: dashed;
        border-top-width: 5px;
      }
      .submitSuperior{
        margin-bottom: 16px;
      }
    </style>
  </head>

  <body>
    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="index.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <div id="linkRegistrarse">
        <a href="couchinnRegistrarse.php">¡Registrate!</a>(es gratis)
      </div>

      <form action="iniciar_sesion.php" method="post" id="formularioIniciarSesion">
        <table>
          <tr>
            <td>
              <label>Correo electrónico: <input type="email" name="email" placeholder="alguien@algo.com" required></label>
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
    </header><br>

    <section>
      <table id="tablaPrincipal">
        <tr>
          <td id="dataTablaPrincipal">
            <form method="post">
              <span id="texto">Ingrese su Email:</span><br>
              <input id="input_texto_tabla" type="email" name="email_1" required="true" autofocus="true" placeholder="algo@alguien.com" value="<?php if(isset($_POST['valida_email1'])){echo $_POST['email_1'];}?>"><br>
              <input type="submit" name="valida_email1" value="Validar email" class="submitSuperior">
            </form>
          </td>
        </tr>

        <tr>
          <td id="dataTablaPrincipal" class="filaInferior">
            <?php
            if(isset($_POST['valida_email1'])){
              require("establece_conexion.php");
              establecer_conexion($conexion);
              $email=addslashes($_POST['email_1']);
              $sql="SELECT EMAIL,TEXTO,RESPUESTASEG,NOMBRE,APELLIDO FROM usuarios NATURAL JOIN preguntasdeseguridad WHERE EMAIL='$email';";
              $resultado=mysqli_query($conexion,$sql);
              $fila=mysqli_fetch_row($resultado);
              if($fila[0]==$email){
                $deshabilita=false;
              } else {
                echo "<script type='text/javascript'>
                alert('El email ingresado no esta registrado.');
                </script>";
                $deshabilita=true;
              }
            } else {
              $deshabilita=true;
            }
            ?>

            <form method="post">
              <span id="texto"><?php if(isset($_POST['valida_email1'])){echo $fila[1];}else{echo "Ingrese primero su mail..";}?></span><br>
              <input id="input_texto_tabla" type="text" name="respuesta" autocomplete="off" <?php if($deshabilita){echo "disabled";}?>><br>
              <input type="hidden" name="email_2" value="<?php if(isset($_POST['valida_email1'])){ echo $_POST['email_1']; } ?>">
              <input type="hidden" name="respuesta_consulta" value="<?php if(isset($_POST['valida_email1'])){ echo $fila[2];} ?>">
              <input type="hidden" name="nombre_envio" value="<?php if(isset($_POST['valida_email1'])){ echo $fila[3];} ?>">
              <input type="hidden" name="apellido_envio" value="<?php if(isset($_POST['valida_email1'])){ echo $fila[4];} ?>">
              <input type="submit" name="valida_respuesta" value="Recuperar contraseña" <?php if($deshabilita){echo "disabled";}?>>
            </form><br>
          </td>
        </tr>
      </table>
    </section>
  </body>
  <?php
  if(isset($_SESSION["error"])){
    echo '<script> alert("'.$_SESSION["error"].'");</script>';
    unset($_SESSION["error"]);
  }
  ?>
</html>
