<?php
    if($_POST)
    {
        echo "ENTREEEEE!!!";

        $errors = array();
        $errors[1] = "ACA HAY ALGO";
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
        echo $errors[1];
        //checkeo de errores
        if(count($errors) == 0)
        {
            //exito No hay errores
            session_start();
            $conn = mysqli_connect("localhost", "root",'');
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_select_db($conn,'couchinn') or die('No se pudo selecionar la base de datos'.mysql_error());
            $email=$_SESSION['usuario'];
            $consulta="SELECT * FROM usuarios WHERE EMAIL='$email'";
            $DATOS=mysqli_query($conn,$consulta);
            if ($DATOS==false) {
              echo "ERROR";
            }
            $fila=mysqli_fetch_row($DATOS);
            if(empty($_POST['nombre']))
            {
              //$errors['nombre'] = " *El nombre no puede estar vacio";
              $nom = $fila['1'];
            }else {
              $nom = $_POST['nombre'];
            }
            if(empty($_POST['apellido']))
            {
              $ap = $fila['2'];
            }else {
              $ap = $_POST['apellido'];
            }
            if(empty($_POST['FecNac']))
            {
              $FN = $fila['4'];
            }else {
              $FN = $_POST['FecNac'];
            }
            if(empty($_POST['telefono']))
            {
              $tel = $fila['6'];
            }else {
              $tel = $_POST['telefono'];
            }
            if(empty($_POST['resp']))
            {
              $rta = $fila['8'];
            }else {
              $rta = $_POST['resp'];
            }
            if (empty($_POST['contrasena']))
            {
              $contr = $fila['3'];
            }else {
              $contr = $_POST['contrasena'];
            }
            $nom = 'Ignacio'; //Prueba actualizar un dato
            $sql = "UPDATE `usuarios` SET `NOMBRE` = '$nom',`APELLIDO` = '$ap',`FECHANAC` = '$FN',`CONTRASENIA` = '$contr',`TELEFONO` = '$tel',`RESPUESTASEG` = '$rta' WHERE `usuarios`.`EMAIL`= '$email' ";
            if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
            mysqli_close($conn);
            //header("Location: Perfil.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Perfil</title>
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <!--<img src="Imgs/HTML5Logo.png" width="100px" alt="Esto deberia ser una imagen" class="imgPerfil" />-->
        <article>
          <h2>Perfil</h2>
            <form class="formulario" method="post">
              <ul class="datos">
                <li><label for="nombre">Nombre: <input type="text" placeholder="Ingrese su nombre" maxlength="10" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>"> <?php if(isset($errors['nombre'])) echo $errors['nombre']; ?> </label></li>
                <li><label for="apellido">Apellido: <input type="text" placeholder="Ingrese su apellido" maxlength="10" name="apellido" value="<?php if(isset($_POST['apellido'])) echo $_POST['apellido']; ?>"> <?php if(isset($errors['apellido'])) echo $errors['apellido']; ?> </label></li>
                <li><label for="fecNac">Fecha de nacimiento: <input type="date" placeholder="Ingrese su Fecha de nacimiento" maxlength="10" name="FecNac" value="<?php if(isset($_POST['FecNac'])) echo $_POST['FecNac']; ?>"> <?php if(isset($errors['FecNac'])) echo $errors['FecNac']; ?> </label></li>
                <li><label for="telefono">Telefono: <input type="tel" placeholder="Ingrese su telefono" maxlength="10" name="telefono" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']; ?>"> <?php if(isset($errors['FecNac'])) echo $errors['FecNac']; ?> </label></li>
                <li><label for="contrasena">Contrasena: <input type="password" placeholder="Ingrese su contrasena" maxlength="10" name="contrasena" value="<?php if(isset($_POST['contrasena'])) echo $_POST['contrasena']; ?>"> <?php if(isset($errors['contrasena'])) echo $errors['contrasena']; ?> </label></li>
                <li><label for="contrasena2">Confirmar: <input type="password" placeholder="Confirmar contrasena" maxlength="10" name="contrasena2" value="<?php if(isset($_POST['contrasena2'])) echo $_POST['contrasena2']; ?>"> <?php if(isset($errors['contrasena2'])) echo $errors['contrasena2']; ?> </label></li>
                <li><label for="preg">Pregunta de seguridad:
                  <select>
                    <option value="op1">Nombre de mi mascota</option>
                    <option value="op2">Mi mejor amigo</option>
                    <option value="op3">Mi primera escuela</option>
                  </select> </label></li>
                <li><label for="resp"> Respuesta: <input type="password" placeholder="Respuesta" maxlength="10" name="resp" value="<?php if(isset($_POST['resp'])) echo $_POST['resp']; ?>"> <?php if(isset($errors['resp'])) echo $errors['resp']; ?> </label></li>
              </ul>
              <input type="submit" class="editar" value="Aceptar" />
            </form>
            <a href="Perfil.php">
              <input type="button" name="cancelar" value="Cancelar" class="cancelar">
            </a>
        </article>
      </section>
    </section>
    <footer>

    </footer>
  </body>
</html>
