<?php
App::import('component' , 'CakeSession');
class Record extends AppModel {
    public $actsAs = array('Containable');
    public $helpers = array('Html', 'Form', 'Session');
    public $hasMany = array('RecordDrug');

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
        $records=$this->RecordDrug->find('all', 
            array(
                'fields' => 
                    array(
                        'Record.id',
                        'Record.dose_date',
                        'Drug.drug',
                        'Record.dose',
                        'Record.unit',
                        'Record.title',
                        'Record.report'
                    ),
                'contain' => array('Drug', 'Record'),
                'order' => array('Record.dose_date' => 'desc'),
                'conditions' => array('Record.user_id' => CakeSession::read('Auth.User.id'))
            )
        );
        return $records;
    }

    function pieChart($conditions = null) {
        //Get Data for PieChart
        $this->RecordDrug->virtualFields['sum'] ='COUNT(*)';
        $records = array();
        $records=$this->RecordDrug->find('list',
            array(
                'conditions' => $conditions,
                'fields' => array( 'Drug.drug', 'sum'),
                'contain' => array( 'Drug', 'Record' ),
                'group'  => 'Drug.Drug'
                ));
        return $records;
    }

    public function graph(){
    }

    public function test(){
    }

    public function isOwnedBy($record, $user) {
    	return $this->field('id', array('id' =>$record, 'user_id' => $user)) === $record;
    }
}