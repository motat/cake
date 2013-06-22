<?php
class BlogsController extends AppController {

	var $name = 'Blogs';
	var $layout = 'defaultHome';

    public function index() {

    }
    
    function beforeFilter(){
        $this->Auth->allow('index');
        $this->set('authUser', $this->Auth->user());
    }
}
