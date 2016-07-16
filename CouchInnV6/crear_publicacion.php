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
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
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
    <script src="jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $.ajax({
          type: "POST",
          data: { "accion":1 },
          url: "get_provincias_ciudades_tiposHospedajes.php",
          success: function(response){
            $('#provincias').html(response).fadeIn();
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
      var crear=true;
      function cargaCiudades(valor,crear) {
        if(crear==true){
          $("#cambia").remove();
          $("#provincias").after("<select id='ciudades' name='ciudad' required='true'></select>");
        }
        var valorC = { "valorCiudad":valor, "accion":2 };
        $.ajax({
          type: "POST",
          data: valorC,
          url: "get_provincias_ciudades_tiposHospedajes.php",
          success: function(response){
            $('#ciudades').html(response).fadeIn();
          }
        });
      }
      function revision_subida() {
        var error = false;

        var titulo = document.getElementById("titulo");
        if(titulo.value.length < 10 || /^\s+$/.test(titulo.value)){
          $("#error_titulo").html("*El titulo debe tener 10 caracteres o mas");
          error = true;
        } else {
          $("#error_titulo").html("");
        }

        var imagenes = document.getElementById("imagenes");
        if(imagenes.value == ""){
          $("#error_fotos").html("*Debe ingresar al menos una foto");
          error = true;
        } else {
          $("#error_fotos").html("");
        }

        var provincia = document.getElementById("provincias");
        var ciudad = null;
        if(provincia.value == 0){
          $("#error_provincias").html("*Debe ingresar una provincia");
          error = true;
        } else {
          $("#error_provincias").html("");
          ciudad = document.getElementById("ciudades").value;
        }

        var hospedaje = document.getElementById("tipos_hospedaje");
        var capacidad = document.getElementById("capacidad");
        if(hospedaje.value == 0){
          $("#error_hospedaje_capacidad").html("*Debe ingresar un tipo de hospedaje");
          error = true;
        } else {
          if(capacidad.value == "" || isNaN(capacidad.value)){
            $("#error_hospedaje_capacidad").html("*Debe ingresar una capacidad valida");
            error = true;
          } else {
            $("#error_hospedaje_capacidad").html("");
          }
        }

        var descripcion = document.getElementById("descripcion");
        if(descripcion.value.length < 20){
          $("#error_descripcion").html("*Debe ingresar una descripcion (20 caracteres minimo)");
          error = true;
        } else {
          $("#error_descripcion").html("");
        }

        if(error == false){
          document.getElementById("formulario").submit();
          window.href.location="ver_publicaciones.php";
        } else {
          return false;
        }
      }
      $(function(){
        $("#imagenes").on("change", function(){
          /* Limpiar vista previa */
          $("#vista-previa").html('');
          var archivos = document.getElementById('imagenes').files;
          var navegador = window.URL || window.webkitURL;
          /* Recorrer los archivos */
          var contador = 1;
          for(x=0; x<archivos.length; x++){
            /* Validar tamaño y tipo de archivo */
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name = archivos[x].name;
            if (size > 2048*2048){
              $("#error_fotos").append("<p style='color: red'>El archivo "+name+" supera el máximo permitido 1MB</p>");
            } else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
              $("#error_fotos").append("<p style='color: red'>El archivo "+name+" no es del tipo de imagen permitida.</p>");
            } else {
              var objeto_url = navegador.createObjectURL(archivos[x]);
              if(contador != 5){
                $("#vista-previa").append("<img src="+objeto_url+" width='125' height='125' class='vista_previa'>");
                contador++;
              } else {
                $("#vista-previa").append("<img src="+objeto_url+" width='125' height='125' class='vista_previa'><br>");
                contador = 1;
              }
            }
          }
        });
      });
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
                    <input type="submit" name="publicar" value="Publicar" id="desabilitado">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="mis_reservas.php" method="post">
                    <input type="submit" name="mis_reservas" value="Mis Reservas" id="submit_opcion_usuario">
                  </form>
                </td>
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
    <div class="contenedor">
      <div class="centrado">
        <form class="formulario" id="formulario" method="post" action="comprobar_crear_publicacion.php" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="return revision_subida();">
          <table>
            <tr>
              <td>
                Agregue un titulo:
                <input type="text" name="titulo" id="titulo" autocomplete="off" autofocus="true">
                <div id="error_titulo" class="error"></div>
              </td>
            </tr>
            <tr>
              <td>
                 <input type="file" name="imagenes[]" id="imagenes" accept="image/jpeg,image/png" multiple="true">
                <!--<input type="file" id="file" name="file[]" accept="image/jpeg,image/png" multiple><br/>-->
                <div id="vista-previa"></div>
                <div id="respuesta"></div>
                <div id="error_fotos" class="error"></div>
              </td>
            </tr>
            <tr>
              <td>
                <select id="provincias" name="provincia" onchange="cargaCiudades(this.value, crear); crear=false;"></select>
                <select id="cambia" disabled="true">
                  <option>---------------------------</option>
                </select>
                <div id="error_provincias" class="error"></div>
              </td>
            </tr>
            <tr>
              <td>
                <select id="tipos_hospedaje" name="tipo_hospedaje"></select>
                para
                <input type="text" id="capacidad" name="capacidad" autocomplete="off">
                personas.
                <div id="error_hospedaje_capacidad" class="error"></div>
              </td>
            </tr>
            <tr>
              <td>
                <textarea id="descripcion" name="descripcion" rows="8" cols="40" maxlength="250" placeholder="Ingrese una descripcion"></textarea>
                <div id="error_descripcion" class="error"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" name="submit" id="submit" value="¡Publicar!">
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </body>
</html>
