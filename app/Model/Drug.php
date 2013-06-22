<?php
class Drug extends AppModel{
	public $actsAs = array('Containable');
	public $hasMany = array('RecordDrugUnit');
	public $belongsTo = array('Category', 'Unit');

    function drugList(){
        $records = array();
        $records = $this->find('list', 
            array(
            	'fields' => array(
            		'Drug.id',
            		'Drug.drug',
            		'Category.category'
            		),
            	'contain' => array('Category')
            	)
            );
        debug($records);
        return $records;
    }
   

}
