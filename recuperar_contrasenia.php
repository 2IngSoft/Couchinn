<?php
  if(isset($_POST['validar_email'])){
    require("establece_conexion.php");
    establecer_conexion($conexion);
    $email=$_POST['email_recuperar'];
    $sql="SELECT TEXTO,RESPUESTASEG FROM usuarios NATURAL JOIN preguntasdeseguridad WHERE EMAIL='$email'";
    $resultado=mysqli_query($conexion,$sql);
    $fila=mysqli_fetch_row($resultado);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCabeceraEstandar.css" charset="utf-8">
    <title>CouchInn</title>

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
              <a href="recuperar_contrasenia.php" id="mjeContrasenia">¿Olvidaste tu contraseña?</a>
            </td>
            <td></td>
          </tr>
        </table>
      </form>
    </header><br>

    <section>
      <form method="post">
        <p>Ingrese su Email:</p>
        <input type="email" name="email_recuperar" autofocus required placeholder="alguien@algo.com" value="<?php
        if(isset($_POST['validar_email'])){
          $email=$_POST['email_recuperar'];
          echo $email;
        }else{echo "";}?>">
        <input type="submit" name="validar_email" value="Verificar">
      </form>
      <p><?php if(isset($_POST['validar_email'])){
        echo $fila[0];
      } else {
        echo "Primero ingrese su EMAIL.";
      }?></p>
      <form method="post" action="cambiar_contrasenia_olvidaste_contrasenia.php">
        <input type="text" name="respuesta_recuperar" required="true" autocomplete="off">
        <input type="hidden" name="email_segundo" value="<?php echo $email; ?>">
        <input type="submit" name="envia_respuesta" value="Validar" <?php if(!isset($_POST['validar_email'])){ echo "disabled";} ?>>
      </form>
    </section>
    <?php
    if(isset($_POST['enviar'])){
      require("establece_conexion.php");
      establecer_conexion($conexion);
      $respuesta=$_POST['respuesta_recuperar'];
      $email=addslashes($_POST['email_segundo']);
      $sql="SELECT RESPUESTASEG FROM USUARIOS WHERE EMAIL='$email'";
      $resultado=mysqli_query($conexion,$sql);
      $fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC);
      if($respuesta==$fila["RESPUESTASEG"]){
        header("location: cambiar_contrasenia_olvidaste_contrasenia.php");
      } else {
        echo "<script type='text/javascript'>
          alert('La respuesta es incorrecta');
        </script>";
      }
    }
    ?>
  </body>
</html>
