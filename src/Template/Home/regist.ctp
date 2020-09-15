<?php

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

	$name_em = "";
	$hira_em = "";
	$post_em = "";
	$address_em = "";

	if($this->request->getData('name_em') !== null){
		$name_em = $this->request->getData('name_em');
	}

	if($this->request->getData('hira_em') !== null){
		$hira_em = $this->request->getData('hira_em');
	}

	if($this->request->getData('post_em') !== null){
		$post_em = $this->request->getData('post_em');
	}

	if($this->request->getData('address_em') !== null){
		$address_em = $this->request->getData('address_em');
	}


	echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home/registCheck']);
	echo "<table class = 'hometable'>";
	if($this->request->getData('name_ec') !== null){
		$name_ec = $this->request->getData('name_ec');
	}
	else $name_ec = "";

	if($this->request->getData('hira_ec') !== null){
		$hira_ec = $this->request->getData('hira_ec');
	}
	$hira_ec = "";
	
	if($this->request->getData('post_ec') !== null){
		$post_ec = $this->request->getData('post_ec');
	}
	$post_ec = "";

	if($this->request->getData('address_ec') !== null){
		$address_ec = $this->request->getData('address_ec');
	}
	$address_ec = "";

	echo "<tr><td class='ed_re_td'>";
	echo "氏名";
	echo "</td>";
	echo "<td class='ed_re_re_emp'>";
	echo $this->Form->control('name_ec', ['default' => $name_ec, 'label' => ""]);
	echo "</td>";
	echo "<td class='ed_re_re_emp errer_td'>";
	if(isset($name_em)){
		echo htmlspecialchars($name_em);
	}
	echo "</td></tr>";

	echo "<tr><td class='ed_re_td'>";
	echo "ふりがな";
	echo "</td>";
	echo "<td class='ed_re_re_emp'>";
	echo $this->Form->control('hira_ec', ['default' => $hira_ec, 'label' => ""]);
	echo "</td>";
	echo "<td class='ed_re_re_emp errer_td'>";
	if(isset($hira_em)){
		echo htmlspecialchars($hira_em);
	}
	echo "</td></tr>";

	echo "<tr><td class='ed_re_td'>";
	echo "郵便番号（***-****）";
	echo "</td>";
	echo "<td class='ed_re_re_emp'>";
	echo $this->Form->control('post_ec', ['default' => $post_ec, 'label' => ""]);
	echo "</td>";
	echo "<td class='ed_re_re_emp errer_td'>";
	if(isset($post_em)){
		echo htmlspecialchars($post_em);
	}
	echo "</td></tr>";

	echo "<tr><td class='ed_re_td'>";
	echo "住所";
	echo "</td>";
	echo "<td class='ed_re_re_emp'>";
	echo $this->Form->control('address_ec', ['default' => $address_ec, 'label' => ""]);
	echo "</td>";
	echo "<td class='ed_re_re_emp errer_td'>";
	if(isset($address_em)){
		echo htmlspecialchars($address_em);
	}
	echo "</td></tr>";

	echo "</table>";
	echo $this->Form->submit('新規登録', ['class' => 'regist_button']);
	echo $this->Form->end();
	echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home']);
	echo $this->Form->submit('戻る', ['class' => 'return_button']);
	echo $this->Form->end();
