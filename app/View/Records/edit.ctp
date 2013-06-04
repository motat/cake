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
        <h4>Edit</h4>
        <div class='padSmallx'>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('Record'); ?>
        <fieldset>
            <?php echo $this->Form->input('dose_date', array('placeholder' => '2013-1-07', 'label' => false,'type' => 'text', 'id' =>'datepicker'));
            echo $this->Form->input('compound', array('placeholder' => 'Substance', 'label' => false, 'id' => 'autocomplete')); ?>
            <div class='colLarge left'>
            <?php
            echo $this->Form->input('dose', array('placeholder' => 'Dose', 'label' => false)); ?>
            </div>
            <div class='colSmall right'>
            <?php
            echo $this->Form->input('unit', array('placeholder'=>'Unit', 'label' => false,'id' => 'autocompleteunit')); ?>
            </div>
            <div class='clear'></div>
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
    $( "#autocomplete" ).autocomplete({
        source: [ 
            'LSD', 
            'Mushrooms', 
            'Mescaline', 
            'DMT', 
            'Spice', 
            'DOx Family', 
            'DXM HBr', 
            'DXM Polysterix', 
            'MXE', 
            'Ketamine', 
            'Cocaine', 
            'Methamphetamine', 
            'Amphetamine',
            'Opioid',
            'Heroin',
            'Benzo',
            'Alcohol',
            'Gabapentin',
            'Zolpidem',
            'MDMA',
            'Cannabis',
            'BHO',
            '2c series',
            'NBOMe series',
            'Tobacco',
            'Cigarette',
            '5-meo-DMT',
            '4-ho-MET',
            '4-ho-MIPT',
            '4-aco-DMT',
            'Methylone',
            '6-APB',
            'Valium',
            'Diazepam',
            'Xanax',
            'Alprazolam'
        ]
    });
    $( "#autocompleteunit" ).autocomplete({
        source: [ 
            'mg',
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