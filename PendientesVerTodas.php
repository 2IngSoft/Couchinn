<?php
  require("cabecera_estandar_sesion_iniciada.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  $email=$_SESSION['usuario'];
  if (! isset($_SESSION['idComent'])) {
    $_SESSION['idComent']='Vacio';
  }
  if ($_POST) {
    if (isset($_POST["Coment"])) {
      if (!($_POST['comentario']=="")) {
        $kkey=$_SESSION['idComent'];
        $NumComent=substr($kkey,3);
        $comen=$_POST['comentario'];
        $ins = "UPDATE `comentarios` SET `Respuesta` = '$comen' WHERE `comentarios`.`ID` = '$NumComent' ";
        $result=mysqli_query($conn,$ins);
      }
    } else {
      foreach($_POST as $kkey => $vvalue) {
        if (substr($kkey,0,3)=="sub") { //checkea si se apreto un responder
          $_SESSION['idComent']=$kkey;
        }
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PendientesVerTodasEstilo.css">
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <?php
          if ($_SESSION['PendientesVerTodasVF']=='Respuestas') {
            echo "<h3 class=\"titulo\">Preguntas respondidas</h3>";
            $sql="SELECT `Comentario`, `Respuesta`, `idHospedaje` FROM `comentarios` WHERE `Visto`='0' AND `Nombre`='$email' AND `Respuesta`!=''";
            $respondidas=mysqli_query($conn,$sql);
            $repetidas=array();
            $cont=0;
            while ($rowCopia = mysqli_fetch_row($respondidas)) {
              $tf=true;
              foreach ($repetidas as $key => $value) {
                if ($value==$rowCopia[2]) {
                  $tf=false;
                }
              }
              if ($tf) {
                $repetidas[$cont]=$rowCopia[2];
                $cont+=1;
                $idHosp=$rowCopia[2];
                $sql2="SELECT `TITULO` FROM `publicaciones` WHERE `idPUBLICACIONES`='$idHosp'";
                $idHs=mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_row($idHs);
                echo "<h4 class=\"titulo2\">$row2[0]</h4>";
                $respondidas2=mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_row($respondidas2)) {
                  if ($row[2]==$rowCopia[2]) {
                    echo "<p class=\"pregunta\"><span class=\"nombre\">Mi pregunta:</span> $row[0]</p>";
                    echo "<p class=\"rta\">-$row[1]</p>";
                  }
                }
              }
            }
            $sql="UPDATE `comentarios` SET `Visto`='1' WHERE `Nombre`='$email' AND `Respuesta`!=''";
            mysqli_query($conn,$sql);
          } else {
            if ($_SESSION['PendientesVerTodasVF']=='Preguntas') {
              echo "<h3 class=\"titulo\">Preguntas por responder</h3>";
              echo "<form class=\"formulario\" action=\"\" method=\"post\">";
              $sql="SELECT `idUSUARIOS` FROM `usuarios` WHERE `EMAIL`='$email'";
              $idUsr=mysqli_query($conn,$sql);
              $row = mysqli_fetch_row($idUsr);
              $usr=$row[0];
              $sql2="SELECT `idPUBLICACIONES`, `TITULO` FROM `publicaciones` WHERE `idUSUARIOS`='$usr'";
              $idHs=mysqli_query($conn,$sql2);
              while ($row2 = mysqli_fetch_row($idHs)) {
                $idHospedaje=$row2[0];
                $sql="SELECT `ID`, `Nombre`, `Comentario` FROM `comentarios` WHERE `Respuesta`='' AND `idHospedaje`='$idHospedaje'";
                $responder=mysqli_query($conn,$sql);
                if (0<mysqli_num_rows($responder)) {
                  echo "<h4 class=\"titulo2\">$row2[1]</h4>";
                  while ($row = mysqli_fetch_row($responder)) {
                    echo "<p class=\"pregunta\"><span class=\"nombre\">$row[1]:</span> $row[2]</p>";
                    $kkey=$_SESSION['idComent'];
                    if ((substr($kkey,0,3)=="sub") & (substr($kkey,3)=="$row[0]")) {
                      $vvalue=substr($kkey,3);
                      echo "<div><textarea name=\"comentario\" rows=\"3\" cols=\"50\" maxlength=\"200\" class=\"cajaComs\"></textarea>";
                      echo "<input type=\"submit\" name=\"Coment\" value=\"Publicar\" class=\"Bcomnt\"></div>";
                      $_SESSION['idComent']="IdC$vvalue";
                    } else {
                      echo "<span class=\"rta2\">-<input type='submit' name=\"sub$row[0]\" value=\"Responder\" class='Bresponder'></span>";
                    }

                  }
                }
              }
              echo "</form>";
            }
          }
         ?>
      </section>
    </section>
  </body>
</html>
