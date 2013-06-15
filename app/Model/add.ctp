<div class='box'>
    <div class='padSmallx'>
        <h3>Registration</h3>
        </br>
            <span class='small'>For better anonymity please use a username and password you've never used before</span>

        <div class='padSmallx'>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
        	<?php echo $this->form->input('username', array('placeholder' => 'Username', 'label' => false));
        	echo $this->form->input('password', array('placeholder' => 'Password', 'label' => false));
        	echo $this->form->submit('Create Account', array('class' => 'button')); ?>
        </fieldset>
     	<?php echo $this->form->end(); ?>
        </div>
        </br>
       	</br>
    </div>
</div>