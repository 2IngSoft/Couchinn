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
                  <br><select name="fecha" required="true">
                    <option value="">D&iacutea</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                  </select>

                  <select id="mes"  name="mes">
                    <option value="">Mes</option>
                      <option value="1">Enero</option>
                      <option value="2">Febrero</option>
                      <option value="3">Marzo</option>
                      <option value="4">Abril</option>
                      <option value="5">Mayo</option>
                      <option value="6">Junio</option>
                      <option value="7">Julio</option>
                      <option value="8">Agosto</option>
                      <option value="9">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                  </select>
                  <select  id="anio" name="anio">
                      <option value="">A&ntildeo</option>
                      <option value="2016">2016</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                      <option value="2028">2028</option>
                      <option value="2029">2029</option>
                      <option value="2030">2030</option>
                      <option value="2031">2031</option>

                  </select>
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
