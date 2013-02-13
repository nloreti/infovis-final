<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type="text/javascript" src="./bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.js"></script>

<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">

<title>Visualizaci&oacute;n de la Informaci&oacute;n - ITBA - 2012</title>
</head>

<body>
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	      	<a class="brand" href="#">
			  ITBA Visualizations
			</a>
			<ul class="nav">
			  <li class="active">
                <a href="./index.php">Home</a>
              </li>
                <li>
                    <a href="./comparacion.php">Comparaciones</a>
                </li>
                <li>
                    <a href="./mapa.php">B&uacute;squeda en el mapa</a>
                </li>
			</ul>
		</div>
	  </div>
	</div>
    <div class="container">
        <div class="filtros span3">
            <form>
                <div>Deseo buscar:</div>
                <select id="usuarioOTermino">
                    <option value="usuario" selected>Usuarios</option>
                    <option value="termino">Terminos</option>
                    <option value="hashtag">Hashtag</option>
                </select>
                Texto a buscar:<input name="texto" id="texto"/>
                Cantidad de tweets:<input name="cantidad" id="cantidad"/>
                Cantidad de minutos entre refresco:<input name="tiempo" id="tiempo"/>
                 <a href="javascript:Actualizar();" class="btn btn-primary btn-large">Actualizar</a>
                <input name="valorSelect" id="valorSelect" type="hidden" value="usuario"/>
                <input name="valorTexto" id="valorTexto" type="hidden"/>
                <input name="valorCantidad" id="valorCantidad" type="hidden"/>
                <input name="valorTiempo" id="valorTiempo" type="hidden"/>
                <input name="round" id="round" type="hidden" value="0"/>
            </form>
        </div>
        <div class="iframe span8">
            <div style="font-size:20px;margin-top:10px;font-weight:bold;">Hashtags encontrados:</div>
            <iframe id="iframe" width="650" height="400" frameborder="0"></iframe>
            <div style="font-size:20px;margin-top:10px;font-weight:bold;">Fuentes de los tweets:</div>
            <iframe id="iframeTorta" width="650" height="400" frameborder="0"></iframe>
        </div>
	</div>


<script>
    function Actualizar()
    {
        var cantidad = $('#cantidad').val();
        var opcion = $('#usuarioOTermino').val();
        var texto = $('#texto').val();
        var tiempo = $('#tiempo').val();
        var error = false;
        
        if (texto == '')
        {
            alert('Debe escribir algo en el campo de texto.');
            error = true;
        }

        if (!error && !isNormalInteger(cantidad))
        {
            alert('La cantidad debe ser de tipo numerica y positiva');
            error = true;
        }

        if (!error && !isNormalInteger(tiempo))
        {
            alert('La cantidad de minutos debe ser numerica y positiva');
            error = true;
        }

        if (!error)
        {
            $('#valorSelect').val(opcion);
            $('#valorTexto').val(texto);
            $('#valorCantidad').val(cantidad);
            $('#valorTiempo').val(tiempo);
            $('#round').val(parseInt($('#round').val()) + 1);
            ActualizarGrafico($('#round').val());
        }
    }

    function isNormalInteger(str) 
    {
            var n = ~~Number(str);
                return String(n) === str && n >= 0;
    }

    function ActualizarGrafico(round){
        roundPosta = $('#round').val();
        if (roundPosta == round)
        {
            var cantidad = $('#valorCantidad').val();
            var select = $('#valorSelect').val();
            var texto = $('#valorTexto').val();
            var iframe = document.getElementById('iframe');
            iframe.src = './barras.php?select=' + select + '&texto=' + texto + '&cantidad=' + cantidad;
            var iframeTorta = document.getElementById('iframeTorta');
            iframeTorta.src = './torta.php?select= ' + select + '&texto=' + texto + '&cantidad=' + cantidad; 
            var tiempo = $('#valorTiempo').val();
            window.setTimeout('ActualizarGrafico(' + round + ')', parseInt(tiempo) * 1000 * 60);
        }
    }
</script>

</body>

</html>
