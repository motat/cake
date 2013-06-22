<?php
class Unit extends AppModel{
	public $actsAs = array('Containable');
	public $hasMany = array('RecordDrugUnit' , 'Drug');

    function unitList(){
        $records = array();
        $records = $this->find('list', 
            array(
            	'fields' => array(
            		'Unit.id',
            		'Unit.unit'
            		)
            	)
            );
        debug($records);
        return $records;
    }

    /*function divideDose (){
        $dose = array();
        $dose = $this->find('first',
            array(
                'fields' => 'conversion',
                'conditions' => ))
    }*/
}
