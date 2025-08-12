<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Captura de firmas</title>
  <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" href="css/signature-pad.css">

</head>
<style>
body, html {
  background-color: lightgrey;
  margin: 0;
  padding: 0;
  text-align: center;
}

canvas {
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  display: inline-block;
  margin-top: 30px;
  margin-bottom: 10px;
  cursor: default;
  position:relative;
}

input, select, textarea { 
  margin:0; 
  padding: 2px 5px;
  outline:none; 
  font-family:inherit;
  background-color: grey;
  box-sizing:border-box; 
  cursor: pointer;
  border: 1px solid transparent;
  border-radius: 4px;
}

button {
  color: white;
  background-color: grey;
  display: inline-block;
  padding: 6px 13px;
  margin-bottom: 0;
  font-size: 9px;
  font-weight: normal;
  text-align: center;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}

button:hover, button:active, input:hover {
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.24), 0 1px 5px rgba(0, 0, 0, 0.05);
  background-color: #666666;
}
.gui {
  width: 300px;
  text-align: right;
  margin: auto;
}
</style>
<?php
$idr=$_REQUEST['idr'];
$cedula=$_REQUEST['cedula'];
?>  
	<canvas id="canvas" width="1044" height="340"></canvas>
    <div class="gui">
<h2>Firma para la cédula número: <?php echo $cedula; ?></h2><br>
	  <input type="color" id="color" value="#000000">
      <button id="bt-clear">LIMPIAR</button>
      <button id="bt-save">GUARDAR</button>
    </div>

  <script>
  var tiemposcambian = tiemposcambian || {};

tiemposcambian.GuardandoPNGs = (function() {
  var mousePressed = false;
  var lastX, lastY;
  var ctx;

  function init() {
    // init canvas
    var canvas = document.getElementById('canvas');
    ctx = canvas.getContext('2d');
    resetCanvas();

    // button events
    document.getElementById('bt-save').onmouseup = sendToServer;
    document.getElementById('bt-clear').onmouseup = resetCanvas;

    // canvas events
    canvas.onmousedown = function(e) {
      draw(e.layerX, e.layerY);
      mousePressed = true;
    };

    canvas.onmousemove = function(e) {
      if (mousePressed) {
        draw(e.layerX, e.layerY);
      }
    };

    canvas.onmouseup = function(e) {
      mousePressed = false;
    };
    
    canvas.onmouseleave = function(e) {
      mousePressed = false;
    };
  }

  function draw(x, y) {
    if (mousePressed) {
      ctx.beginPath();
      ctx.strokeStyle = document.getElementById('color').value;
      ctx.lineWidth = 2;
      ctx.lineJoin = 'round';
      ctx.moveTo(lastX, lastY);
      ctx.lineTo(x, y);
      ctx.closePath();
      ctx.stroke();
    }
    lastX = x; lastY = y;
  }

  function sendToServer() {
    var data = canvas.toDataURL('image/png');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      // request complete
      if (xhr.readyState == 4) {
        window.open('firmas/'+xhr.responseText,'_blank');
      }
    }
    xhr.open('POST','snapshot.php',true);
    xhr.setRequestHeader('Content-Type', 'application/upload');
    xhr.send(data);
  }
  
  function resetCanvas() {
    // just repaint canvas white
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
  }

  return {
    'init': init
  };
});


window.onload = function() {
  new tiemposcambian.GuardandoPNGs().init();
};
  </script>

</html>

<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>