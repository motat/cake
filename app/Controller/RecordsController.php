<?php
App::import('Vendor','Chart');
class RecordsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'HighCharts.HighCharts');

    var $name = 'Records';
    var $layout = 'defaultHome';

    function index() {
        $this->Record->findAllByUserId($this->Auth->user('id'));
        $this->set('records', $this->Record->findAllByUserId($this->Auth->user('id')));
        $this->set('title_for_layout', 'Drugrecord');

        //Graph
        $this->Record->virtualFields['sum'] ='COUNT(*)';
        $records=$this->Record->find('list', 
            array('fields' => array('compound', 'sum'),
                'group'  => 'compound',
                'conditions' => array('user_id' => $this->Auth->user('id'))));
        $this->set('output',$records);
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->Record->create();
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
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


}