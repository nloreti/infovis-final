<?php
sleep(5);
session_start();
var_dump($_SESSION);

echo "<script type='text/javascript'>\n";
echo "var j_array_hashtags = new Array();";
echo "var j_array_values = new Array();";

//$vector = new Array($_SESSION);
$vector = [("Hola",1),("Chau",2)];
var_dump($vector);
foreach ( $vector as $key => $value) {
	echo "j_array_hashtags.push('$key');";		
}

echo "</script>\n"
//echo "j_array_hashtags.push({'val1':'$day','val2':$total,'val3':$month,'val4':$year});";

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

        // Create the data table.
	var data9 = new google.visualization.DataTable();
	data9.addColumn('string', '');
	for(k=0; k < j_array_hashtags.length; k++){
		data9.addColumn('number', j_array_hashtags[k]);
	}

	var vector_final = new Array();
	for(k=0;k< j_array_values.length;k++){
			var vector = new Array();
			var values = j_array_value[k].split(",");
			for( j = 0; j < values.length; j++){
				if(values[j] != "-1"){
						vector.push(parseInt(values[j]));						
				}//else{
				//	vector.push(values[j]);		
				//}
			}
			vector_final.push(vector);
	}

//Vector final es el que se tendría que pushear.
	for( k = 0; k< vector_final.length;k++){
//			data9.addRow(['',j_array_values[k].val1, j_array_values[k].val2, j_array_values[k].val3, j_array_values[k].val4]);
			data9.addRow(vector_final[k]);
	}


    // Set chart options
    var options = {'width':600,
                       'height':300,
						'backgroundColor.strokeWidth':1,
						'backgroundColor.stroke':'#666'};
						
// Instantiate and draw our chart, passing in some options.


		var datechart = new google.visualization.LineChart(document.getElementById('fechachart_div'));
        datechart.draw(data9, options);

      };
    </script>
<body>
    <div id='fechachart_div' class='chart'></div><br/>
</body>