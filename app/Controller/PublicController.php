<?php
class PublicController extends AppController {

	var $name = 'Public';
	var $layout = 'defaultHome';

    public function index() {

    }
    
    function beforeFilter(){
        $this->Auth->allow('index');
        $this->set('authUser', $this->Auth->user());
    }
}
