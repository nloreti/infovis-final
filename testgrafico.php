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
$arrayTweets = getTweets("%23CFK","50");
echo "Consulta Cableada de #CFK 50 tweets<br/>";
$hashTags = array();
tweets2hashtags($arrayTweets, $hashTags);
var_dump($hashTags);

echo "<script type='text/javascript'>\n";
echo "var j_array_hashtag = new Array();";
echo "var j_array_final = new Array();";

foreach ($hashTags as $key => $value){
	echo "j_array_hashtag.push({'val1':'$key','val2':'$value'});";
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
for( k = 0; k<j_array_hashtag.length;k++){
       		data.addColumn('number', j_array_hashtag[k].val1);
       		j_array_final.push(parseInt(j_array_hashtag[k].val2));
}

console.log(j_array_final);
data.addRow(j_array_final);

			
/*		
			vector.push();
			var values = j_array_hashtag[k].val2.split(",");
			console.log(values);	
			for( j = 0; j < values.length; j++){
				if(values[j] != "undefined"){
						vector.push(parseFloat(values[j]));						
				}else{
					vector.push(values[j]);
				}
					
			}
			
			j_array_final = vector;
			data9.addRow(vector);
}
*/

    // Set chart options
    var options = {'width':900,
                       'height':400,
						'backgroundColor.strokeWidth':1,
						'backgroundColor.stroke':'#666'};

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);



/*  var options = {'width':750,
                       'height':450,
						'backgroundColor.strokeWidth':1,
						'backgroundColor.stroke':'#666',
						'title': 'Grafico de Alumnos y Promedios',
						'pointSize':'2'};

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data9, options);*/

}
</script>

<body>
						<div id='chart_div' class='chart'></div><br/>
</body>
</html>