<?php
App::import('Vendor','Chart');
class RecordsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session');

    var $name = 'Records';
    var $layout = 'defaultHome';
    public $paginate = array(
        'fields' => array(
            'Record.id',
            'Record.dose_date',
            'Drug.drug',
            'Record.dose',
            'Record.unit',
            'Record.title',
            'Record.report'
        )
    );

    function index() {
        $this->loadModel('Record');
        $this->loadModel('RecordDrug');
        
        /*----
        * Main Log
        ----*/
        //$recordGrab = $this->Record->recordGrab();
        //$this->set('log' , $recordGrab);
        $this->paginate = array(
            'conditions' => array(
                'Record.user_id' => $this->Session->read('Auth.User.id')    
            ),
            'limit' => 8,
            'contain' => array('Drug', 'Record'),
            'order' => array('Record.dose_date' => 'desc')
        );
        $log = $this->paginate('RecordDrug');
        $this->set(compact('log'));

        /*----
        * pieChart and doseTotals
        ----*/
        $conditions = array('Record.user_id' => $this->Auth->user('id'));
        $pieChart = $this->Record->pieChart($conditions);
        $this->set('output',$pieChart); 

    }


    public function add() {
        $this->loadModel('RecordDrug');
        $this->loadModel('Drug');
        if ($this->request->is('post')) {
            $this->Record->create();
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($this->RecordDrug->saveAssociated($this->request->data, array('deep' => TRUE))) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
        $this->loadModel('Drug');
        
        /*----
        * drugList
        ----*/
        $drugList = $this->Drug->drugList();
        $this->set('drugList',$drugList);


    }

    function edit ($id = NULL) {
        $this->loadModel('RecordDrug');
        $this->loadModel('Drug');
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

        /*----
        * drugList
        ----*/
        $drugList = $this->Drug->drugList();
        $this->set('drugList',$drugList);
    }

    function delete($id = NULL) {
        if($this->request->data['Record']['user_id'] = $this->Auth->user('id')){
        	$this->Record->delete($id);
        	$this->Session->setFlash('Your log has been deleted');
        	$this->redirect(array('action' =>'index', $id));
        }
        echo 'penis';
    }

    public function isAuthorized ($user) {
        if(in_array($this->action, array('add','addmore','index'))) {
            return true;
        }
        if(in_array($this->action, array('edit','delete'))){
            $recordId = $this->request->params['pass'][0];
            if ($this->Record->isOwnedBy($recordId,$user['id'])){
                return true;
            }
        }
        return false;
    }

}
