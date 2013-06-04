<?php
class PostsController extends AppController {
	var $name = 'Posts';
	function index() {
		$this->Post->find('all');
		$this->set('posts', $this->Post->find('all'))
	}

	function hello_world() {

	}

}