<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="scripts/js.js"></script>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script>
      $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-m-dd' });
      });

    </script>

<div class='box'>
    <div class='padSmallx'>
        <div class='padSmallx'>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('Record'); ?>
        <fieldset>
            <?php echo $this->Form->input('Record.dose_date', array('placeholder' => 'Date of Dose', 'label' => false,'type' => 'text','id' =>'datepicker'));
            echo $this->Form->input('RecordDrug.drug_id', array('placeholder' => 'Substance', 'options'=>$drugList,'label' => false,'type' => 'select')); ?>
            <div class='colLarge left'>
            <?php
            echo $this->Form->input('Record.dose', array('placeholder' => 'Dose', 'label' => false)); ?>
            </div>
            <div class='colSmall right'>
            <?php
            echo $this->Form->input('Record.unit', array('placeholder'=>'Unit', 'label' => false,'id' => 'autocompleteunit')); ?>
            </div>
            </br>
            <?php 
                echo $this->Form->input('Record.title', array('placeholder' => 'Title', 'label' => false,'type' => 'text'));
                echo $this->Form->input('RecordDrug.report', array('placeholder' => 'Your Report','label' => false,'type' => 'textarea')); 
            ?>
            <div class='clear'></div>
            </br>
            <span class='small'><?php echo $this->Html->link('Less recording options', array('action' => 'add')); ?>
            </br>
            </br>
            <?php echo $this->Html->link('Drug missing?', array('controller'=>'drugs', 'action'=>'add')); ?>
            </span>
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

<script>

    $( "#autocompleteunit" ).autocomplete({
        source: [ 
            {'label':'mg', 'value':'mg', 'id':'1'},
            'ml',
            'g',
            'ug',
            'mg',
            'oz',
            'dab',
            'box'
        ]
    });
</script>