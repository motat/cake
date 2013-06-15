<?php
class BugsController extends AppController {

	var $name = 'Bugs';
	var $layout = 'defaultHome';

	public function index(){
    if ($this->request->is('post')) {
            $this->Bug->create();
            $this->request->data['Bug']['user_id'] = $this->Auth->user('id');
            if ($this->Bug->save($this->request->data)) {
                $this->Session->setFlash('Your bug has been reported');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
	}

    function beforeFilter(){
        $this->Auth->allow('index');
    }
}