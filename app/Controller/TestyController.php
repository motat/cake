<?php
class TestyController extends AppController {

	var $name = 'Testy';
	var $layout = 'frontpage';

	public function index(){
		$this->set('title_for_layout', 'Drugrecord');
	}
}