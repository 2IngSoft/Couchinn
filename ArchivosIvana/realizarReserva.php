<?php
  session_start();
  if(!isset($_SESSION["usuario"])){   //q pasa cuando no hay nada en $_SESSION
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<script type="text/javascript" language="javascript" >
function validarForm(){
     var fecha_i=document.getElementById('fecha_inicio').value;
     var fecha_f=document.getElementById('fecha_final').value;
     valuesStart=fecha_i.split("/");
     valuesEnd=fecha_.split("/");

     var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
      var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
        if(dateStart>=dateEnd)
     {
        alert("La fecha de inicio es mayor que la fecha final");
        fecha_i.focus();
        return false;
    }
    alert("Las fechas son correctas");
    return true;
 }

 window.onload = function() {

  document.getElementById('formu').onsubmit = validarForm;

 }
</script>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
    <style media="screen">
      .vista_previa {
        margin-top: 5px;
        margin-right: 5px;
        border-color: grey;
        border-radius: 10px;
        border-width: 2px;
        border-style: dotted;
      }
      .error{
        color: red;
        font-family: Arial;
      }
      .contenedor {
        text-align: center;
      }
      .centrado {
        display: inline-block;
      }
      .formulario{
        margin-top: 10px;
        background-color: green;
        border-style: dashed;
        border-color: grey;
        border-width: 5px;
        border-radius: 10px;
      }
      .formulario table{
        border-radius: 7px;
        padding: 15px;
        padding-top: 10px;
        background-color: white;
      }
      .formulario table tr td div{
        margin-bottom: 3px;
      }
      #submit{
        margin-top: 5px;
      }
      td{
        font-family: Arial;
      }
      #capacidad{
        width: 50px;
      }
    </style>

  </head>
  <body>
    <header >

    </header>
    <?php   $publicacion=$_POST["publi"]; ?>
    <div class="contenedor">
      <div class="centrado">
        <form class="formulario" id="formu" name="formu" method="get" action="comprobar_realizar_reserva.php" accept-charset="utf-8" >
          <table>
          <tr>
          <td>
          Ingrese las fechas entre las cuales se quiere hospedar en este lugar:
          <br>
          <?php
            $hoy=getdate();
            $año=$hoy['year'] . "<br>";
            $mes=$hoy['mon'];
            $dia=$hoy['mday'];
            if($mes < 10){
              $mes = 0 . $mes;
            }
            if($dia < 10){
              $dia = 0 . $dia;
            }
            $mayorDeEdad=$año-0 . "-" . $mes . "-" . $dia;
          ?>
          <input type="date" name="fecha_inicio" min="<?php echo $mayorDeEdad;?>" id="fecha_inicio" required="true">
          a <input type="date" id="fecha_final" min="<?php echo $mayorDeEdad;?>" name="fecha_final" required="true">
          </td>
          </tr>
          <tr>
          <td>
            <br>
          Ingrese la cantidad de personas que van a ir:
          <select name="capacidad" id="capacidad" required="true">
          <?php

          $link = mysqli_connect('localhost','root')
               or die('No se pudo conectar: ' . mysql_error());
           mysqli_select_db($link,'couchinn') or die('No se pudo seleccionar la base de datos');
           $cant=1;
           $consul="SELECT CAPACIDAD FROM publicaciones WHERE idPUBLICACIONES=$publicacion";
           $datos=mysqli_query($link,$consul);
           if($datos==false)
           {
             echo "ERROR EN CONSULTA";
           }else{
             $cantMax=mysqli_fetch_row($datos);
             while($cant<=$cantMax['0']){
             echo"<option>";
             echo $cant;
             echo "</option>";
             $cant++;
           }
         }
          ?>
        </select>
        </td>
      </tr>
<tr>
              <td>
              <br>
              Ingrese una descripcion que quiera mencionarle al dueño del hospedaje:
              <br>
                <textarea id="descripcion" name="descripcion" rows="8" cols="40" maxlength="250" placeholder="Ingrese una descripcion" required="true"></textarea>
                <div id="error_descripcion" class="error"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" name="submit" id="submit" value="Reservar">
              </td>
            </tr>
            <input type="hidden" ed="idp" name="idp" value="<?php echo $publicacion ?>"><br>
          </table>
        </form>
      </div>
    </div>
  </body>
</html>
