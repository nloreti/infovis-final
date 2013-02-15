<?php
    include './tweetScript.php';
    $select = $_GET['select'];
    $texto = $_GET['texto'];
   // $cantidad = $_GET['cantidad'];
    $cantidad = 100; //Cable
    if ( $select == 'hashtag')
    {
    		$query = '%23' . $texto;
    }
    else if ($select == 'termino')
    {
        	$query = $texto;
    } 
    else
    {
        $query = '%40' . $texto;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<title>Testeo</title>
</head>
<?php 
require_once("tweetScript.php");
$arrayTweets = new ArrayObject();
//    echo $query."<br/>";
//   echo $cantidad."<br/>";
$arrayTweets = getTweets($query,$cantidad);
$hashTags = array();
tweets2hashtags($arrayTweets, $hashTags);

echo "<script type='text/javascript'>\n";
echo "var j_array_hashtag = new Array();";
echo "var j_array_final = new Array();";

if ($_GET['newSearch'] == 'true')
{
    session_start();
    session_destroy();
}

$first = 0;
$second = false;

$newHashtags = '';
$firstHashtag = true;
session_start();

if ($_GET['newSearch'] == 'true')
{
    $_SESSION['round'] = 0;
} else
{
    if ($_SESSION['round'] != 5)
    {
        $_SESSION['round'] = $_SESSION['round'] + 1;
    }
}
$round = $_SESSION['round'];

$timedHashtags = explode(',', $_SESSION['hashtags']);
foreach ($timedHashtags as $timedHashtag) 
{
    if (isset($_SESSION[$timedHashtag]))
    {
    $quantities = explode(',', $_SESSION[$timedHashtag]);

    if ($round == 5)
    {
        $quantities[0] = $quantities[1];
        $quantities[1] = $quantities[2];
        $quantities[2] = $quantities[3];
        $quantities[3] = $quantities[4];
        if (isset($hashTags[$timedHashtag]))
        {
            $quantities[4] = $hashTags[$timedHashtag];
        } else
        {
            $quantities[4] = 0;
        }
    }
    else
    {
        if (isset($hashTags[$timedHashtag]))
        {
            $quantities[$round] = $hashTags[$timedHashtag];
        } else
        {
            $quantities[$round] = 0;
        }
    }

    if ($quantities[0] == 0 && $quantities[1] == 0 && $quantities[2] == 0 && $quantities[3] == 0 && $quantities[4] == 0)
    {
        unset($_SESSION[$timedHashtag]);
    } else {
        if ($firstHashtag)
        {
            $newHashtags = $timedHashtag;
            $firstHashtag = false;
        } else {
            $newHashtags = $newHashtags . ',' . $timedHashtag;
        }
        $_SESSION[$timedHashtag] = implode(',', $quantities);
    }
    }    
}

foreach ($hashTags as $key => $value){
    echo "j_array_hashtag.push({'val1':'$key','val2':'$value'});";
    if ($first < 5 && $key != '')
    {
        if ($select != 'hashtag' || $second)
        {
            if (!isset($_SESSION[$key]))
            {
                if ($firstHashtag)
                {
                    $newHashtags = $key;
                    $firstHashtag = false;
                } else
                {
                    $newHashtags = $newHashtags . ',' . $key;
                }

                if ($round == 0)
                    $_SESSION[$key] = $value . ',undefined,undefined,undefined,undefined';
                if ($round == 1)
                    $_SESSION[$key] = '0,' . $value . ',undefined,undefined,undefined';
                if ($round == 2)
                    $_SESSION[$key] = '0,0,' . $value . ',undefined,undefined';
                if ($round == 3)
                    $_SESSION[$key] = '0,0,0,' . $value . ',undefined';
                if ($round >= 4)
                    $_SESSION[$key] = '0,0,0,0,' . $value;

            }
            $first++;
        }
        $second = true;
    }
}
$_SESSION['hashtags'] = $newHashtags;
if ($select == 'hashtag')
{
    echo "var k = 1;";
}
else
{
    echo "var k = 0;";
}

echo "</script>\n";
?>

<script type="text/javascript">
	
       // Load the Visualization API and the piechart package.
	 //google.load('visualization', '1', {'packages':['annotatedtimeline']});    
  google.load('visualization', '1.0', {'packages':['corechart']});
	
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

var data = new google.visualization.DataTable();
data.addColumn('string', '');
j_array_final.push('');
var length;
if ( j_array_hashtag.length < 10 ){
  length = j_array_hashtag.length
}else{
  length = 10;
}
for( k; k<length;k++){
          if (typeof j_array_hashtag[k].val1 === "undefined"){
             data.addColumn('number', 'unknown');
            j_array_final.push(parseInt(j_array_hashtag[k].val2));
          }else{
       		 data.addColumn('number', j_array_hashtag[k].val1);
       		 j_array_final.push(parseInt(j_array_hashtag[k].val2));
          }
}
data.addRow(j_array_final);


    // Set chart options
    var options = {'width':650,
                       'height':300,
						'backgroundColor.strokeWidth':1,
						'backgroundColor.stroke':'#666'};

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);

}
</script>

<body>
					<div id='chart_div' class='chart'></div><br/>
</body>
</html>
