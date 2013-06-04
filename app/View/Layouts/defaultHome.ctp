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
</head>
<body>
<div class='nav'>
    <div class='padSmallx'>
      <div class='left'>
        <h5>&nbsp; <span class='white'><?php echo $this->Html->link($cakeDescription, array('controller' =>'fronts', 'action' => 'index')); ?></span></h5>
      </div>
      <div class='right'>
        <h5><span class='white'><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></span></h5>
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
