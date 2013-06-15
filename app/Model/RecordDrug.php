<?php
class RecordDrug extends AppModel {
    public $actsAs = array('Containable');
	public $belongsTo = array('Record', 'Drug');
}