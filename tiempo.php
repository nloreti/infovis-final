<?php
sleep(5);
session_start();
//var_dump($_SESSION);

$finalArray = "[['Periodo'";
$hashtags = explode (',', $_SESSION['hashtags']);
foreach ($hashtags as $hashtag)
{
  $finalArray = $finalArray . ",'" . $hashtag . "'";
}
$finalArray = $finalArray . '],';
$round = $_SESSION['round'];
$round = $round - 4;
if ($round < 0)
{
    $round = 0;
}
for ($i = 0; $i < 5; $i++)
{
  $finalArray = $finalArray . "['" . $round . "'";
  foreach ($hashtags as $hashtag)
  {	
    $quantities = explode(',', $_SESSION[$hashtag]);
    $finalArray = $finalArray . "," . $quantities[$i];
  }
  $finalArray = $finalArray . "]";

  if ($i != 4)
  {
    $finalArray = $finalArray . ',';
  }
    $round++;
}
$finalArray = $finalArray . ']';
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $finalArray; ?>);

        var options = {
            'width': 650,
            'height': 300
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
