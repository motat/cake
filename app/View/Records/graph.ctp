<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="scripts/js.js"></script>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php
$chart = new Chart('PieChart');
$data = array(
        array('penis' => 'onions', 'slices' => 2),
        array('penis' => 'olives', 'slices' => 1),
        array('penis' => 'cheese', 'slices' => 4)
);
$chart->load($data, 'array');
$options = array('title' => 'pizza', 'is3D' => true, 'width' => 500, 'height' => 400);
echo $chart->draw('my_div', $options); 
echo $output;
?> 

<div id='my_div' style='width: 700px; height: 500px;'></div>

 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
            <?php
            foreach($output as $compound => $sum){
              echo "['".$compound."', ".$sum."], ";
            }
            ?>
        ]);

        var options1 = {
          title: 'Users Favorite Substances',
          backgroundColor: 'black',
          'titleTextStyle': { 'color': 'white' },
          'legend': { 'textStyle': { 'color': 'white' } }
        };


        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data1, options1);
      }
</script>
<span class='small'>

<?php print_r($chart_data); ?></div>

<div id='chart_div' style='width: 700px; height: 500px;'></div>
