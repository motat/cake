<?php
class FrontsController extends AppController {

	var $name = 'Fronts';
	var $layout = 'default';

	public function index(){
		$this->loadModel('Record');
		$this->set('records', $this->Record->find('all'));
		$this->set('title_for_layout', 'Drugrecord');
	}
}