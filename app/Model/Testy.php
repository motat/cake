<?php
class Test extends AppModel {
    public $helpers = array('Html', 'Form');


    public function index(){
        $this->set('test', $this->Post->find('all'));
    }
}