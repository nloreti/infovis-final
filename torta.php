<?php
//var_dump($_GET);

    include './tweetScript.php';
    $select = $_GET['select'];
    $texto = $_GET['texto'];
    //$cantidad = $_GET['cantidad'];
    $cantidad = 100;
    if ($select == 'termino')
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
$arrayTweets = getTweets($query,$cantidad);
$hashTags = array();
tweets2devices($arrayTweets, $hashTags);

asort($hashTags);

echo "<script type='text/javascript'>\n";
echo "var j_array_hashtag = new Array();";
echo "var j_array_final = new Array();";
echo "var j_array_hashtag_test = new Array();";
echo "var my_array = new Array();";
echo "var array_final = new Array();";

foreach ($hashTags as $key => $value){
    echo "j_array_hashtag.push(['$key', parseInt('$value')]);";
    echo "j_array_hashtag_test.push({val1:'$key', val2:'$value'});";
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
j_array_final.push('');
//console.log(j_array_hashtag.length);

data.addColumn('string', 'Dispositivo');
data.addColumn('number', 'Tweets');
//console.log(j_array_hashtag);
my_array.push(["Web",0]);
my_array.push(["Mobile",0]);

for( k = 0; k<j_array_hashtag.length;k++){
            //console.log(j_array_hashtag[k][0]);
            if ( j_array_hashtag[k][0]== "Web"){
              my_array[0][1] = j_array_hashtag[k][1];
            }else{
              my_array[1][1] += j_array_hashtag[k][1];      
            }
}
data.addRows(j_array_hashtag);
console.log(j_array_hashtag);
console.log(my_array);

var data2 = new google.visualization.DataTable();
data2.addColumn('string', 'Metodo de acceso');
data2.addColumn('number', 'Accesos');
data2.addRows([['Web', my_array[0][1]],['Mobile', my_array[1][1]]]);
 		
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
    var options = {'width':650,
                       'height':350,
						'backgroundColor.strokeWidth':1,
						'backgroundColor.stroke':'#666',
            'float':'left'};

  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);

 // var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
   //     chart.draw(data2, options);

  var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options);


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
            <div id='chart_div2' class='chart2'></div><br/>
</body>
</html>
