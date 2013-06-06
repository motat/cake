<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'ug.');
?>
<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $cakeDescription ?>:
    <?php echo $title_for_layout; ?>
  </title>
  <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('cake.generic');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
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
          title: 'Top Substances',
          backgroundColor: { fill:'transparent' },
          'titleTextStyle': { 'color': 'black' },
          'legend': { 'textStyle': { 'color': 'white' } }
        };

        var data2 = google.visualization.arrayToDataTable([
            ['Day' , 'Cannabis', 'Tobacco'],
            ['Mon', 5, 3],
            ['Tue', 2,5],
            ['Wed', 3,6],
            ['Thur' ,1, 1],
            ['Fri', 10, 8],
            ['Sat', 3, 0],
            ['Sun', 0,3]
            ]);
        
        var options2 = {
          title: 'Cannabis vs Tobacco',
          backgroundColor: { fill:'transparent' },
          'titleTextStyle': { 'color': '4BA66A', },
          legend: {position: 'none'},
     vAxis: {gridlines: {color: 'none', count: 5}}
        };


        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data1, options1);

        var chart = new google.visualization.LineChart(document.getElementById('chart_line'));
        chart.draw(data2, options2);
      }
</script>
</head>
<body>
<div class='firstblock'>
    <div class='padding'>
        <div class='left'>
            <h2>DRUGRECORD</h2>
        </div>
        <div class='right'>
            <h4>
              <?php
              echo $this->Html->link('login', array('controller' => 'users', 'action' => 'login'));
              echo '&nbsp&nbsp&nbsp';
              echo $this->Html->link('register', array('controller' => 'users', 'action' => 'add'));
              echo '&nbsp&nbsp&nbsp';
              echo $this->Html->link('records', array('controller' => 'records', 'action' => 'index'));
              ?>
            </h4>
        </div>
        <div class='clear'></div>
    </div>
        <div id='chart_div' style='margin:0 auto;height:70%; min-height:70%; width:900px;' ></div>
</div>
<div class='secondblock'>
    <div class='container'>
        <div class='left colSmallMed'>
            <h3>Anonymity</h3>
            </br>
            <span class='smallx'>No personal information of yours is stored on drugrecord.</span>
        </div>
        <div class='right center colSmallMed'>
            <?php echo $this->Form->create('Example'); ?>
            <?php echo $this->Form->input('exUser', array('label' => false, 'value' => 'Username')); ?>
            <?php echo $this->Form->input('exPass', array('label' => false, 'type' => 'password' , 'value' => 'no,dont,hack,this,tnx')); ?>
            <?php echo $this->Form->end(); ?>
        </br>
            <span class='smallx'>That's it.</span>
        </div>
        <div class='clear'></div>
    </div>
</div>
<div class='secondblock' style='border:1px; border-color:#5AAB5A; border-top-style:solid;'>
    <div class='container'>
        <div class='left colSmallMed'>
            <h3>Statistics</h3>
            </br>
            <span class='smallx'>While logging your information you will be able to access graphs and charts that will show you interesting statistics on your drug use.</span>
        </div>
        <div class='right center colSmallMed'>
            <div id='chart_line'></div>
        </div>
        <div class='clear'></div>
    </div>
</div>
<div class='secondblock' style='border:1px; border-color:#5AAB5A; border-top-style:solid;'>
    <div class='container'>
        <div class='left colSmallMed'>
            <h3>Simplicity</h3>
            </br>
            <span class='smallx'>Take five quick seconds to record your drug use. It's easy and fast.</span>
        </div>
        <div class='right center colSmallMed'>
            <div class='seconds'></div>
        </div>
        <div class='clear'></div>
    </div>
</div>
  <div id="container">
    <div id="content">
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
    </div>
  </div>
  <?php echo $this->element('sql_dump'); ?>
</body>
</html>
