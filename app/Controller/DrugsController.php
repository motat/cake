<?php
class DrugsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'HighCharts.HighCharts');

    var $name = 'Drugs';
    var $layout = 'defaultHome';

    function index() {
       
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Drug->create();
            if ($this->Drug->save($this->request->data)) {
                $this->Session->setFlash('Your drug has been added to the list.');
                $this->redirect(array('controller' => 'records', 'action' => 'add'));
            } else {
                $this->Session->setFlash('Unable to add your drug.');
            }
        }
    }
    public function isAuthorized ($user) {
        if(in_array($this->action, array('add'))) {
            return true;
        }
    }

}