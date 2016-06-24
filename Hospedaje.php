<?php
  if ($_POST) {
    session_start();
    $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`) VALUES ('usuarioX','$_POST['comentario']')";
    $result=mysqli_query($conn,$ins);
    header("Location: Hospedaje.php");
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HospedajeEstilo.css">
    <link rel="shortcut icon" type="image/x-icon" href="Imgs/icono.ico">
    <title>Perfil</title>
  </head>
  <body>
    <header>
      <div class="logoFondo">
        <a href="index.php">
          <img src="CouchInnLogo.png" width="300px" alt="Esto deberia ser una imagen" class="logo" />
        </a>
      </div>
      <nav>
        <a href="cerrar_sesion.php">Cerrar sesion</a>
      </nav>
    </header>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <article>
          <h2>Hospedaje</h2>
          <?php
            $conn = mysqli_connect("localhost","root","","couchinn");
            $sql = "SELECT * FROM `comentarios`";
            $findcomments = mysqli_query($conn,$sql);
            while ($row = mysql_fetch_assoc($findcomments)) {
              $nom = $row['Nombre'];
              $com = $row['Comentario'];
              echo "$nom - $com";
            }
           ?>
          <form class="" action="" method="post">
            <textarea name="comentario" rows="3" cols="50" maxlength="200"></textarea>
            <input type="submit" name="submit" value="Comentar">
          </form>
        </article>
      </section>
      <aside>
        <h3>SideBar</h3>
      </aside>
    </section>
  </body>
</html>
