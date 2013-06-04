<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="scripts/js.js"></script>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php

?> 


 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php echo $grouped; ?>
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
<?php echo $this->Record->grouped; ?>
        <div id='chart_div' style='width: 700px; height: 500px;'></div>
  <div class='block'></div>
  <div class='smallBlock'></div>
  <center>
      <h3>A way to record your drug use anonymously and efficiently.</h3>
  </center>
