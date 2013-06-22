<?php
class FrontsController extends AppController {
    public $helpers = array('Html', 'Form');
	var $name = 'Fronts';
	var $layout = 'frontpage';

	public function index(){
        $this->loadModel('Record');
        $this->loadModel('RecordDrug');
        
        /*----
        * global pieChart
        ----*/
        $limit = 20;
        $pieChart = $this->Record->pieChart($limit);
        $this->set('output',$pieChart); 
	}

    function beforeFilter(){
        $this->Auth->allow('index');
        $this->set('authUser', $this->Auth->user());
    }
}