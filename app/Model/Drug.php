<?php
class Drug extends AppModel{
	public $actsAs = array('Containable');
	public $hasMany = array('RecordDrug');

    function drugList(){
        $records = array();
        $records = $this->find('list', 
            array('fields' => array('id', 'drug')));
        return $records;
    }

}
