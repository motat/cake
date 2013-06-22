<?php
class RecordDrugUnit extends AppModel {
    public $actsAs = array('Containable');
	public $belongsTo = array(
		'Unit' => array(
			'foreignKey' => 'unit_id'
			),
		'Record' => array(
			'foreignKey' => 'record_id'
			),
		'Drug' => array(
			'foreignKey' => 'drug_id'
			)
		);
}