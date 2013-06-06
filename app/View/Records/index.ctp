<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="scripts/js.js"></script>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
          title: 'Your Favorites',
          backgroundColor: { fill:'transparent' },
          'titleTextStyle': { 'color': 'black' },
          'legend': { 'textStyle': { 'color': 'black' } }
        };


        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data1, options1);
      }
</script>

    <div class='block'></div>
    <center>
        <div id='chart_div' style='height:700px; width:700px;'></div>
    </div>
    <div class='colMedium'>
        <div class='right'>
          <div class='padSmallx'>
            <span class='fButton'><?php echo $this->Html->link('add entry', array('action' => 'add')); ?></span>
          </div>
        </div>
      <div class='padSmallx'>
        <h3>Log</h3>
        </br>
        </br>
        </br>

        <?php foreach ($records as $record): ?>
        <div class='colFull borderTop'>
            <div id='logDate'>
                <div class='padSmallx'>
                    <span class='small'><?php echo $record['Record']['dose_date']; ?>
                    </span>
                    </br>
                    <div class='right'>
                        <span class='fButton'><?php echo $this->Html->link('Edit', array('action' => 'edit', $record['Record']['id'])); ?></span>
                        </br>
                        <span class='fButton'><?php echo $this->Html->link('Delete', array('action' => 'delete', $record['Record']['id'])); ?></span>
                    </div>
                </div>
            </div>
            <div id='logInfo'>
                <div class='padSmallx'>
                    <span class='medium'><?php echo $record['Record']['compound']; ?>
                    </span>
                    </br>
                    <span class='smallx red'><?php echo $record['Record']['dose']; ?> <?php echo $record['Record']['unit']; ?>
                    </span>
                    </br>
                    </br>
                    <h5><?php echo $record['Record']['title']; ?></h5>
                    </br>
                    <span class='smallx'><?php echo $record['Record']['report']; ?>
                    </span>
                </div>
            </div>
            <div class='clear'></div>
        </div>
        <div class='blockxSmall'></div>
        <?php endforeach; ?>
        <?php unset($post); ?>

        </br>
        </br>
      </div>
    </div>
  </BODY>
</HTML>
