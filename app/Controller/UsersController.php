<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $layout = 'defaultHome';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect(array('controller' => 'records', 'actions' => 'index')));
	        } else {
            //if user can't login, repassword his cock

            //Returning; trying to figure out how to make it so 
            //when a user trys to login and fails because of incorrect
            //encryption, it then trys to update his User table with
            //the correctly encrypted password. Cocks LOL
                if ($this->request->is('post')) {
                    $id=$this->User->find('list', 
                        array('fields' => array( 'id'),
                            'conditions' => array('username' => $this->data['User']['username'])
                            ));
                    $this->User->id = $id;
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash(__('Your password has been updated.'));
                        $this->redirect(array('action' => 'login'));
                    } else {
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                    }
                }
	        }
	    }
	}

    public function relog() {

    }

    public function logout () {
    	$this->redirect($this->Auth->logout());
    }

	public function index() {
		$this->User->recursive=0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized ($user) {
        if(in_array($this->action, array('logout','index'))) {
            return true;
        }
        return false;
    }
}
