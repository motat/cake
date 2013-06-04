<?php
class RecordsController extends AppController {

    var $name = 'Records';
    var $layout = 'defaultHome';

    function index() {
        $this->Record->findAllByUserId($this->Auth->user('id'));
        $this->set('records', $this->Record->findAllByUserId($this->Auth->user('id')));
        $this->set('title_for_layout', 'Drugrecord');
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Record->create();
            if ($this->Record->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }


    function edit ($id = NULL) {
    	if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $record=$this->Record->findById($id);
        if(!$record) {
            throw new NotFoundException(__('Invalid post'));
        }

        if($this->request->is('post')) {
            $this->Record->id = $id;
            if ($this->Record->save($this->request->data)) {
                $this->Session->setFlash('Your log has been updated.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }

        if(!$this->request->data) {
            $this->request->data = $record;
        }
    }

    function delete($id = NULL) {
    	$this->Record->delete($id);
    	$this->Session->setFlash('Your log has been deleted');
    	$this->redirect(array('action' =>'index', $id));
    }

    function graph(){
        $this->Record->virtualFields['sum'] ='COUNT(*)';
        $grouped=$this->Record->find('list', 
            array('fields' => array('compound', 'sum'),
                'group'  => 'compound'));
        debug($grouped);
        $this->set('grouped_set', $grouped);
    }

	public function isAuthorized($user) {

	    // The owner of a post can edit and delete it
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $postId = $this->request->params['pass'][0];
	        if ($this->Post->isOwnedBy($postId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}
}