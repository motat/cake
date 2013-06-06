<?php
class Record extends AppModel {
    public $helpers = array('Html', 'Form');



    public function index(){
        $this->set('records', $this->Post->find('all'));
    }

    public function graph(){
    }

    public function isOwnedBy($record, $user) {
    	return $this->field('id', array('id' =>$record, 'user_id' => $user)) === $record;
    }
}