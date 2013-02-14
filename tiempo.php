<?php
sleep(5);
session_start();

$hashtags = $_SESSION['hashtags'];
$cantidades = $_SESSION['cantidades'];

//HASHTAGS Y CANTIDADES SON STRINGS QUE SEPARAN los hashtags con comas (',') y las cantidades con comas.
//La posicion iesima se corresponde con la posicion iesima del otro string.
//En php explode te lo pone en un array si te viene mas comodo
?>
