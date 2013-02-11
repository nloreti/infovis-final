<?php
//include 'tweetScript.php';
require_once("tweetScript.php");

$arrayTweets = new ArrayObject();
$hashTags = array();
$devices = array();
$arrayTweets = getTweets("%23Velez","50");

//echo $arrayTweets;

printTweets($arrayTweets);

tweets2hashtags($arrayTweets, $hashTags);

tweets2devices($arrayTweets, $devices);

var_dump($hashTags);
echo "<br/>";
var_dump($devices);

?>