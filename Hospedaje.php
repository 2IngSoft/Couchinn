<?php
  require("PerfilHeader.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  if ($_POST) {
    //session_start();
    $email=$_SESSION['usuario'];
    $comen=$_POST['comentario'];
    $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`) VALUES ('$email','$comen')";
    if ($result=mysqli_query($conn,$ins)) {
      header("Location: Hospedaje.php");
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HospedajeEstilo.css">
    <link rel="shortcut icon" type="image/x-icon" href="Imgs/icono.ico">
    <title>Hospedaje</title>
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <article>
          <h2>Hospedaje</h2>

        </article>
      </section>
      <aside>
        <h3>Comentarios</h3>
        <textarea name="name" rows="8" cols="40" disabled="true" class="cajaComs1"><?php
            $sql = "SELECT * FROM `comentarios`";
            if ($findcomments=mysqli_query($conn, $sql)) {
              while ($row = mysqli_fetch_row($findcomments)) {
                $nom = $row[1];
                $com = $row[2];
                echo "* $nom - $com";
                echo "\n";
              }
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
           ?></textarea>
        <form class="" action="" method="post">
          <textarea name="comentario" rows="3" cols="50" maxlength="200" class="cajaComs2"></textarea>
          <input type="submit" name="submit" value="Comentar" class="Bcomnt">
        </form>
      </aside>
    </section>
  </body>
</html>
