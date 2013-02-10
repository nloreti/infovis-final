<?php
//var_dump($_GET);

    include './tweetScript.php';
    $select = $_GET['select'];
    $texto = $_GET['texto'];
    $cantidad = $_GET['cantidad'];
    if ($select == 'termino')
    {
        $query = $texto;
    } 
    else
    {
        $query = '%40' . $texto;
    }

    $tweets = getTweets($query, $cantidad);
?>
