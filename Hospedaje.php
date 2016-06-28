<?php
  require("couchInnIndexSesionIniciada.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  if ($_POST) {
    //session_start();
    if (!($_POST['comentario']=="")) {
      $email=$_SESSION['usuario'];
      $comen=$_POST['comentario'];
      $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`) VALUES ('$email','$comen')";
      $result=mysqli_query($conn,$ins);
      //header("Location: HospedajePropietario.php");
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
        <h3>Reservar</h3>
      </aside>
    </section>
  </body>
  <footer>
    <h3>Comentarios</h3>
    <form class="formResp" action="" method="post">
      <div class="cajaComs1">
        <?php
          $sql = "SELECT * FROM `comentarios`";
          if ($findcomments=mysqli_query($conn, $sql)) {
            $cont=0;
            while ($row = mysqli_fetch_row($findcomments)) {
              $nom = $row[1];
              $com = $row[2];
              $rta=$row[3];
              $cont+=1;
              echo "* <span class='Rnom'>$nom</span> - $com";
              echo "<br>";
              if (! $rta=="") {
                echo "<span class='Rrespuesta'>-$rta</span>";
              }
              echo "<br>";
            }
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
         ?>
      </div>
      <textarea name="comentario" rows="3" cols="50" maxlength="200" class="cajaComs2"></textarea>
      <input type="submit" name="Coment" value="Publicar" class="Bcomnt">
    </form>
  </footer>
</html>
