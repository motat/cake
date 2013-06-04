<?php
class Post extends AppModel {

	var $name = 'Post';

	var $validate = array(
		'title'=>array(
			'title_must_not_be_blank'=>array(
				'rule'=>'notEmpty',
				'message'=>'This post is missing a title!'
			)
		)
	);
}