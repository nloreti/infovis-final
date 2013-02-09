<?php
//include 'tweetScript.php';
require_once("tweetScript.php");

$arrayTweets = new ArrayObject();

echo "Antes";
$arrayTweets = getTweets("%23exito","3");
echo "dsp";
//echo $arrayTweets;

printTweets($arrayTweets);

echo "hola";

?>