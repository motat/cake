

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
<div class='secondblock' style='border:1px; border-color:#5AAB5A; border-bottom-style:solid;'>
        <div class='left padding'>
            <div id='chart_div' style='height:400px; width:400px;'></div>
        </div>
        <div class ='left padding'>
            <div class='blockSmall'></div>
            <center>
                <h5>Total Dose per Substance</h5>
           </br>
                </br>
                <?php
                foreach ($units as $unit) {
                    echo "<span class='small'>".$unit['Drug']['drug']." :</span> <span class='smallx'>".$unit['RecordDrugUnit']['sum']." ".$unit['Unit']['unit']."</span></br>";
                }
                /*foreach ($units as $unit=> $amounts) {
                    foreach($amounts as $amount=>$drug){
                        echo "<span class='small'>".$drug." :</span> <span class='smallx'>".$amount." ".$unit."</span></br>";
                    }
                }*/
                ?>
            </center>
            </br>
        </div>
        <div class='clear'></div>
</div>
<div class='secondblock padding' id='logInfo'>
        <span class='fButton'><?php echo $this->Html->link('add entry', array('action' => 'add')); ?></span>
        <div class='container'>
            <span class='medium'>Sort: </span>
            <span class='small'>
            <?php 
            echo $this->Paginator->sort('Drug.drug', 'drug name'); 
            echo " | ";
            echo $this->Paginator->sort('Record.dose_date', 'date');
            echo " | ";
            echo $this->Paginator->sort('RecordDrugUnit.dose', 'dose');
            ?>
            </span>
        </br>
    </br>
                <?php foreach ($log as $log): ?>
                <?php
                        $divided_dose = $log['RecordDrugUnit']['dose'] / $log['Unit']['conversion'];
                ?>
                        <div class='borderLeft padding'>
                                <div class='left colSmallMed'>
                                        <span class='medium'><?php echo $log['Drug']['drug']; ?></span>
                                        </br>
                                        </br>
                                        <span class='small'><?php echo $log['Record']['dose_date']; ?></span>
                                        </br>
                                        </br>
                                        <span class='fButton'><?php echo $this->Html->link('Edit', array('action' => 'edit', $log['Record']['id'])); ?></span>&nbsp; &nbsp;
                                         <span class='fButton'><?php echo $this->Html->link('Delete', array('action' => 'delete', $log['Record']['id'])); ?></span>
                                </div>
                                <div class='right colSmallMed'>
                                        </br>
                                        <span class='small'>Dose: </span><span class='smallx red'><?php echo $divided_dose; ?> <?php echo $log['Unit']['unit']; ?>
                                        </span>
                                        </br>
                                        </br>
                                        <h5><?php echo $log['Record']['title']; ?></h5>
                                        </br>
                                        <span class='smallx'><?php echo $log['Record']['report']; ?></span>
                                </div>
                                <div class='clear'></div>
                        </div>
                    </br>
                </br>
            </br>
                <?php endforeach; ?>
                <?php unset($post); ?>
                </br>
                <?php
                /***
                * Pagination
                */
                echo $this->Paginator->numbers();
                ?>
                </br>
        </div>
</div>
        </BODY>
</HTML>
