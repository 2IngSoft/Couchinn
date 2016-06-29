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
        float: left;
        font-size: 20px;
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
<aside>
    <p id= "encapsulador2"> Tipos de Hospedajes: </p>
    <div id= "opciones">
      <?php
      $link = mysqli_connect('localhost','root')
          or die('No se pudo conectar: ' . mysql_error());
      mysqli_select_db($link,'couchinn') or die('No se pudo seleccionar la base de datos');
      $consul="SELECT * FROM tipos_de_hospedajes";
      $datos=mysqli_query($link,$consul);
      if($datos==false){
        echo "CONSULTA FALLIDA";
    }

      while($fila=mysqli_fetch_row($datos)){
        echo ($fila['1']);
        echo"<br>";
        echo "<br>";}
      mysqli_close($link);   ?>
       </div>
  <form action="insertarTipo.php" method="get" id="opciones" name="pepe">
       <input class="EstiloImput" type="text" name="tipoNuevo" id="tipoNuevo" placeholder="Ingrese un nuevo tipo">
       <input class="EstiloBoton" type="submit" name="agregar" value="Agregar"><a i></a>
  </form>
  <br>
  <br>
  <form action=" eliminar.php"  method ="get" >
      <input class="EstiloImput" type= "text" name="tipoaEliminar" placeholder="Ingrese el tipo a eliminar">
      <input class="EstiloBoton"  type="submit" name="eliminar" value="Eliminar"><a i></a>
  <br>
  <br>
</form>
  <form action="modificar.php" method = "get" id="Modificacion">
     <input class="EstiloImput" size="30" type="text" name="tipoAModificar" id="tipoAModificar" placeholder="Ingrese el tipo que quiere modificar">
     <br>
     <br>
     <input class="EstiloImput" type="text" name="tipoNuevo" placeholder="Ingrese el nuevo tipo">
     <input class="EstiloBoton" type="submit" name="modificar" value="Modificar">
   </form>
</aside>
  </body>
  </html>
