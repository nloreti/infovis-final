<<<<<<< HEAD
<?php

//IMPORTANTE NO BORRAR - PARAMETROS DE BUSQUEDA PARA LA API DE TWITTER
#$current = "http://search.twitter.com/trends/current.json";
#%40 para buscar por un usuario
#%23 para buscar por hashtag
#palabra simple para buscar por palabras
#para buscar por location "%20near%3A"LOCATION "%20within%3A50km"


//	Clase que simula un Tweet
class tweet{

	protected $created_at;
	protected $from_user;
	protected $profile_image_url;
	protected $source;
	protected $text;

	function __construct($created_at, $from_user, $profile_image_url, $source, $text){
		$this->created_at = $created_at;
		$this->from_user = $from_user;
		$this->profile_image_url = $profile_image_url;
		$this->source = $source;
		$this->text = $text;
	}

	function getCreated(){
		return $this->created_at;
	}

	function getUser(){
		return $this->from_user;
	}

	function getImage(){
		return $this->profile_image_url;
	}

	function getSource(){
		return $this->source;
	}

	function getTweet(){
		return $this->text;
	}

}

//	Funcion que dado un query para la API de Twitter y una cantidad de tweets
//	a devolver los encapsula en un array de objetos de PHP de tipo Tweet
function getTweets($query,$quantity){
	
	//Declaro Variables
	$created_at;
	$from_user;
	$profile_image_url;
	$source;
	$text;
	$arrayTweets = new ArrayObject();

	//Armo el query para pegarle a la API de Twitter
	$current = "http://search.twitter.com/search.json?q=" . $query . ";rpp=" . $quantity;
	//$current = "http://search.twitter.com/search.json?q=%23exito;rpp=1";

	//Inicializo el Curl, me devuelve un json y lo parseo para PHP a formato TEXTO
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $current);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$ce = curl_exec($c);
	$trends = json_decode($ce,true);

	//Itero por los resultados y voy creando Tweets que meto en el ArrayTweets Object
	foreach ($trends as $key => $value){
		if ( $key === "results" ){
			foreach( $value as $item => $vector ){
				print_r($vector);
				foreach ( $vector as $clave => $valor){
					if( $clave === "created_at"){
						$created_at = $valor;
					}
					if( $clave === "from_user"){
						$from_user = $valor;
					}
					if( $clave === "profile_image_url"){
						$profile_image_url = $valor;
					}	
					if( $clave === "source"){
						$source = $valor;
					}
					if($clave === "text"){
						$text = $valor;
					}
				}
				$tweet = new tweet($created_at,$from_user,$profile_image_url,$source,$text);
				$arrayTweets->append($tweet);
			}
		}
	}

	//Imprime Tweets
	printTweets($arrayTweets);

	//Cierro el Curl
	curl_close($c);

	//Retorno el array de Tweets
	return $this->arrayTweets;

}

function printTweets($arrayTweets){
	echo "<br/><br/>Imprimiendo Todos los Tweets<br/><br/>";
	foreach ( $arrayTweets as $clave => $tweet){
		echo $tweet->getCreated() . "<br/>";
		echo $tweet->getUser() . "<br/>";
		echo $tweet->getImage() . "<br/>";
		echo $tweet->getSource() . "<br/>";
		echo $tweet->getTweet() . "<br/><br/><br/>";
	}
}

//LLamada a la API
getTweets("%23exito","3");

?>
=======
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type="text/javascript" src="./bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="http://d3js.org/d3.v2.js"></script>

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
                    <a href="./comparacion.php">Comparaci&oacute;n de t&eacute;rminos</a>
                </li>
                <li>
                    <a href="./mapa.php">B&uacute;squeda en el mapa</a>
                </li>
			</ul>
		</div>
	  </div>
	</div>
	<div class="container">
	<div class="hero-unit">
	  <h1>ITBA VISUALIZATIONS</h1>
	  <p>Estad&iacute;sticas de Twitter en tiempo real</p>
	  <p>
		 <a href="./comparacion.php" class="btn btn-primary btn-large">
		      Comparaci&oacute;n de t&eacute;rminos
		 </a>
		<a href="./mapa.php" class="btn btn-primary btn-large">
		      B&uacute;squeda en el mapa
		 </a>
	  </p>
	</div>
	</div>

</body>
>>>>>>> b606b5feac52bda7e4bf745007d301d35df739ad
