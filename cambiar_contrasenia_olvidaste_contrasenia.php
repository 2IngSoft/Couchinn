<?php
  session_start();
  if(!isset($_SESSION["usuario"])){   //q pasa cuando no hay nada en $_SESSION
    header("location: index.php");
  }
  if($_SESSION["bienvenida"]==true){
    echo "<script type='text/javascript'>
      alert('Iniciaste sesion!! :D');
    </script>";
    $_SESSION["bienvenida"]=false;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CouchInn</title>
    <style>
      body{
        background-color: green;
        padding-left: 37.5%;
        padding-top: 5%;
        text-align: center;
      }
      td{
        font-family: Arial;
        text-align: center;
        padding-top: 10px;
      }
      figure{
        margin:0px;
        margin-left: 10px;
      }
      .logoCouchInn{
        border-style: dashed;
        border-color: grey;
        border-width: 3px;
        border-radius: 10px;
        background-color: white;
        width: 245px;
      }
      form{
        border-style: dashed;
        border-color: grey;
        border-width: 3px;
        padding-left: 20px;
        padding-right: 8px;
        border-radius: 10px;
        background-color: white;
        width: 245px;
      }
      .entradaTexto{
        margin-bottom: 10px;
        width: 200px;
        border-color: green;
        border-style: solid;
      }
      .boton{
        margin-bottom: 30px;
        font-size: 17px;
      }
      .form_boton_cerrar_sesion{
        margin-top:20px;
        padding-left: -5px;
        padding-right: -5px;
      }
      .boton_cerrar_sesion{
        width: 110%;
        margin-left: -19px;
        border-style:hidden;
        border-color:white;
        border-radius: 9px;
        font-size: 15px;
        background-color: white;
      }
      .boton_cerrar_sesion:hover{
        text-shadow: 0.25px 0.25px grey;
      }
    </style>
  </head>

  <body>
    <?php
    if($_SESSION["bienvenida"]==true){
      echo "<script type='text/javascript'>
        alert('INICIASTE SESION');
      </script>";
      $_SESSION["bienvenida"]=false;
    }
    ?>
    <table>
      <tr>
        <td>
          <figure class="logoCouchInn"><img src="CouchInnLogo.png" width="300px" height="100px"/></figure>
        </td>
      </tr>
      <tr>
        <td>
          <form method="post">
            <table>
              <tr>
                <td>
                  <br>Ingrese su nueva contraseña:
                </td>
              </tr>
              <tr>
                <td>
                  <input class="entradaTexto" type="password" name="contraseña" required="true" autofocus="true">
                </td>
              </tr>
              <tr>
                <td>
                  Confirme su nueva contraseña:
                </td>
              </tr>
              <tr>
                <td>
                  <input class="entradaTexto" type="password" name="contraseña_confirmacion" required="true">
                </td>
              </tr>
              <tr>
                <td>
                  <input class="boton" type="submit" name="cambia_contraseña" value="¡Cambiar!">
                </td>
                </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>
    <?php
    if(isset($_POST['cambia_contraseña'])){
      if($_POST['contraseña']==$_POST['contraseña_confirmacion']){
        $contraseña=$_POST['contraseña'];
        $email=$_SESSION['usuario'];
        require("establece_conexion.php");
        establecer_conexion($conexion);
        $sql="UPDATE USUARIOS SET CONTRASEÑA='$contraseña' WHERE EMAIL='$email'";
        $resultado=mysqli_query($conexion,$sql);
        header("location: couchInnIndexSesionIniciada.php");
      } else {
        echo "<script type='text/javascript'>";
          echo "alert('La contraseña y la confirmación no coinciden')";
        echo "</script>";
      }
    }?>
    <form method="post" class="form_boton_cerrar_sesion">
      <input type="submit" name="cerrar_sesion" value="Cancelar" class="boton_cerrar_sesion">
    </form>
    <?php
      if(isset($_POST['cerrar_sesion'])){
        session_destroy();
        header("location: couchInnIndexSesionIniciada.php");
      }
    ?>
  </body>
</html>
