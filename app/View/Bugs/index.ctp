<div class='box'>
    <div class='padSmallx'>
        <div class='padSmallx'>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('Bug'); ?>
        <fieldset>
        <span class='smallx'>If you are missing any data, your login doesn't work, or experiencing any problem please post them below and I will fix them personally for you.</span>
            <?php 
            echo $this->Form->input('bug', array('placeholder'=>'Bug','label' => false,'type' => 'text'));
             ?>
            </br>
            </br>
            </br>
            <?php
            echo $this->Form->submit('Submit bug', array('class' => 'button')); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
        </div>
        </br>
        </br>
    </div>