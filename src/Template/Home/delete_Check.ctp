<?php
	use Cake\Datasource\ConnectionManager;

	$this->autoRender = false;
	
	$sql = "DELETE FROM jushoroku WHERE ID = {$this->request->getData('deleteid')} ";
	$connection = ConnectionManager::get('default');

	echo "<script type='text/javascript'>";
	echo "document.getElementById('bodyid').setAttribute('onload', 'document.all.autobutton.click()');";
	echo "</script>";
	echo "<style>";
	echo ".submit { display:none;}";
	echo "</style>";


	$connection->query($sql);

	echo $this->Form->create('1', ['type' => 'post', 'url' => '/Home']);
	echo $this->Form->control('messagetext', ['type' => 'hidden', 'value' => "削除完了"]);
	echo $this->Form->control('autobutton', ['type' => 'submit'] );
	echo $this->Form->end();
	
	
