<?php
  session_start();
  if(!isset($_SESSION["usuario"])){
    header("location index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos_calendario.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="EstilosReservar.css" media="screen" title="no title" charset="utf-8">
    <title>CouchInn</title>
    <script src="jquery-3.0.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var fecha = new Date();
        //cargarDiasReservados(fecha.getMonth(),fecha.getFullYear());
        cargarCalendario(fecha);
        var diasSemana=["Dom","Lun","Mar","Mie","Jue","Vie","Sab"];
        for (var i = 0; i < diasSemana.length; i++) {
          $("#semana").append("<div class='diaSemana'>"+diasSemana[i]+"</div>");
        }
        $("#flechaI").css("color","silver");
        $("#guardaFecha").append("<input id='fecha' type='hidden' value='"+fecha+"'>");
      });
      function cargarDiasReservados(mes,anio) {
        var datos={ "mes":mes+1, "anio":anio };
        $.ajax({
          type: "POST",
          data: datos,
          url: "carga_dias_reservados.php",
          success: function(response){
            $('#fechas_reservadas').html(response).fadeIn();
            var reservas = document.getElementsByClassName("dataFechas");
            for (var i = 0; i < reservas.length; i++) {
              $("#"+reservas[i].value).hide();
              $("#"+reservas[i].value+"_reservado").addClass("nroDia");
              $("#"+reservas[i].value+"_reservado").html(reservas[i].value);
              $("#"+reservas[i].value+"_reservado").css("color","red");
            }
          }
        });
      }
      function cargarCalendario(fecha) {
        $("#dias").empty();
        var mes = fecha.getMonth();
        var semana = fecha.getDay();
        var divMes = $("#mes_año");
        var cantDiasAnterior = cant_ds(mes,fecha.getFullYear());
        var cantDias = cant_ds(mes+1,fecha.getFullYear());
        var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        var ultimosDosDigitos=fecha.getFullYear()%100;
        divMes.html("<span id='mes' class='mes' onclick='eventoMes(1)'>"+meses[mes]+"</span><select id='mesSelect' class='mes' onchange='chequear_limite_solicitud(true);eventoMes(2);'></select> <span id='cambiaAño' class='anio' onclick='eventoAnio()'>20"+ultimosDosDigitos+"</span>");
        $("#mesSelect").hide();
        for (var i = 0; i < meses.length; i++) {
          if(i!=mes){
            $("#mesSelect").append("<option value='"+i+"'>"+meses[i]+"</option>");
          }else{
            $("#mesSelect").append("<option value='"+i+"' selected>"+meses[i]+"</option>");
          }
        }
        //divMes.html("<span id='mes' class='mes' onclick='eventoMes()'>"+meses[mes]+"</span> <span id='anio' class='anio'>"+fecha.getFullYear()+"</span>");
        document.getElementById("añoEscondido").value=fecha.getFullYear();
        document.getElementById("mesEscondido").value=mes;
        var fechaAux = fecha;
        fechaAux.setDate(1);
        var finalMesAnterior=cantDiasAnterior-fechaAux.getDay()+1;
        var dias = $("#dias");
        var cantElementos = 0;
        for (var i = 1; i <= fechaAux.getDay(); i++) {
          dias.append("<div id='-"+finalMesAnterior+"' class='nroDiaDespues' onclick='seleccionar(this.id)'>"+finalMesAnterior+"</div>");
          finalMesAnterior++;
          cantElementos++;
        }
        for (var i = 1; i <= cantDias; i++) {
          dias.append("<div id='"+i+"' class='nroDia' onclick='seleccionar(this.id)'>"+i+"</div><div id='"+i+"_reservado'></div>");
          if(!hacer(i)){
            $("#"+i).css("color","red");
          }
          cantElementos++;
        }
        var diasInicio = 1;
        while(cantElementos!=42){
          dias.append("<div id='-"+diasInicio+"' class='nroDiaDespues' onclick='seleccionar(this.id)'>"+diasInicio+"</div>");
          diasInicio++;
          cantElementos++;
        }
        marcarDiasSeleccionados();

        cargarDiasReservados(fecha.getMonth(),fecha.getFullYear());
      }
      function cant_ds(mes,año){
        di=28;
        f = new Date(año,mes-1,di);
        while(f.getMonth()==mes-1){
          di++;
          f = new Date(año,mes-1,di);
        }
        return di-1;
      }
      function incDecCalendario(accion){
        var hoy = new Date();
        var fechaAux = new Date();
        var mesActual = document.getElementById("mesEscondido");
        var añoActual = document.getElementById("añoEscondido");
        if(accion=="-1"){
          var hacer = true;
          if(mesActual.value==hoy.getMonth() && añoActual.value==hoy.getFullYear()){
            hacer = false;
          }
          if(hacer){
            if(mesActual.value!=0){
              mesActual.value--;
            } else {
              añoActual.value--;
              mesActual.value=11;
            }
          }
          if(mesActual.value > hoy.getMonth() && añoActual.value >= hoy.getFullYear()){
            $("#flechaI").css("color","white");
          } else {
            if(mesActual.value < hoy.getMonth() && añoActual.value >= hoy.getFullYear()){
              $("#flechaI").css("color","white");
            } else {
              $("#flechaI").css("color","silver");
            }
          }
        } else {
          if(mesActual.value==11){
            añoActual.value++;
            mesActual=0;
          } else {
            mesActual.value++;
          }
          $("#flechaI").css("color","white");
        }
        fechaAux.setMonth(mesActual.value);
        fechaAux.setFullYear(añoActual.value);
        cargarCalendario(fechaAux);
      }
      function marcarDiasSeleccionados() {
        if($("#fechaInicio").val()!=0){
          var fechaInicio = new Date($("#fechaInicio").val());
          var fechaAux = new Date();
          fechaAux.setMonth($("#mesEscondido").val());
          fechaAux.setFullYear($("#añoEscondido").val());
          if (fechaInicio.getFullYear()==fechaAux.getFullYear() && fechaInicio.getMonth()==fechaAux.getMonth()) {
            $("#"+fechaInicio.getDate()).css("background-color","blue");
          }
          if($("#fechaFin").val()!=0){
            var fechaFin = new Date($("#fechaFin").val());
            if (fechaFin.getFullYear()==fechaAux.getFullYear() && fechaFin.getMonth()==fechaAux.getMonth()) {
              $("#"+fechaFin.getDate()).css("background-color","red");
            }
          }
        }
      }
      function hacer(dia) {
        var fechaAux = new Date();
        var ok = false;
        if(dia>=fechaAux.getDate()){
          ok = true;
        } else {
          if(fechaAux.getMonth() < $("#mesEscondido").val()){
            ok = true;
          } else {
            if(fechaAux.getFullYear() < $("#añoEscondido").val()){
              ok = true;
            }
          }
        }
        return ok;
      }
      function seleccionar(id){
        $("#muestraError").html("");
        if(id>0){
          var valor = $("#diaFin").val();
          var fechaAux = new Date();
          if(hacer(id)){
            if($("#diaInicio").val()==id){
              document.getElementById("diaInicio").value=0;
              document.getElementById("diaFin").value=0;
              document.getElementById("fechaInicio").value=0;
              document.getElementById("fechaFin").value=0;
              $("#muestraInicio").empty();
              $("#muestraInicio").html("Desde el día: ");
              $("#muestraFin").empty();
              $("#muestraFin").html("Hasta el día: ");
              $("#"+id).css("background-color","transparent");
              $("#"+valor).css("background-color","transparent");
              document.getElementById("estado_seleccion_escondido").value=true;
            } else {
              fechaAux.setDate(id);
              fechaAux.setMonth($("#mesEscondido").val());
              fechaAux.setFullYear($("#añoEscondido").val());
              if($("#diaInicio").val()==0){
                document.getElementById("diaInicio").value=id;
                document.getElementById("fechaInicio").value=fechaAux;
                $("#muestraInicio").append(imprimeDiaSemanaEsp(fechaAux.getDay())+", "+fechaAux.getDate()+"/"+imprimeMesEsp(fechaAux.getMonth())+"/"+fechaAux.getFullYear());
              } else {
                if($("#diaFin").val()!=0 && $("#diaFin").val()!=id){
                  $("#"+valor).css("background-color","transparent");
                }
                document.getElementById("diaFin").value=id;
                document.getElementById("fechaFin").value=fechaAux;
                $("#muestraFin").empty();
                $("#muestraFin").html("Hasta el día: ");
                $("#muestraFin").append(imprimeDiaSemanaEsp(fechaAux.getDay())+", "+fechaAux.getDate()+"/"+imprimeMesEsp(fechaAux.getMonth())+"/"+fechaAux.getFullYear());
                var fechaInicial = new Date($("#fechaInicio").val());
                if(fechaInicial>=fechaAux){
                  /*$("#"+fechaInicial.getDate()).css("background-color","transparent");  //<-----DESDE ACÁ FUNCIONA
                  document.getElementById("diaInicio").value=id;
                  document.getElementById("fechaInicio").value=fechaAux;
                  document.getElementById("diaFin").value=0;
                  document.getElementById("fechaFin").value=0;
                  $("#muestraFin").html("");*/  //<------HASTA ACÁ FUNCIONA   ELIMINA LA FECHA FINAL Y CAMBIA LA INICIAL
                  document.getElementById("diaFin").value=$("#diaInicio").val();
                  document.getElementById("diaInicio").value=id;
                  $("#"+fechaInicial.getDate()).css("background-color","transparent");
                  document.getElementById("fechaInicio").value=fechaAux;
                  document.getElementById("fechaFin").value=fechaInicial;
                  $("#muestraInicio").empty();
                  $("#muestraInicio").html("Desde el día: ");
                  $("#muestraFin").empty();
                  $("#muestraFin").html("Hasta el día: ");
                  $("#muestraInicio").append(imprimeDiaSemanaEsp(fechaAux.getDay())+", "+fechaAux.getDate()+"/"+imprimeMesEsp(fechaAux.getMonth())+"/"+fechaAux.getFullYear());
                  $("#muestraFin").append(imprimeDiaSemanaEsp(fechaInicial.getDay())+", "+fechaInicial.getDate()+"/"+imprimeMesEsp(fechaInicial.getMonth())+"/"+fechaInicial.getFullYear());
                }
                chequear_limite_solicitud(false);
              }
            }
            marcarDiasSeleccionados();
          } else {
            //$("#muestraError").html("NO DEBE SELECCIONAR UN DIA ANTERIOR A HOY...");
          }
        } else {
          if(id>=-12){
            incDecCalendario("+1");
          } else {
            incDecCalendario("-1");
          }
        }
      }
      function imprimeDiaSemanaEsp(semana){
        var diasSemana=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        return diasSemana[semana];
      }
      function imprimeMesEsp(mes){
        var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        return meses[mes];
      }
      function eventoMes(accion) {
        if(accion==1){
          $("#mes").hide();
          $("#mesSelect").show();
          for (var i = 0; i < meses.length; i++) {
            if(i!=mes){
              $("#mes").append("<option value='"+i+"'>"+meses[i]+"</option>");
            }else{
              $("#mes").append("<option value='"+i+"' selected>"+meses[i]+"</option>");
            }
          }
        } else {
          var mesActual = $("#mesEscondido").val();
          var fechaAux = new Date();
          if($("#mesSelect").val()>=fechaAux.getMonth()){
            fechaAux.setMonth($("#mesSelect").val());
            fechaAux.setFullYear(document.getElementById("añoEscondido").value);
            cargarCalendario(fechaAux);
          } else {
            var añoActual = $("#añoEscondido").val();
            if(añoActual>fechaAux.getFullYear()){
              fechaAux.setMonth($("#mesSelect").val());
              fechaAux.setFullYear(document.getElementById("añoEscondido").value);
              cargarCalendario(fechaAux);
            }
          }
          /*var valor = $("#mesSelect").val();
          document.getElementById("mes").value = valor;
          var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
          $("#mes").html(meses[valor]);
          $("#mesSelect").hide();
          var fecha = new Date();
          fecha.setMonth(valor);
          fecha.setFullYear(document.getElementById("año").value);
          $("#mes").show();
          actualizaCalendario(fecha);*/
        }
      }
      function eventoAnio(){
        //$("#cambiaAño").html("20<input type='text' id='ingresaDigitos' maxlength='2' size='1' onchange='comprobar_año()'>");
      }
      function quitar_fechas() {
        var actual = new Date();
        actual.setMonth($("#mesEscondido").val());
        actual.setFullYear($("#añoEscondido").val());
        document.getElementById("añoEscondido").value=0;
        document.getElementById("mesEscondido").value=0;
        document.getElementById("diaInicio").value=0;
        document.getElementById("fechaInicio").value=0;
        document.getElementById("diaFin").value=0;
        document.getElementById("fechaFin").value=0;
        $("#muestraInicio").empty();
        $("#muestraInicio").html("Desde el día: ");
        $("#muestraFin").empty();
        $("#muestraFin").html("Hasta el día: ");
        cargarCalendario(actual);
      }
      function comprobar() {
        var estado = document.getElementById("estado_seleccion_escondido").value;
        if(estado=="true"){
          $("#muestraInicio").removeClass("bordeError");
          $("#muestraFin").removeClass("bordeError");
          $("#comentario").removeClass("bordeError");
          var inicio = $("#fechaInicio").val();
          var fin = $("#fechaFin").val();
          var coment = $("#comentario").val();
          if(inicio!=0 && fin!=0 && coment.length>10){
            var aux = new Date(inicio);
            var inicio = aux.getFullYear()+"-"+(aux.getMonth()+1)+"-"+aux.getDate();
            aux = new Date(fin);
            var fin = aux.getFullYear()+"-"+(aux.getMonth()+1)+"-"+aux.getDate();
            var datos = { "inicio":inicio, "fin":fin, "comentario":coment };
            $.ajax({
              type: "POST",
              data: datos,
              url: "registrar_solicitud.php",
              success: function(response){
                alert("Su solicitud fue enviada con exito :D");
              }
            });
          } else {
            document.getElementById("estado_seleccion_escondido").value=false;
            if(inicio==0){
              $("#muestraInicio").addClass("bordeError");
            }
            if(fin==0){
              $("#muestraFin").addClass("bordeError");
            }
            if(coment.length<10){
              $("#comentario").addClass("bordeError");
            }
          }
        } else {
          if($("#fechaInicio").val()==0){
            alert("Debe ingresar una fecha de inicio :/");
          } else {
            if($("#fechaFin").val()==0){
              alert("Debe ingresar una fecha de fin :/");
            } else {
              var coment = $("#comentario").val();
              if(coment.length<10){
                alert("Debe ingresar un comentario de al menos 10 caracteres :/");
              } else {
                alert("La solicitud ingresada se superpone con una reserva, por favor, elija otra fecha de fin :/");
              }
            }
          }
        }

      }
      function chequear_limite_solicitud(cambia_mes){
        if($("#fechaFin").val()!=0){
          var fechaInicio = new Date($("#fechaInicio").val());
          var fechaFin = new Date($("#fechaFin").val());
          var datos = { "inicioAnio":fechaInicio.getFullYear(),"inicioMes":fechaInicio.getMonth()+1,"inicioDia":fechaInicio.getDate(),"finAnio":fechaFin.getFullYear(),"finMes":fechaFin.getMonth()+1,"finDia":fechaFin.getDate() };
          $.ajax({
            type:"POST",
            data:datos,
            url:"get_reservas_entre_fechas.php",
            success:function(response) {
              if(response=="false"){
                document.getElementById("estado_seleccion_escondido").value=false;
                //alert("La solicitud ingresada se superpone con una reserva, por favor, elija otra fecha de fin :/");
              } else {
                document.getElementById("estado_seleccion_escondido").value=true;
              }
            }
          });
        }
      }
    </script>
  </head>
  <body>
    <div id="contenedor_general" class="contenedor_general">
      <div id="cartel_elegir_dias" class="cartel_elegir_dias">Elegí los dias de <span style="background-color:blue;font-weight: bold;padding:2px 5px 2px 5px;">INICIO</span> y de <span style="background-color:red;font-weight: bold;padding:2px 5px 2px 5px;">FIN</span> de la estadía:</div>
      <div id="contenedor_calendario" class="contenedor_calendario">
        <div id="guardaFecha">
          <input type="hidden" id="añoEscondido" value="0">
          <input type="hidden" id="mesEscondido" value="0">
        </div>
        <div id="guardaSeleccion">
          <input type="hidden" id="diaInicio" value="0">
          <input type="hidden" id="diaFin" value="0">
          <input type="hidden" id="fechaInicio" value="0">
          <input type="hidden" id="fechaFin" value="0">
        </div>
        <div id="renglonSuperior" class="renglonSuperior">
          <div id="flechaI" class="flechaI" onclick="chequear_limite_solicitud(true);incDecCalendario('-1');"><</div>
          <div id="mes_año" class="mes_anio"></div>
          <div id="flechaD" class="flechaD" onclick="chequear_limite_solicitud(true);incDecCalendario('+1');">></div>
        </div>
        <div id="semana" class="semana"></div>
        <div id="dias" class="dias"></div>
        <div id="muestraError" style="color:red;"></div>
      </div>
      <div class="contenedor_muestraFechas">
        <div id="muestraFechas" class="muestraFechas">
          <div id="muestraInicio">Desde el día: </div>
          <div id="muestraFin">Hasta el día: </div>
        </div><br>
        <input type="button" id="quitar_fechas" value="Limpiar fechas" onclick="quitar_fechas()">
      </div><br>
      <div id="esto_seria_el_formulario">
        <textarea id="comentario" class="comentario" rows="5" cols="50" maxlength="250" placeholder="Escribi un comentario"></textarea>
        <div id="error_comentario" class="error"></div>
        <input type="button" id="submit" value="¡Enviar solicitud!" onclick="comprobar();if($('#estado_seleccion_escondido').val()=='true'){volverADetalle();}">
      </div>
      <div id="fechas_reservadas"></div>
      <div id="estado_seleccion">
        <input type="hidden" id="estado_seleccion_escondido" value="true">
      </div>
    </div>
  </body>
</html>
