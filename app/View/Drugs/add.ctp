<div class='box'>
    <div class='padSmallx'>
        <span class='smallx'>
            Using this form will add your drug to the list of available drugs that you can select when adding a record.
        </br>
        </br>
            Adding a drug name to the list is a temporary feature. Please correctly name, and format your drug. Any incorrectly named drugs will either be edited or completely deleted if inproperly formatted.
        </br>
        </br>
            Formatting Examples:</br>
            Cannabis</br>
            4-aco-DMT</br>
            MXE
        </span>
        <div class='padSmallx'>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('Drug'); ?>
        <fieldset>
            <?php echo $this->Form->input('drug', array('placeholder' => 'Drug', 'label' => false,'type' => 'text'));
            ?>
            </br>
            </br>
            <?php
            echo $this->Form->submit('Submit', array('class' => 'button')); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
        </div>
        </br>
        </br>
    </div>
