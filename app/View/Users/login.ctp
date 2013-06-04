<div class='box'>
    <div class='padSmallx'>
        <h3>Login</h3>
        </br>
        <div class='padSmallx'>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php echo $this->Form->input('username', array('placeholder' => 'Username', 'label' => false));
            echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => false));
            echo $this->Form->submit('Submit', array('class' => 'button')); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
        </div>
        </br>
        </br>
        <span class='smallx'><a href='problems.php?p=login'>Problems logging in?</a></span>
    </div>
