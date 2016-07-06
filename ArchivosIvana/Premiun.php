<!DOCTYPE html>

<script language="javascript" type="text/javascript">
function justNumbers(e)
{
   var keynum = window.event ? window.event.keyCode : e.which;
   if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

function validarForm(){
     var num=document.getElementById("numTarjeta");
     var mes=new Date(document.getElementById('fecha'));
     if(num.value.length!=16)
     {
        alert("El numero de tarjeta es invalido");
        num.focus();
        return false;
     }
       return true;

}
 window.onload = function() {

 	document.getElementById('pp').onsubmit = validarForm;

 }
</script>
<html>
  <head>
<meta utf-8>
    <link rel="stylesheet" type="text/css" href="Estilos/EstiloPremin.css">
    <title>CouchInn</title>
</head>

  <body>
    <div class="centrarTabla">
    <table>
      <tr>
        <td>
          <figure class="logoCouchInn"><img src="Imagenes/CouchInnLogo.png" width="300px" height="100px"/></figure>
        </td>
      </tr>
      <tr>
        <td>
          <form method="post" action="controlDatosPremiun.php" name="pp" id="pp">
            <table class="datos" >
                <tr>
                  <td>
                    Siendo un usuario premiun , usted podra mostrar las fotos de sus publicaciones
                    <br>
                    en la pagina principal! Asi, podra llamar la atencion de los usuarios que
                    quieran realizar reservas :D
                    <br>
                    <br>Para ser un usuario premiun, simplemente se solicita un UNICO pago de
                    $30.
                  </td>
                  <td >
                      Realizar pago:
                  <br>
                  <br>Ingrese su numero de tarjeta:
                  <br><input class="entradaTexto" type="text" name="numTarjeta" onkeypress="return justNumbers(event);" placeholder="Solo numeros" id="numTarjeta" required="true">
                  <br>
                  <br> Ingrese la fecha de vencimiento de su tarjeta:
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
                    <input type="date" name="fecha" id="fecha" min="<?php echo $mayorDeEdad;?>" required="true">
                  <br>
                  <br> Ingrese su codigo de seguridad:
                  <br><input type="password" class="entradaTexto" name="contraseña" required="true">
                 <br>
                  <br><input class="boton" type="submit" name="premiun" value="Hazte premiun!">
                </td>
                </tr>
            </table>
          </td>
        </tr>
          </form>
    </table>
    <form method="post" class="centrarTabla" action="couchInnIndexSesionIniciada.php">
      <input type="submit" name="cancelar"  value="Cancelar" class="boton_cerrar_sesion">
    </form>
  </div>
  </body>
</html>
