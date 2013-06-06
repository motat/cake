<?php
class FrontsController extends AppController {

	var $name = 'Fronts';
	var $layout = 'frontpage';

	public function index(){
		$this->loadModel('Record');
		$this->set('records', $this->Record->find('all'));
		$this->set('title_for_layout', 'Drugrecord');
		//Get Data for PieChart
        $this->Record->virtualFields['sum'] ='COUNT(*)';
        $records=$this->Record->find('list', 
            array('fields' => array('drug_id', 'sum'),
                'group'  => 'drug_id'));
        $this->set('output',$records);
	}
    function beforeFilter(){
        $this->Auth->allow('index');
    }
}