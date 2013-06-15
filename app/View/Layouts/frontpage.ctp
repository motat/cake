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
        echo $this->Html->script('knockout-2.2.1.js');
        echo $this->Html->script('globalize.js');
        echo $this->Html->script('dx.chartjs.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
    <script type="text/javascript">
        var pieChartDataSource = [
            <?php
            foreach($output as $compound => $sum){
              echo "{category: '".$compound."', value: ".$sum."}, ";
            }      
            ?>      
        ];
   
        $(function () {             
            $("#pieChartContainer").dxPieChart({
                palette: 'Harmony Light',
                series: {
                    argumentField: 'category',
                    valueField: 'value',
                    label: {
                        visible: true,
                        connector: {
                            visible: true
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    percentPrecision:2,
                    customizeText: function (value) {
                        return value.percentText;
                    }
                },
                title: {
                    text: 'Users overall drug use'
                },
                legend: {
                    horizontalAlignment: 'center',
                    verticalAlignment: 'bottom'
                },
                dataSource: pieChartDataSource,
               
            });
        });
    </script>
</head>
<body>

<div class='firstblock'>
    <div class='padding'>
        <div class='left'>
            <h2>DRUGRECORD</h2>
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
            </h5>
        </div>
        <div class='clear'></div>
    </div>
    <div id="pieChartContainer" style="max-width:600px;height: 600px; margin:0 auto;"></div>
    <div class='contArrow'>
      <div id='arrow'>
      </div>
    </div>
    </div>
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
