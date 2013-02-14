<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="./bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<?php 
$vector = array( "Hola" => "1,1","Chau" => "2,2");

var_dump($vector);
echo "<script type='text/javascript'>\n";

echo "var j_array_hashtags = new Array();";
echo "var j_array_value = new Array();";

//$vector = new Array($_SESSION);


foreach ( $vector as $key => $value) {
	echo "j_array_hashtags.push('$key');";		
}

foreach ($vector as $key => $value) {
	echo "j_array_value.push('$value');";	
}


echo "</script>\n"
//echo "j_array_hashtags.push({'val1':'$day','val2':$total,'val3':$month,'val4':$year});";

?>
<script type="text/javascript" src="./bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
	console.log(j_array_hashtags);
	for(k=0; k < j_array_hashtags.length; k++){
		data9.addColumn('number', j_array_hashtags[k]);
	}
	
	var vector_final = new Array();
	var flag = true;
	for (i=0;i<5 && flag;i++){
			var vector = new Array();
			vector.push('');
		for(k=0;k< j_array_value.length && flag;k++){
			var values = j_array_value[k].split(",");
				if(!isNaN(values[i])){
						vector.push(parseInt(values[i]));						
				}else{
					console.log("FALSE");
					flag = false;
				}

		}	
		console.log(vector);
		if (flag != false){
		vector_final.push(vector);	
		}
	}
	console.log(vector_final);

//Vector final es el que se tendría que pushear.
	for( k = 0; k< vector_final.length;k++){
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