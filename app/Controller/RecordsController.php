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
            'Unit.unit',
            'Record.title',
            'Record.report'
        )
    );

    function index() {
        $this->loadModel('Record');
        $this->loadModel('RecordDrugUnit');
        $this->loadModel('Unit');
        
        /*----
        * Main Log
        ----*/
        //$recordGrab = $this->Record->recordGrab();
        //$this->set('log' , $recordGrab);
        $this->paginate = array(
            'conditions' => array(
                'Record.user_id' => $this->Session->read('Auth.User.id')    
            ),
            'limit' => 5,
            'contain' => array('Drug', 'Record', 'Unit'),
            'order' => array('Record.dose_date' => 'desc')
        );
        $log = $this->paginate('RecordDrugUnit');
        $this->set(compact('log'));
        /*----
        * pieChart and doseTotals
        ----*/
        $limit='50';
        $conditions = array('Record.user_id' => $this->Session->read('Auth.User.id'));
        $pieChart = $this->Record->pieChart($limit,$conditions);
        $this->set('output',$pieChart);

        $this->RecordDrugUnit->virtualFields['sum'] ='ROUND(SUM(RecordDrugUnit.dose)/Unit.conversion,1)';
        $units=$this->RecordDrugUnit->find('threaded',
            array(
                'conditions' => array('Record.user_id' => $this->Session->read('Auth.User.id')),
                'fields' => array('sum','Drug.drug', 'Unit.unit','id'),
                'order' => array('sum' => 'desc'),
                'contain' => array( 'Drug', 'Record', 'Unit' ),
                'group'  => 'Drug.Drug'
                ));
        //$units['RecordDrugUnit']['sum'] = $units['RecordDrugUnit']['sum'] / $units['Unit']['conversion']
        debug($units);
        $this->set('units',$units);
    }


    public function add() {
        $this->loadModel('RecordDrugUnit');
        $this->loadModel('Drug');
        $this->loadModel('Unit');
        if ($this->request->is('post')) {
            $this->Record->create();
            $conv_val = $this->Unit->find('first',
            array(
                'conditions' => array(
                    'id' => $this->request->data['RecordDrugUnit']['unit_id']),
                'fields' => array('conversion')
                ));
            $this->request->data['RecordDrugUnit']['dose'] = (int)$this->request->data['RecordDrugUnit']['dose'] * (float)$conv_val['Unit']['conversion'];
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($this->RecordDrugUnit->saveAssociated($this->request->data, array('deep' => TRUE))) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
        
        /*----
        * drugList
        ----*/
        $drugList = $this->Drug->drugList();
        $this->set('drugList',$drugList);
        
        /*----
        * unitList
        ----*/
        $unitList = $this->Unit->unitList();
        $this->set('unitList',$unitList);

    }

    function edit ($id = NULL) {
        $this->loadModel('RecordDrugUnit');
        $this->loadModel('Drug');
        $this->loadModel('Unit');
    	if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $record=$this->RecordDrugUnit->findByrecordId($id);
        if(!$record) {
            throw new NotFoundException(__('Invalid post'));
        }
        /*----
        * Divide dose by
        * associated conversion
        -----*/
        $record['RecordDrugUnit']['dose'] = $record['RecordDrugUnit']['dose'] / $record['Unit']['conversion'];
        if($this->request->is('post')) {
            $this->request->data['Record']['id'] = $id;
            $this->request->data['RecordDrugUnit']['id'] = $id;
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            /*----
            * Multiply dose by
            * associated conversion
            -----*/
            $conv_val = $this->Unit->find('first',
            array(
                'conditions' => array(
                    'id' => $this->request->data['RecordDrugUnit']['unit_id']),
                'fields' => array('conversion')
                ));
            $this->request->data['RecordDrugUnit']['dose'] = (int)$this->request->data['RecordDrugUnit']['dose'] * (int)$conv_val['Unit']['conversion'];
            if ($this->RecordDrugUnit->saveAssociated($this->request->data, array('deep' => TRUE))) {
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
        
        /*----
        * unitList
        ----*/
        $unitList = $this->Unit->unitList();
        $this->set('unitList',$unitList);

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
