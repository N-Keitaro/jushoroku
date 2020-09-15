<?php
	use Cake\Datasource\ConnectionManager;

	$this->autoRender = false;

	$id = $this->request->getData('deleteid');
		
	if(!isset($id)){
		header("Location:index");
		exit;
	}

	$sql_e = "SELECT * FROM jushoroku WHERE ID = {$this->request->getData('deleteid')}  ";
	$connection_e = ConnectionManager::get('default');

	$data_e = $connection_e->query($sql_e)->fetchAll('assoc');

	$this->autoRender = false;

	/* メッセージ表示枠
	 * 登録失敗、エラー等のメッセージがあれば表示する
	 */
	echo "<p class = \"message\">";
	$message_e = $this->request->getData('message_e');
	if(isset($message_e)){
		echo htmlspecialchars($message_e);
	}
	echo "</p>";

	echo "<table class = \"hometable\">";
	echo "<tr class='top_column'><th class='name_th'>氏名</th><th class='huri_th'>ふりがな</th><th class='post_th'>郵便番号</th><th class='adds_th'>住所</th></tr>";
	foreach($data_e as $element){
		echo "<tr>";
		echo "<td>{$element['name']}</td>";
		echo "<td>{$element['furigana']}</td>";
		echo "<td>{$element['post']}</td>";
		echo "<td>{$element['address']}</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	echo "<p class = \"message\">本当に削除しますか？</p>";

	echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home/deleteCheck']);
	echo $this->Form->control('deleteid', ['type' => 'hidden', 'value' => $id]);
	echo $this->Form->submit('削除', ['class' => 'regist_button']);
	echo $this->Form->end();

	echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home']);
	echo $this->Form->submit('戻る', ['class' => 'return_button']);
	echo $this->Form->end();
