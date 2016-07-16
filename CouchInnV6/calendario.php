<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCalendario.css" media="screen" title="no title" charset="utf-8">
    <title></title>
    <script src="jquery-3.0.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var fecha = new Date();
        cargarCalendario(fecha);
        var diasSemana=["Dom","Lun","Mar","Mie","Jue","Vie","Sab"];
        for (var i = 0; i < diasSemana.length; i++) {
          $("#semana").append("<div class='diaSemana'>"+diasSemana[i]+"</div>");
        }
        $("#flechaI").css("color","silver");
        $("#guardaFecha").append("<input id='fecha' type='hidden' value='"+fecha+"'>");
      });
      function cargarCalendario(fecha) {
        $("#dias").empty();
        var mes = fecha.getMonth();
        var semana = fecha.getDay();
        var divMes = $("#mes_año");
        var cantDiasAnterior = cant_ds(mes,fecha.getFullYear());
        var cantDias = cant_ds(mes+1,fecha.getFullYear());
        var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        var ultimosDosDigitos=fecha.getFullYear()%100;
        divMes.html("<span id='mes' class='mes' onclick='eventoMes(1)'>"+meses[mes]+"</span><select id='mesSelect' class='mes' onchange='eventoMes(2)'></select> <span id='cambiaAño' class='anio' onclick='eventoAnio()'>20"+ultimosDosDigitos+"</span>");
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
          dias.append("<div id='"+i+"' class='nroDia' onclick='seleccionar(this.id)'>"+i+"</div>");
          if(!hacer(i)){
            $("#"+i).css("color","#4c4c4c");
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
            $("#flechaI").css("color","black");
          } else {
            if(mesActual.value < hoy.getMonth() && añoActual.value >= hoy.getFullYear()){
              $("#flechaI").css("color","black");
            } else {
              $("#flechaI").css("color","silver");
              $("#muestraError").html("NO DEBE SELECCIONAR UN DIA ANTERIOR A HOY...");
            }
          }
        } else {
          if(mesActual.value==11){
            añoActual.value++;
            mesActual=0;
          } else {
            mesActual.value++;
          }
          $("#flechaI").css("color","black");
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
              $("#muestraInicio").html("");
              $("#muestraFin").html("");
              $("#"+id).css("background-color","transparent");
              $("#"+valor).css("background-color","transparent");
            } else {
              fechaAux.setDate(id);
              fechaAux.setMonth($("#mesEscondido").val());
              fechaAux.setFullYear($("#añoEscondido").val());
              if($("#diaInicio").val()==0){
                document.getElementById("diaInicio").value=id;
                document.getElementById("fechaInicio").value=fechaAux;
                $("#muestraInicio").html(fechaAux);
              } else {
                if($("#diaFin").val()!=0 && $("#diaFin").val()!=id){
                  $("#"+valor).css("background-color","transparent");
                }
                document.getElementById("diaFin").value=id;
                document.getElementById("fechaFin").value=fechaAux;
                $("#muestraFin").html(fechaAux);
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
                  $("#muestraInicio").html(fechaAux);
                  $("#muestraFin").html(fechaInicial);
                }
              }
            }
            marcarDiasSeleccionados();
          } else {
            $("#muestraError").html("NO DEBE SELECCIONAR UN DIA ANTERIOR A HOY...");
          }
        } else {
          if(id>=-12){
            incDecCalendario("+1");
          } else {
            incDecCalendario("-1");
          }
        }
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
        $("#cambiaAño").html("20<input type='text' id='ingresaDigitos' maxlength='2' size='1' onchange='comprobar_año()'>");
      }
    </script>
  </head>
  <body>
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
      <div id="flechaI" class="flechaI" onclick="incDecCalendario('-1')"><</div>
      <div id="mes_año" class="mes_anio"></div>
      <div id="flechaD" class="flechaD" onclick="incDecCalendario('+1')">></div>
    </div>
    <div id="semana" class="semana"></div>
    <div id="dias" class="dias"></div>
    <div id="muestraError"></div>
    <div id="muestraInicio"></div>
    <div id="muestraFin"></div>
  </body>
</html>
