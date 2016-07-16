<!DOCTYPE HTML>
<html>
<head>
  <title>Prueba</title>

<style>
#caja {
  margin: 10px;
  width: 350px;
  height: 350px;
  border: 5px dashed gray;
  border-radius: 8px;
  background: rgb(230,230,230);
  background-repeat: no-repeat;
  background-size: 100%;
}
</style>


<script>
    window.addEventListener('load', inicio, false);

    function inicio() {
        document.getElementById('caja').addEventListener('dragover', permitirDrop, false);
        document.getElementById('caja').addEventListener('drop', drop, false);
    }

    function drop(ev)
    {
        ev.preventDefault();
        var arch=new FileReader();
        arch.addEventListener('load',leer,false);
        arch.readAsDataURL(ev.dataTransfer.files[0]);
    }

    function permitirDrop(ev)
    {
        ev.preventDefault();
    }

    function leer(ev) {
        document.getElementById('caja').style.backgroundImage="url('" + ev.target.result + "')";
    }
</script>
</head>

<body>
<p>Arrastrar una imagen desde el escritorio.</p>
<div id="caja">
</div>
</body>
</html>
