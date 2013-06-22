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
        echo $this->Html->script('jquery-1.9.1.min.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
$(function () {
    $('#pieChart').highcharts({
        chart: {
            backgroundColor: '#4BA66A',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '',
            style: {
                fontWeight: 'bold',
                fontSize: '25px',
                fontFamily: 'CurThick',
                color: '#186C35'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#C1DBC1',
                    style: {
                        fontSize: '16px'
                    },
                    connectorColor: '#000000',
                    formatter: function() {
                        if(this.y > 1)
                               return '<b>'+ this.point.name +'</b>: '+ this.y; 
                          else
                               return null //empty datalabel
                    }
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Drug use',
            data: [
                <?php
                foreach($output as $compound => $sum){
                    echo "['".$compound."', ".$sum."], ";
                }      
                ?>  
            ]
        }]
    });
});
$(function () {
        $('#lineChart').highcharts({
            chart: {
                backgroundColor: '#C1DBC1',
                type: 'line',
            },
            title: {
                text: 'Tobacco vs Cannabis',
            },
            xAxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            legend: {
                layout: 'vertical',
                verticalAlign: 'top',
                y: 20,
                borderWidth: 0
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Tobacco',
                data: [1,3,2,2,4,1,2]
            }, {
                name: 'Cannabis',
                data: [5,3,2,2,1,3,4]
            }]
        });
    });
    </script>
</head>
<body>

<div class='firstblock'>
    <div class='padding'>
        <div class='left'>
            <h2>DRUGRECORD</h2>
            <span class='smallx'>beta</span>
        </div>
        <div class='right'>
            <h5>
                <?php
                    if (!$authUser) {
                        echo "
                            <div class='linkBox'>
                                "; echo $this->Html->link('login', array('controller' => 'users', 'action' => 'login'));
                        echo "        
                            </div>
                            <div class='linkBox'>";
                                echo $this->Html->link('register', array('controller' => 'users', 'action' => 'add'));
                        echo "</div>";
                    } else {
                        echo "
                            <div class='linkBox'>";
                                echo $this->Html->link('records', array('controller' => 'records', 'action' => 'index'));
                        echo "
                            </div>
                            ";
                    }
              ?>
                <div class='linkBox'>
<?php echo $this->Html->link('public', array('controller' => 'public', 'action' => 'index')); ?>
                </div>
                <div class='linkBox' style='background-color:#C1DBC1'>
<?php echo $this->Html->link('blog', array('controller' => 'blogs', 'action' => 'index')); ?>
                </div>
            </h5>
        </div>
        <div class='clear'></div>
    </div>
    <div id="pieChart" style="max-width:700px;height: 700px; margin:0 auto;"></div>
    <div class='contArrow'>
        <a href='#1'>    
            <div class='arrow'>
            </div>
        </a>
    </div>
    </div>
</div>
<div id = '1' class='secondblock'>
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
            <div id='lineChart' style='height:300px; width:100%;'></div>
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
