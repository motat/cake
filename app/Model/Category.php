<?php
class Category extends AppModel{
	public $actsAs = array('Containable');
	public $hasMany = array('Drug');


}
