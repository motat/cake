<?php
App::import('component' , 'CakeSession');
class Record extends AppModel {
    public $actsAs = array('Containable');
    public $helpers = array('Html', 'Form', 'Session');
    public $hasMany = array('RecordDrugUnit');

    public function index(){
        $this->set('title_for_layout', 'Drugrecord');
    }

    function recordGrab() {
        /*-----
        * Currently using pagination to do this
        * find. Try and figure out a way to put
        * the operation in a model again
        */
        $records = array();
        $records=$this->RecordDrugUnit->find('list', 
            array(
                'fields' => 
                    array(
                        'Record.id',
                        'Record.dose_date',
                        'Drug.drug',
                        'Record.dose',
                        'Unit.unit',
                        'Record.title',
                        'Record.report'
                    ),
                'contain' => array('Drug', 'Record','Unit'),
                'order' => array('Record.dose_date' => 'desc'),
                'conditions' => array('Record.user_id' => CakeSession::read('Auth.User.id'))
            )
        );
        return $records;
    }

    function pieChart($limit = null, $conditions = null) {
        //Get Data for PieChart
        $this->RecordDrugUnit->virtualFields['sum'] ='COUNT(*)';
        $records = array();
        $records=$this->RecordDrugUnit->find('list',
            array(
                'conditions' => $conditions,
                'fields' => array('Drug.drug', 'sum'),
                'order' => array('sum' => 'desc'),
                'limit' => $limit,
                'contain' => array( 'Drug', 'Record', 'Unit'),
                'group'  => 'Drug.Drug'
                ));
        return $records;
    }


    public function isOwnedBy($record, $user) {
    	return $this->field('id', array('id' =>$record, 'user_id' => $user)) === $record;
    }
}