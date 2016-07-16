<?php
  session_start();
  if(!isset($_SESSION["usuario"])){   //q pasa cuando no hay nada en $_SESSION
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css">
    <link rel="stylesheet" href="Estilos_publicaciones_index.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos_Detalle_Publicacion_SC.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos_Contenedor_Fixed.css" media="screen" title="no title" charset="utf-8">
    <title>CouchInn</title>
    <style media="screen">
      .estadisticas_busqueda{
        width: 100%;
        height: 18px;
        margin-top: -15px;
        background-color: rgba(33, 150, 243, 0.85);
        text-align: center;
        padding-top: 2px;
        font-family: Arial;
        font-size: 13px;
        color: white;
      }
      #contenedor{
        margin-top: -15px;
      }
    </style>
    <script src="jquery-3.0.0.min.js"></script>
    <script>
      var publicacion_clickeada=0;
      $(document).ready(function(){
        $("#contenedor_fixed").hide();
        $("#volverADetalle").hide();
        $("#estadisticas_busqueda").hide();
        cargar_publicaciones("todas","todas");
        $.ajax({
          type: "POST",
          data: { "accion":1 },
          url: "get_provincias_ciudades_tiposHospedajes.php",
          success: function(response){
            $('#provincias').html(response).fadeIn();
          }
        });
        var valorC="1 OR 'z'='z'";
        $.ajax({
          type: "POST",
          data: { "accion":2, "valorCiudad":valorC, "valorCero":1 },
          url: "get_provincias_ciudades_tiposHospedajes.php",
          success: function(response){
            $('#ciudades').html(response).fadeIn();
          }
        });
        $.ajax({
          type: "POST",
          data: { "accion":3 },
          url: "get_provincias_ciudades_tiposHospedajes.php",
          success: function(response){
            $("#tipos_hospedaje").html(response).fadeIn();
          }
        });
      });
      function cargar_publicaciones(tabla,tupla){
        if(tupla!=0){
          var frase=$("#cuadro_busqueda").val();
          $("#contenedor_publicaciones").hide();
          var inicio=new Date().getMilliseconds();
          var datos = { "tabla":tabla, "tupla":tupla, "busqueda":frase, "inicio":inicio };
          var t = document.getElementById("tipos_hospedaje").value;
          var p = document.getElementById("provincias").value;
          var c = document.getElementById("ciudades").value;
          if(t!=0){ //si se seleccionó un tipo de hospedaje
            if(p!=0 && c==0 || tabla=="PROVINCIAS"){   //si se seleccionó una provincia pero no una ciudad
              datos = { "tabla":"TIPOS_DE_HOSPEDAJES", "tupla":t, "busqueda":frase, "inicio":inicio, "tabla2":"PROVINCIAS", "tupla2":p };
            } else {
              if(c!=0){   //si se seleccionó una ciudad
                datos = { "tabla":"TIPOS_DE_HOSPEDAJES", "tupla":t, "busqueda":frase, "inicio":inicio, "tabla2":"CIUDADES", "tupla2":c };
              }
            }
          }
          $.ajax({
            type: "POST",
            data: datos,
            url: "publicaciones_index.php",
            success: function(response){
              $('#contenedor_publicaciones').html(response).fadeIn();
            }
          }).done(function() {
            estadistica_busqueda($("#inicio").val(),$("#escondido").val());
          });
        }
      }
      function cargar(id){
        //$("#contenedor_fixed").show();
        setTimeout ("$('#estadisticas_busqueda').hide(100)",0);
        $("#contenedor_publicaciones").hide(500);
        $("#filtros_busqueda_borde").hide();
        $("#contenedor_fixed").show(500);
        $("#contenedor_detalle").show(500).load("detalle_publicacion.php",{ "publicacion":id });
      }
      function volver(){
        $("#contenedor_fixed").hide(250);
        $("#contenedor_detalle").hide(250);
        $("#contenedor_publicaciones").show(250);
        $("#filtros_busqueda_borde").show(500);
      }
      function volverADetalle(){
        $("#volverMain").show();
        $("#fixed_reservar").show();
        $("#volverADetalle").hide();
        $("#contenedor_reservar").hide(250);
        $("#contenedor_reservar").empty();
        $("#contenedor_detalle").show(250);
      }
      function buscar(){
        var frase=$("#cuadro_busqueda").val();
        if(frase!=""){
          var inicio = new Date().getMilliseconds();
          var provs=$("#provincias").val();
          var ciuds=$("#ciudades").val();
          var hosps=$("#tipos_hospedaje").val();
          if(provs!=0 || ciuds!=0 || hosps!=0){
            resetearSelects();
          }
          cargar_publicaciones("BUSQUEDA",frase);
          var final = new Date().getMilliseconds();
          estadistica_busqueda(inicio,final);
        } else {
          cargar_publicaciones("todas","todas");  //está para recargar la pagina desde cero sin tener que apretar el logo de CouchInn
        }
      }
      function estadistica_busqueda(inicio,cantResultados){
        var final = new Date().getMilliseconds();
        var tiempo = (final - inicio)/1000;
        $("#estadisticas_busqueda").html("Se encontraron: "+cantResultados+" resultados en: "+tiempo+" segundos.");
        $('#estadisticas_busqueda').show(100);
        setTimeout ("$('#estadisticas_busqueda').hide(100)", 5000);
      }
      function resetearSelects(){
        if($("#cuadro_busqueda").val()!="" || $("#provincias").val()!=0 || $("#ciudades").val()!=0 || $("#tipos_hospedaje").val()!=0){
          $('#tipos_hospedaje option[value=0]').prop('selected', true);
          $('#provincias option[value=0]').prop('selected', true);
          if($("#ciudades").val()!=0 && $("#provincias").val()!=0){
            var valorC="1 OR 'z'='z'";
            $.ajax({
              type: "POST",
              data: { "accion":2, "valorCiudad":valorC, "valorCero":1 },
              url: "get_provincias_ciudades_tiposHospedajes.php",
              success: function(response){
                $('#ciudades').html(response).fadeIn();
              }
            });
          } else {
            $("#ciudades option[value=0]").prop('selected', true);
          }
        }
      }
      function seleccion_provincia(provincia){
        if(provincia!=0){
          $.ajax({
            type: "POST",
            data: { "accion":2, "valorCiudad":provincia, "valorCero":1 },
            url: "get_provincias_ciudades_tiposHospedajes.php",
            success: function(response){
              $('#ciudades').html(response).fadeIn();
            }
          });
        } else {
          var valorC="1 OR 'z'='z'";
          $.ajax({
            type: "POST",
            data: { "accion":2, "valorCiudad":valorC, "valorCero":1 },
            url: "get_provincias_ciudades_tiposHospedajes.php",
            success: function(response){
              $('#ciudades').html(response).fadeIn();
            }
          });
        }
      }
      function quitar_filtros(){
        resetearSelects();
        buscar();
      }
      function reservar(id) {
        var datos={ "id":id };
        $.ajax({
          type: "POST",
          data: datos,
          url: "prepara_reservar.php",
          success:function(response) {
            if(response=="No"){
              $("#volverMain").hide();
              $("#fixed_reservar").hide();
              $("#volverADetalle").show();
              $("#contenedor_detalle").hide(500);
              $("#contenedor_reservar").show(250);
              $("#contenedor_reservar").load("reservar.php");
            } else {
              alert("No podes reservar una publicacion tuya :/");
            }
          }
        });
      }
    </script>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <table id="encabezado">
        <tr>
          <td>
            <figure id=logoCouchInn><a href="couchInnIndexSesionIniciada.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
          </td>
          <td>
            <table id="premium_foto_crearPost">
              <tr>
                <td id="contieneCartel">
                  <?php
                  if($_SESSION["premium"]!=0){
                    echo '¡Premium!';
                  }else{
                    echo '<span id="cartel_premium">¿Todavía no sos PREMIUM?<br><a href="Premiun.php" id="cartel_premium_sub">¡Hacé click aquí!</a></span>';
                  }?>
                <td>
                  <!--<figure id="sectorImagenUsuario"><a href=""><img src="lenny_concentrado.png" height="90px" width="90px" id="imagenPerfil"/></a>
                  <figcaption>--><a href="Perfil.php"><span id="nombreApellido"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?></span></a><!--</figcaption>
                </figure>--><!--CONECTAR CON BD Y TRAER IMAGEN DEL USUARIO-->
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table id="tabla_opciones">
              <tr>
                <td>
                  <form id="opcion_usuario" action="Perfil.php" method="post">
                    <input class="boton1" type="submit" name="mi_perfil" value="Mi Perfil" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="PendientesPreguntas.php" method="post" onclick="this.form.submit()">
                    <input type="submit" name="publicar" value="Pendiente" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="crear_publicacion.php" method="post" onclick="this.form.submit()">
                    <input type="submit" name="publicar" value="Publicar" id="submit_opcion_usuario">
                  </form>
                </td>
        <!--        <td>
                  <form id="opcion_usuario" action="mis_reservas.php" method="post">
                    <input type="submit" name="mis_reservas" value="Mis Reservas" id="submit_opcion_usuario">
                  </form>
                </td> -->
                <td>
                  <form id="opcion_usuario" action="ver_publicaciones.php" method="post">
                    <input type="submit" name="mis_publicaciones" value="Mis Publicaciones" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="mis_solicitudes.php" method="post">
                    <input type="submit" name="mis_solicitudes" value="Mis Solicitudes" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form action="cerrar_sesion.php" id="opcion_usuario" method="post">
                    <input class="boton2" type="submit" name="cerrar_sesion" value="Cerrar Sesion" id="submit_opcion_usuario">
                  </form>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </header>
    <div id="estadisticas_busqueda" class="estadisticas_busqueda"></div>
    <div id="alineador" class="alineador">
      <div id="contenedor_publicaciones"></div>
      <div id="contenedor_detalle"></div>
      <div id="contenedor_reservar"></div>
    </div>
    <div id="filtros_busqueda_borde" class="filtros_busqueda_borde">
      <div id="marco_busqueda" class="marco_busqueda">
        <div id="buscador" class="buscador">
          <input type="type" name="buscar" id="cuadro_busqueda" placeholder="Buscar..." onchange="buscar()">
          <input type="button" name="realizar_busqueda" id="realizar_busqueda" value="Buscar" onclick="buscar()">
        </div>
      </div>
      <div id="filtros_borde_superior" class="filtros_borde_superior">
        <div id="filtros_marco" class="filtros_marco">
          <div id="filtro_provincia" class="filtro_provincia">
            <select id="provincias" class="" name="" oninput="cargar_publicaciones('PROVINCIAS',this.value);seleccion_provincia(this.value);"></select>
            <!--<input type="button" id="filtrar_provincia" name="filtrar_prov" value="Filtrar">-->
          </div>
          <div id="filtro_ciudad" class="">
            <select id="ciudades" class="" name="" oninput="cargar_publicaciones('CIUDADES',this.value)"></select>
            <!--<input type="button" id="filtrar_ciudad" name="filtrar_ciu" value="Filtrar">-->
          </div>
          <div id="filtro_hospedaje" class="filtro_hospedaje">
            <select id="tipos_hospedaje" class="" name="" oninput="cargar_publicaciones('TIPOS_DE_HOSPEDAJES',this.value)"></select>
            <!--<input type="button" id="filtrar_hospedaje" name="filtrar_hosp" value="Filtrar">-->
          </div>
          <div id="reset" class="reset">
            <input type="button" name="name" value="Quitar filtros" onclick="quitar_filtros()">
          </div>
        </div>
      </div>
    </div>
    <div id="contenedor_fixed" class="contenedor_fixed">
      <div class="contiene_opciones_borde">
        <div class="contiene_opciones">
          <div class="opcion_volver" id="volverADetalle" onclick="volverADetalle()">
            << Volver
          </div>
          <div class="opcion_volver" id="volverMain" onclick="volver()">
            << Volver
          </div>
          <div class="opcion_eliminar" id="fixed_reservar" onclick="reservar(publicacion_clickeada)">
            Reservar
          </div>
          <!--<div id="des_pub" class="opcion_despublicar" onclick="accion(this.id,hacer); hacer = !hacer;"></div>
          <div class="opcion_eliminar">
            Eliminar
          </div>-->
        </div>
      </div>
    </div>
  </body>
</html>
