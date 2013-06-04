<h2>Add a Post</h2>
<?php
echo $this->Form->create('Post', array('action'=>'add'));
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->end('Add to Record');
?>