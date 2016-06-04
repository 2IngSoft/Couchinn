<?php
    if($_POST)
    {
        $errors = array();

        //validacion
        if(empty($_POST['nombre']))
        {
            $errors['nombre'] = " *El nombre no puede estar vacio";
        }
        if(empty($_POST['apellido']))
        {
            $errors['apellido'] = " *El apellido no puede estar vacio";
        }
        if(empty($_POST['FecNac']))
        {
            $errors['FecNac'] = " *La F.N. no puede estar vacia";
        }
        if(empty($_POST['resp']))
        {
            $errors['resp'] = " *La respuesta no puede estar vacia";
        }
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

        //checkeo de errores
        if(count($errors) == 0)
        {
            //exito No hay errores
            $conn = mysqli_connect("localhost", "root");
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            //APELLIDO='$_POST['apellido']', CONTRASENA='$_POST['contrasena']', FECHANAC='$_POST['FecNac']', TELEFONO='$_POST['telefono']', RESPUESTASEG='$_POST['resp']'
            //$sql = "UPDATE couchinn SET NOMBRE='$_POST['nombre']' WHERE EMAIL="asdasd@asdasd";
            //$sql = UPDATE "couchinn" SET NOMBRE='$_POST['nombre']' WHERE EMAIL="asdasd@asdasd";
            $sql = "UPDATE couchinn SET NOMBRE='IGna' WHERE EMAIL=asdasd@asdasd";

            if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
            mysqli_close($conn);

            header("Location: Perfil.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PerfilEstiloEdit.css">
    <link rel="shortcut icon" type="image/x-icon" href="Imgs/icono.ico">
    <title>Perfil</title>
  </head>
  <body>
    <header>
      <div class="logoFondo">
        <a href="index.php">
          <img src="Imgs/CouchInnLogo.jpg" width="300px" alt="Esto deberia ser una imagen" class="logo" />
        </a>
      </div>
      <nav>
        <a href="cerrar_sesion.php">Cerrar sesion</a>
      </nav>
    </header>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <img src="Imgs/HTML5Logo.png" width="100px" alt="Esto deberia ser una imagen" class="imgPerfil" />
        <article>
          <h2>Perfil</h2>
            <form class="formulario" action="" method="post">
              <ul class="datos">
                <li><label for="nombre">Nombre: <input type="text" placeholder="Ingrese su nombre" maxlength="10" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>"> <?php if(isset($errors['nombre'])) echo $errors['nombre']; ?> </label></li>
                <li><label for="apellido">Apellido: <input type="text" placeholder="Ingrese su apellido" maxlength="10" name="apellido" value="<?php if(isset($_POST['apellido'])) echo $_POST['apellido']; ?>"> <?php if(isset($errors['apellido'])) echo $errors['apellido']; ?> </label></li>
                <li><label for="fecNac">Fecha de nacimiento: <input type="date" placeholder="Ingrese su Fecha de nacimiento" maxlength="10" name="FecNac" value="<?php if(isset($_POST['FecNac'])) echo $_POST['FecNac']; ?>"> <?php if(isset($errors['FecNac'])) echo $errors['FecNac']; ?> </label></li>
                <li><label for="telefono">Telefono: <input type="tel" placeholder="Ingrese su telefono" maxlength="10" name="telefono"></label></li>
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
