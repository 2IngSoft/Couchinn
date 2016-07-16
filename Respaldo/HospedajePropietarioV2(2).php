<?php
  $conn = mysqli_connect("localhost","root","","couchinn");
  $idHospedaje=$_POST["publicacion"]; //Variable Global
  if (! isset($_POST['idComent'])) {
    $_POST['idComent']='Vacio';
  }

          $sql = "SELECT * FROM `comentarios` WHERE `idHospedaje` = '$idHospedaje'";
          if ($findcomments=mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($findcomments)) {
              $id = $row[0];
              $nom = $row[1];
              $com = $row[2];
              $rta=$row[3];
              echo "<p>* <span class='Rnom'>$nom</span> - $com</p>";
              //echo "<br>";
              if ($rta=="") {
                if ($_POST['idComent']==$id) {
                  echo "<form onsubmit=\"return responder()\">";
                  echo "<div><textarea id=\"respuesta\" rows=\"3\" cols=\"50\" maxlength=\"200\" class=\"cajaComs2\"></textarea>";
                  echo "<input type='hidden' id=\"botonResp\" value=\"$id\">";
                  echo "<input type=\"submit\" name=\"bot\" value=\"Responder\" class=\"Bcomnt\"></div>";
                  echo "</form>";
                } else {
                  echo "<input type='button' value='Responder' onclick='cargaHospProp(".$id.")' class='Rresponder'>";
                }
              }else {
                echo "<p class='Rrespuesta'>-$rta</p>";
              }
              //echo "<br>";
            }
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
?>
