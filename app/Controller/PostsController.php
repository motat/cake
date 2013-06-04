<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $layout = 'defaultHome';

	function index() {
		$this->Post->find('all');
		$this->set('posts', $this->Post->find('all'));
		$this->set('title_for_layout', 'Drugrecord');
	}

	function view($id = NULL) {
		$this->set('post', $this->Post->read(NULL, $id));
	}

	function add() {
		if(!$this->request->is('post')) {
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash('Log added to your records');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Log was not added to records, please try again.');
			}
		}
	}

	function edit($id = NULL) {
		if(!$this->request->is('post')) {
			$this->data = $this->Post->read(NULL, $id);
		} else {
			if($this->Post->save($this->request->data)) {
				$this->Session->setFlash('The log has been updated');
				$this->redirect(array('action'=>'view', $id));
			}
		}
	}

	function delete($id = NULL) {
		$this->Post->delete($id);
		$this->Session->setFlash('Your log has been delete');
		$this->redirect(array('action'=>'index', $id));
	}
}