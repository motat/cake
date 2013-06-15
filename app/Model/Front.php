<?php
class Front extends AppModel {
    public $helpers = array('Html', 'Form');


    public function index(){
		$this->loadModel('Record');
		$this->set('records', $this->Record->find('all'));
		$this->set('title_for_layout', 'Drugrecord');
    }
}