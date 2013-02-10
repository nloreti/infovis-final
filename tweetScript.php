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
				//print_r($vector);
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
	//printTweets($arrayTweets);

	//Cierro el Curl
	curl_close($c);

	//Retorno el array de Tweets
	return $arrayTweets;

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

function tweets2hashtags($arrayTweets, &$hashTags){
//	$matches = array();
	echo "ASD";	
	foreach ( $arrayTweets as $clave => $tweet){
		
		get_hashtags($tweet->getTweet(),$hashTags);
	}

	//var_dump( $hashTags);
	//$hashTags["Nico"]++;
	var_dump( $hashTags);
	unset($hashTags[""]);
	var_dump( $hashTags);
	
	
}

function get_hashtags($tweet, &$hashTags)
{
	echo $tweet . "<br/>";
	$myTweet = $tweet;
	while ( !empty($myTweet) ){
		preg_match("/#(\\w+)/", $myTweet, $matches);
		//echo "Un resultado es: " . $matches[0]. "<br/>";
	$hashTags[strtolower($matches[0])]++;
	//var_dump($hashTags);
	$myTweet = stristr($myTweet, '#');
	//echo "Asi quedo: " . $myTweet . "<br/>";
	$myTweet = substr($myTweet, 1);
	//echo "Por ultimo: " . $myTweet . "<br/>";	
	///Cortarlo.
	//$hashTags[]
	}
	
	 // Outputs 'hashtag'
}
//LLamada a la API
//getTweets("%23exito","3");
?>
