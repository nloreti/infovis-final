<?php
//include 'tweetScript.php';
require_once("tweetScript.php");

$arrayTweets = new ArrayObject();
$hashTags = array();
$arrayTweets = getTweets("%23good","3");

//echo $arrayTweets;

printTweets($arrayTweets);

tweets2hashtags($arrayTweets, $hashTags);

?>