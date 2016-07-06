<?php
  session_start();
  if((!isset($_SESSION["usuario"]))||($_SESSION["usuario"]!="angelica.portacelutti@gmail.com")){
    header("location: index.php");
  } else {
    $_SESSION['pagAnterior']="indexAdmin.php";
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosIndexSesionIniciada.css"charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstiloAdministrador.css" charset="utf-8">
    <title>Página del admin</title>
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
      .tabla{
        position: absolute;
        top: 150px;
        left: 200px;
        text-align: center;
        border-collapse: collapse;
        border-color: lightgreen;
        background-color: white;
        font-size: 20px;
        width: 800px;
        font-style: italic;
      }
      .tabla td{
        padding: 18px;
        background: lightblue;
        width: 20%;
      }
      .tabla th{
        color: blue;
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

      <?php
     $fecha_inicio= date($_GET["primeraFecha"]);
     $fecha_final=date($_GET["segundaFecha"]);
     $link = mysqli_connect('localhost','root')
          or die('No se pudo conectar: ' . mysql_error());
      mysqli_select_db($link,'couchinn') or die('No se pudo seleccionar la base de datos');
      $consul="SELECT * FROM `pagos` WHERE Fecha_de_alta BETWEEN '$fecha_inicio' AND '$fecha_final'";
      $datos=mysqli_query($link,$consul);
      $cant=mysqli_num_rows($datos);
      if($cant==0){
        echo '<script type="text/javascript">
                          alert("No tiene pagos en esas fechas.");
                           window.location="http://localhost/informes_modificar_tarifas.php"
                            </script>';
      }else{
        $sumaT=0;
        ?>
        <table class="tabla" border="3" >
          <tr background="lightgreen">
            <th> Id </th>
              <th> Nombre usuario </th>
                <th> Fecha y hora de pago </th>
                <th> Tarifa </th>
                </tr>
          <?php while($fila=mysqli_fetch_row($datos)){
                    ?>
                    <tr>
                      <td> <?php echo $fila['0']; ?> </td>
                      <td> <?php   $id=$fila['1'];
                      $sql="SELECT u.NOMBRE,u.APELLIDO FROM pagos p INNER JOIN usuarios u ON(p.idUSUARIO = u.idUSUARIOS) WHERE u.idUSUARIOS=$id";
                      $dato=mysqli_query($link,$sql);
                      if($dato==false){
                        echo "Consulta fallida";}
                      else {
                        $p=mysqli_fetch_row($dato);
                        echo $p['0'];echo ' '; echo $p['1'];
                      }  ?> </td>
                      <td> <?php echo $fila['2']; ?> </td>
                      <td> <?php $f= $fila['3']; $sumaT=$sumaT+$f; echo '$',$f;?> </td>
                    </tr>
                    <?php
                  }
                ?>
            <tr>
              <td></td>
              <td></td>
              <td>Suma total:</td>
             <td> <?php echo '$',$sumaT;?> </td>
            </tr>
           </table>
           <?php
}
mysqli_close($link);
?>
<input type="button" class="b" id= "b"name="b" value="Volver pagina anterior" onclick="location.href='informes_modificar_tarifas.php'"
  </body>
</html>
