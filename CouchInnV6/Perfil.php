<?php
  require("cabecera_estandar_sesion_iniciada.php");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PerfilEstilo.css">
    <title>Perfil</title>
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <!--<img src="HTML5Logo.png" width="100px" alt="Esto deberia ser una imagen" class="imgPerfil" />-->
        <article>
          <h2>Perfil</h2>
            <ul>
              <li><label for="nombre">Nombre:</label></li>
              <li><label for="apellido">Apellido:</label></li>
              <li><label for="mail">Correo:</label></li>
              <li><label for="fecNac">Fecha de nacimiento:</label></li>
              <li><label for="telefono">Telefono:</label></li>
              <li><label for="preg">Pregunta de seguridad:</label></li>
            </ul>
            <ul class="datos">
              <?php
                //session_start();
                $conexion=mysqli_connect('localhost','root') or die ('No se pudo conectar'.mysql_error());
                mysqli_select_db($conexion,'couchinn') or die('No se pudo selecionar la base de datos'.mysql_error());
                $email=$_SESSION['usuario'];
                $consulta="SELECT * FROM usuarios WHERE EMAIL='$email'";
                $DATOS=mysqli_query($conexion,$consulta);
                if ($DATOS==false) {
                  echo "ERROR";
                }
                $fila=mysqli_fetch_row($DATOS);
                echo ($fila['1']),"<br>";
                echo ($fila['2']),"<br>";
                echo ($fila['4']),"<br>";
                echo ($fila['3']),"<br>";
                echo ($fila['5']),"<br>";
                $equis=$fila['9'];
                $consulta="SELECT TEXTO FROM preguntasdeseguridad WHERE idPREGUNTASDESEGURIDAD='$equis'";
                $DATO=mysqli_query($conexion,$consulta);
                $dato2=mysqli_fetch_row($DATO);
                echo ($dato2['0']);
               ?>
            </ul>
            <a href="PerfilEdit.php">
              <input type="button" name="editar" value="Editar" class="editar">
            </a>
        </article>
      </section>
    </section>
    <footer>

    </footer>
  </body>
</html>
