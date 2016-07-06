<?php
    header('Content-type: text/html; charset=iso-8859-1') ;
      session_start();
      if((!isset($_SESSION["usuario"]))||($_SESSION["usuario"]!="angelica.portacelutti@gmail.com")){
        header("location: index.php");
      } else {
        $_SESSION['pagAnterior']="indexAdmin.php";
      }
    ?>
<!DOCTYPE html>
<script language="javascript" type="text/javascript">
function justNumbers(e)
{
   var keynum = window.event ? window.event.keyCode : e.which;
   if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

</script>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosCabeceraSesionIniciada.css">
    <link rel="stylesheet" href="Estilos/EstiloAdministrador.css">
    <link rel="stylesheet" href="Estilos/EstilosIndexSesionIniciada.css"charset="utf-8">
    <title>CouchInn</title>
    <style media="screen">
      .Derecha{
        float: right;
        margin-right: 20px;
      }
      .Izquierda{
        font-size: 20px;
        float: left;
        margin-top: 3.4%;
        margin-left: 10%;
      }
    </style>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="indexAdmin.php"><img src="Imagenes/CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <h2 class="Izquierda">!PÁGINA DE ADMINISTRADOR :D!</h2>
      <table id="tabla_opciones" class="Derecha">
        <tr>
          <td>
            <form action="agregarTipoDeHospedaje.php" method="post">
              <input id="submit_opcion_usuario" type="submit" name="editar_tipos_de_hospedajes" value="Editar tipos de hospedajes">
            </form>
          </td>
          <td>
            <form action="informes_modificar_tarifas.php" method="get">
              <input id="submit_opcion_usuario" type="submit" name="submit_opcion_informe" value="Informes y modificaciones">
            </form>
        </td>
          <td>
            <form method="post">
              <input id="submit_opcion_usuario" type="submit" name="cerrar_sesion" value="Cerrar Sesion">
            </form>
            <?php if(isset($_POST["cerrar_sesion"])){session_destroy(); header("location: index.php");} ?>
            </td>
        </tr>
      </table>
</header>

<form action="cambiarTarifa.php" method= "get" class="aside" id="cambiarT">
  Usuarios premiun
  <br>
  <br>
    La tarifa actual es de: $<?php $fp = fopen("\Users\Ivana\Desktop\precio.txt", "r");
                                  $f=fgets($fp);
                                  echo $f;?>
    <br>
    <br>
    <input type="text" class="EstiloImput" name="tarifaNueva" id="tarifaNueva" required="true" onkeypress="return justNumbers(event);" placeholder="Ingrese solo numeros">
    <input type="submit" class="EstiloBoton" value="Cambiar tarifa">
</form>

<form method="get" class="informePremiun" id="informeP" action="premiumInfo.php">
  Informes administrativos:
  <br>
  <br>
  Informe de usuarios premium:
  <br>
  ingrese las fechas de las cuales quiere realizar el informe
  <br>
  <input type=date class="EstiloImput" name="primeraFecha" id="primeraFecha" required="true" placeholder="aaaa/mm/dd">
  a
  <input type=date class="EstiloImput" name="segundaFecha" id="segundaFecha" required="true" placeholder="aaaa/mm/dd">
<br>
<br>
  <input type="submit" class="EstiloBoton" value="Realizar Informe">
</form>
  </body>
  </html>
