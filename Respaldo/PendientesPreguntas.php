<?php
  require("cabecera_estandar_sesion_iniciada.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  $email=$_SESSION['usuario'];
  if ($_POST) {
    if (isset($_POST["verTodoR"])) {
      $_SESSION['PendientesVerTodasVF']='Respuestas';
      header("Location: PendientesVerTodas.php");
    } else {
      if (isset($_POST["verTodoP"])) {
        $_SESSION['PendientesVerTodasVF']='Preguntas';
        header("Location: PendientesVerTodas.php");
      }/* else {
        $tf=false;
        foreach($_POST as $kkey => $vvalue) {
          if (substr($kkey,0,3)=="sub") {
            $idH=substr($kkey,4);
            $tf=true;
          }
        }
        if ($tf) {
          $_SESSION['idHosp']=$idH;
          if (substr($kkey,3,1)=="P") {
            echo "<script>cargar(\"$idH\");</script>";
            //header("Location: HospedajePropietario.php");
          }else {
            echo "<script>cargar(\"$idH\");</script>";
            //header("Location: Hospedaje.php");
          }
        }
      }*/
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PendientesR.css">
    <script src="jquery-3.0.0.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#divBotonVolver").hide();
      });
      function cargar(id){
        $("#wrapper1").hide(250);
        $("#contenedor_detalle").show(800).load("detalle_publicacion.php",{ "publicacion":id});
        $("#divBotonVolver").show(800);
      }
      function volver(){
        $("#contenedor_detalle").hide(250);
        $("#divBotonVolver").hide(250);
        $("#wrapper1").show(800);
      }
    </script>
  </head>
  <body>
    <section id="wrapper1" class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <h2 class="titulo">Respuestas pendientes</h2>
        <form class="" action="" method="post">
          <?php
            //$sql="SELECT `idHospedaje` FROM `comentarios` WHERE `Nombre`='$email' AND `Respuesta`!='' AND `Visto`='0'";
            $sql="SELECT `Respuesta`, `Visto`, `idHospedaje` FROM `comentarios` WHERE `Nombre`='$email'";
            $idHosp=mysqli_query($conn,$sql);
            $arregloH=array();
            $arregloHleido=array();
            $arregloT=array();
            $cont=0;
            $cont2=0;
            while ($rowH = mysqli_fetch_row($idHosp)) {
              $idHp=$rowH[2];
              $tf=true;
              $tf2=true;
              foreach ($arregloH as $key => $value) {
                if ($idHp==$value) { //Filtra hospedajes repetidos
                  $tf=false;
                }
              }
              foreach ($arregloHleido as $key => $value) {
                if ($idHp==$value) {
                  $tf2=false;
                }
              }
              $sql="SELECT `TITULO` FROM `publicaciones` WHERE `idPUBLICACIONES`='$idHp'";
              $tituloH=mysqli_query($conn,$sql);
              $rowT = mysqli_fetch_row($tituloH);
              $tituloH=$rowT[0];
              if (($rowH[0]!='') & ($rowH[1]=='0')) {
                if ($tf) {
                  $arregloH[$cont]=$idHp;
                  $cont+=1;
                  echo "<h3 class=\"titulo2\">$tituloH -</h3>";
                  echo "<input type='button' value='Respuesta pendiente' onclick='cargar(".$idHp.")' class=\"texto\">";
                  //echo "<input type=\"submit\" name=\"subN$idHp\" value=\"Respuesta pendiente\" class=\"texto\">";
                  echo "<br>";
                }
              } else {
                if (($tf2) & ($tf)) { //Si todavia no fue escrita
                  $arregloHleido[$cont2]=$idHp;
                  $arregloT[$cont2]=$tituloH;
                  $cont2+=1;
                }
              }
            }
            $cont2=0;
            foreach ($arregloT as $key => $value) {
              $tf2=true;
              $idHp=$arregloHleido[$cont2];
              foreach ($arregloH as $key2 => $value2) {
                if ($value2==$idHp) { //Filtra los q ya aparecen como pendientes
                  $tf2=false;
                }
              }
              if ($tf2) {
                echo "<h3 class=\"titulo2\">$value -</h3>";
                echo "<input type='button' value='No hay respuestas sin leer' onclick='cargar(".$idHp.")' class=\"texto2\">";
                //echo "<input type=\"submit\" name=\"subN$idHp\" value=\"No hay respuestas sin leer\" class=\"texto2\">";
                //echo "<p class=\"texto2\">No hay respuestas sin leer</p>";
                echo "<br>";
              }
              $cont2+=1;
            }
            if (0<count($arregloH)) {
              echo "<input type=\"submit\" name=\"verTodoR\" value=\"Ver todas\" class=\"verTodo\">";
            }/* else {
              echo "<input type=\"submit\" name=\"verTodoR\" value=\"Ver todas\" class=\"verTodo\" disabled=\"\">";
            }*/
          ?>
        </form>
      </section>
      <aside>
        <h2 class="titulo">Preguntas pendientes</h2>
        <form class="" action="" method="post">
          <?php
          $sql="SELECT `idUSUARIOS` FROM `usuarios` WHERE `EMAIL`='$email'";
          $idUsuario=mysqli_query($conn,$sql);
          $rowU = mysqli_fetch_row($idUsuario);
          $idU=$rowU[0];
          $sql="SELECT `idPUBLICACIONES`, `TITULO` FROM `publicaciones` WHERE `idUSUARIOS`='$idU' AND `ACTIVA`='1'";
          $idPublicaciones=mysqli_query($conn,$sql);
          $HsinPreguntas=array();
          $idHsinPreguntas=array();
          $botonAbilitado=false;
          while ($row = mysqli_fetch_row($idPublicaciones)) {
            echo "<div>";
            $id1=$row[0];
            $tituloH=$row[1];
            $sql2="SELECT `Respuesta` FROM `comentarios` WHERE `idHospedaje`='$id1'";
            $resps=mysqli_query($conn,$sql2);
            $tf=true;
            while (($row2 = mysqli_fetch_row($resps)) & ($tf)) {
              if ($row2[0]=='') {
                echo "<h3 class=\"titulo2\">$tituloH -</h3>";
                //echo "<input type=\"submit\" name=\"subP$id1\" value=\"Pregunta pendiente\" class=\"texto\">";
                echo "<input type='button' value='Pregunta pendiente' onclick='cargar(".$id1.")' class=\"texto\">";
                $tf=false;
                $botonAbilitado=true;
              }
            }
            if ($tf) {
              $HsinPreguntas[$cont]=$tituloH;
              $idHsinPreguntas[$cont]=$id1;
            }
            echo "</div>";
          }
          foreach ($idHsinPreguntas as $key => $value) {
            echo "<div>";
            echo "<h3 class=\"titulo2\">$HsinPreguntas[$key] -</h3>";
            //echo "<input type=\"submit\" name=\"subP$value\" value=\"No hay preguntas pendientes\" class=\"texto2\">";
            echo "<input type='button' value='No hay preguntas pendientes' onclick='cargar(".$value.")' class=\"texto2\">";
            echo "</div>";
          }
          if ($botonAbilitado) {
            echo "<input type=\"submit\" name=\"verTodoP\" value=\"Ver todas\" class=\"verTodo\">";
          }
          ?>
        </form>
      </aside>
    </section>
    <div id="contenedor_detalle">

    </div>
    <div class="divBotonVolver" id="divBotonVolver">
      <div class="divBotonVolverFondo">
        <input type="button" name="volver" value="<< Volver" id="botonVolver" onclick='volver()' class="botonVolver">
      </div>
    </div>
  </body>
</html>
