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

$cakeDescription = __d('cake_dev', 'Drugrecord');
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

		echo $this->Html->css('splash');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<BODY>    <div class='left padSmall'>
      <h4>Dr<span class='blue'>ug</span>record</h4>
    </div>
    <div class='right padSmall'>
      <h5>
      	<?php
      	if (!$loggedin) {
      		echo $this->Html->link('Login',array('controller' => 'users', 'action' => 'login')); ?> | <?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'add')); 
      	} else {
      		echo $this->Html->link('Records', array('controller' => 'records', 'actions' => 'index'));
      	}
      		?>
      	</h5>
    </div>
    <div class='clear'></div>
   	<div class='block'></div>
		<div class='colLarge'>
		<div id="container">
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
    </div>
		<div class='block'></div>
		<div class='block'></div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
