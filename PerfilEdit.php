<?php
  require("cabecera_estandar_sesion_iniciada.php");
  //session_start();
  $conn = mysqli_connect("localhost","root","","couchinn");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $email=$_SESSION["usuario"];
  $consulta="SELECT * FROM usuarios WHERE EMAIL='$email'";
  $DATOS=mysqli_query($conn,$consulta);
  if ($DATOS==false) {
    echo "ERROR";
  }else {
    //echo "<h2 class='cartel'>EXITO</h2>";
  }
  $fila=mysqli_fetch_row($DATOS);
  $tf="0";
  $dtprueba=date_create(date("Y-m-d"));
  date_sub($dtprueba,date_interval_create_from_date_string("18 years"));
  $fecha=date_format($dtprueba,"Y-m-d");

  //Metodo POST
  if($_POST)
  {
      if (isset($_POST["perfilenviar"])) {
        $errors = array();
        //validacion
        if(! empty($_POST['nombre']))
        {
          if(strlen($_POST['nombre']) < 4)
          {
              $errors['nombre'] = " *Debe tener al menos 4 caracteres";
          }
        }
        if(! empty($_POST['apellido']))
        {
          if(strlen($_POST['apellido']) < 4)
          {
              $errors['apellido'] = " *Debe tener al menos 4 caracteres";
          }
        }
        if(! empty($_POST['FecNac']))
        {
          if(strlen($_POST['FecNac']) < 6)
          {
              $errors['FecNac'] = " *Debe tener al menos 6 caracteres";
          }
        }
        if(! empty($_POST['telefono']))
        {
          if(strlen($_POST['telefono']) < 7)
          {
              $errors['telefono'] = " *Debe tener al menos 7 caracteres";
          }
        }
        if(! empty($_POST['resp']))
        {
          if(strlen($_POST['resp']) < 4)
          {
              $errors['resp'] = " *Debe tener al menos 4 caracteres";
          }
        }
        if (! empty($_POST['contrasena'])) {
          if(strlen($_POST['contrasena']) < 6)
          {
              $errors['contrasena'] = " *Debe tener al menos 6 caracteres";
          }
          if (($_POST['contrasena'])==($_POST['contrasena2'])) {
              if(strlen($_POST['contrasena2']) < 6){
                  $errors['contrasena2'] = " *Debe tener al menos 6 caracteres";
              }
          }else {
              $errors['contrasena2'] = " *Debe ser igual a la contrasena";
          }
        }
        //checkeo de errores
        if(count($errors) == 0)
        {
            //exito No hay errores
            //$errors['nombre'] = " *El nombre no puede estar vacio";
            $nom = $_POST['nombre'];
            $ap = $_POST['apellido'];
            $FN = $_POST['FecNac'];
            $tel = $_POST['telefono'];
            $rta = $_POST['resp'];
            $contr = $_POST['contrasena'];
            $PdS=$_POST['pregunta_de_seguridad'];
            $idPS="SELECT `idPREGUNTASDESEGURIDAD` FROM `preguntasdeseguridad` WHERE TEXTO='$PdS'";
            $DATO=mysqli_query($conn,$idPS);
            $dato2=mysqli_fetch_row($DATO);
            $PdS=$dato2['0'];
            $sql = "UPDATE `USUARIOS` SET `NOMBRE` = '$nom',`APELLIDO` = '$ap',`FECHANAC` = '$FN',`CONTRASENA` = '$contr',`TELEFONO` = '$tel',`RESPUESTASEG` = '$rta',`idPREGUNTASDESEGURIDAD` = '$PdS' WHERE `usuarios`.`EMAIL`= '$email' ";
            if (mysqli_query($conn, $sql)) {
              $tf="2";
              //echo '<script> alert("EXITO"); </script>';
              //header("Location: Perfil.php");
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
        }else {
          $tf="1";
        }
      }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PerfilEstiloEdit.css">
    <title>Perfil</title>
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <div class="alertOK" hidden id="alOK">
          <h2>Modificaciones realizadas con exito</h2>
        </div>
        <div class="alertERROR" hidden id="alErr">
          <h2>Error</h2>
        </div>
        <script type="text/javascript">
          function Alerta(tf){
            if (tf=="2") {
              document.getElementById("alOK").removeAttribute("hidden");
            } else {
              document.getElementById("alErr").removeAttribute("hidden");
            }
          }
          //function Ocultar(){
          //  document.getElementById("alOK").setAttribute("hidden");
          //}
        </script>
        <article>
          <h2 id="test">Perfil</h2>
            <form class="formulario" method="post">
              <ul class="datos">
                <li><label for="nombre">Nombre: <input type="text" placeholder="Ingrese su nombre" maxlength="10" name="nombre" value="<?php if (isset($_POST['nombre'])) {echo $_POST['nombre'];} else {echo $fila[1];} ?>"> <?php if(isset($errors['nombre'])) echo $errors['nombre']; ?> </label></li>
                <li><label for="apellido">Apellido: <input type="text" placeholder="Ingrese su apellido" maxlength="10" name="apellido" value="<?php if (isset($_POST['apellido'])) {echo $_POST['apellido'];} else {echo $fila[2];} ?>"> <?php if(isset($errors['apellido'])) echo $errors['apellido']; ?> </label></li>
                <li><label for="fecNac">Fecha de nacimiento: <input type="date" placeholder="Año-Mes-Dia" maxlength="10" name="FecNac" value="<?php if (isset($_POST['FecNac'])) {echo $_POST['FecNac'];} else {echo $fila[3];} ?>" min="1900-01-01" max='<?php echo "$fecha"; ?>'> <?php if(isset($errors['FecNac'])) echo $errors['FecNac']; ?> </label></li>
                <li><label for="telefono">Telefono: <input type="tel" placeholder="Ingrese su telefono" maxlength="10" name="telefono" value="<?php if (isset($_POST['telefono'])) {echo $_POST['telefono'];} else {echo $fila[5];} ?>"> <?php if(isset($errors['telefono'])) echo $errors['telefono']; ?> </label></li>
                <li><label for="contrasena">Contrasena: <input type="password" placeholder="Ingrese su contrasena" maxlength="10" name="contrasena" value="<?php if (isset($_POST['contrasena'])) {echo $_POST['contrasena'];} else {echo $fila[6];} ?>"> <?php if(isset($errors['contrasena'])) echo $errors['contrasena']; ?> </label></li>
                <li><label for="contrasena2">Confirmar: <input type="password" placeholder="Confirmar contrasena" maxlength="10" name="contrasena2" value="<?php if (isset($_POST['contrasena2'])) {echo $_POST['contrasena2'];} else {echo $fila[6];} ?>"> <?php if(isset($errors['contrasena2'])) echo $errors['contrasena2']; ?> </label></li>
                <li><label for="preg">Pregunta de seguridad:
                  <?php
                    $sql="SELECT * FROM `preguntasdeseguridad`";
                    $resultado=mysqli_query($conn,$sql);
                    echo "<select name='pregunta_de_seguridad' required='true'>";
                    while ($fila2=mysqli_fetch_row($resultado)) {
                      echo "<option>";
                      echo $fila2[1] . "</option>";
                    }
                    echo "</select>";
                  ?>
                </label></li>
                <li><label for="resp"> Respuesta: <input type="password" placeholder="Respuesta" maxlength="10" name="resp" value="<?php if (isset($_POST['resp'])) {echo $_POST['resp'];} else {echo $fila[7];} ?>"> <?php if(isset($errors['resp'])) echo $errors['resp']; ?> </label></li>
              </ul>
              <input type="submit" class="editar" value="Enviar" name="perfilenviar"/>
              <?php
                if ($tf>"0") {
                  if ($tf=="2") {
                    echo '<script> Alerta("2"); </script>';
                  }else {
                    echo '<script> Alerta("1"); </script>';
                  }
                  //sleep(1);
                  //echo '<script> Ocultar(); </script>';
                  mysqli_close($conn);
                }
               ?>
            </form>
        </article>
        <!--<a href="Perfil.php">
          <input type="button" name="volver" value="Volver" class="volver">
        </a>-->
      </section>
    </section>
    <footer>

    </footer>
  </body>
</html>
