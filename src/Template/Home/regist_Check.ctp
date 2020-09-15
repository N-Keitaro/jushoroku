<?php

	use Cake\Datasource\ConnectionManager;
	$this->autoRender = false;

	$id_up = $this->request->getData('editid_e');
	$name_up = $this->request->getData('name_ec');
	$hira_up = $this->request->getData('hira_ec');
	$post_up = $this->request->getData('post_ec');
	$address_up = $this->request->getData('address_ec');
		
	$sql = "insert into jushoroku values(0, '{$this->request->getData('name_ec')}', '{$this->request->getData('hira_ec')}', '{$this->request->getData('post_ec')}', '{$this->request->getData('address_ec')}')";
	$connection = ConnectionManager::get('default');

	$flug = true;

	$pattern = '/[^ぁ-んァ-ンーa-zA-ZＡ-Ｚ0-9一-０-９=＝・、,.|　| \-\r]+/u';
	$post_nump = '/[^0-9０-９]/u';
	$post_postp = '/[^―ー‐－\-]/u';

	$errer_name_m = "";
	$errer_hira_m = "";
	$errer_post_m = "";
	$errer_adds_m = "";

	$errer_name1 = "100文字以内で入力してください。";
	$errer_hira2 = "全てひらがなで入力してください。";
	$errer_hira1 = "100文字以内で入力してください。";
	$errer_post1 = "8文字で入力してください。(例：123-4567)";
	$errer_post2 = "次の書式で入力してください(例：123-4567)。";
	$errer_adds1 = "200文字以内で入力してください。";

	$errer_empty = "空欄になっています。";
	$errer_uniquetest = "使用できない文字が含まれています。";

	if(mb_strlen($name_up) > 100){
		$errer_name_m .= $errer_name1;
		$flug = false;
	}
	if(!isset($name_up) || $name_up == ""){
		$errer_name_m .= $errer_empty;
		$flug = false;
	}
	if(preg_match($pattern, $name_up)) {
		$errer_name_m .= $errer_uniquetest;
		$flug = false;
	}

	if(mb_strlen($hira_up) > 100){
		$errer_hira_m .= $errer_hira1;
		$flug = false;
	}
	if(!isset($hira_up) || $hira_up == ""){
		$errer_hira_m .= $errer_empty;
		$flug = false;
	}
	if(preg_match('/[^ぁ-んー|　| ]/u',$hira_up)) {
		$errer_hira_m .= $errer_hira2;
		$flug = false;
	}

	if(!isset($post_up) || $post_up == ""){
		$errer_post_m .= $errer_empty;
		$flug = false;
	}
	else if(mb_strlen($post_up) != 8 || (preg_match($post_nump, mb_substr($post_up, 0, 3) ) ) ||  (preg_match($post_postp, mb_substr($post_up, 3, 1))) ||  (preg_match($post_nump, mb_substr($post_up, 4, 4))) ){
		$errer_post_m .= $errer_post2;
		$flug = false;
	}
	else {
		$post_up = mb_convert_kana($post_up, "n");
		$post_up = mb_substr($post_up, 0, 3)."-".mb_substr($post_up, 4, 4);
	}

	if(mb_strlen($address_up) > 200){
		$errer_adds_m .= $errer_adds1;
		$flug = false;
	}
	if(!isset($address_up) || $address_up == ""){
		$errer_adds_m .= $errer_empty;
		$flug = false;
	}
	if(preg_match($pattern, $address_up)) {
		$errer_adds_m .= $errer_uniquetest;
		$flug = false;
	}



	echo "<script type='text/javascript'>";
	echo "document.getElementById('bodyid').setAttribute('onload', 'document.all.autobutton.click()');";
	echo "</script>";
	echo "<style>";
	echo ".submit { display:none;}";
	echo "</style>";

	if($flug){
		$connection->query($sql);

		echo $this->Form->create('1', ['type' => 'post', 'url' => '/Home']);
		echo $this->Form->control('messagetext', ['type' => 'hidden', 'value' => "登録完了"]);
		echo $this->Form->control('autobutton', ['type' => 'submit'] );
		echo $this->Form->end();
	}
	else {
		echo $this->Form->create('2', ['type' => 'post', 'url' => '/Home/regist']);

		echo $this->Form->control('name_ec', ['type' => 'hidden', 'value' => $name_up]);
		echo $this->Form->control('hira_ec', ['type' => 'hidden', 'value' => $hira_up]);
		echo $this->Form->control('post_ec', ['type' => 'hidden', 'value' => $post_up]);
		echo $this->Form->control('address_ec', ['type' => 'hidden', 'value' => $address_up]);

		echo $this->Form->control('name_em', ['type' => 'hidden', 'value' => $errer_name_m]);
		echo $this->Form->control('hira_em', ['type' => 'hidden', 'value' => $errer_hira_m]);
		echo $this->Form->control('post_em', ['type' => 'hidden', 'value' => $errer_post_m]);
		echo $this->Form->control('address_em', ['type' => 'hidden', 'value' => $errer_adds_m]);

		echo $this->Form->control('autobutton', ['type' => 'submit'] );
		echo $this->Form->end();
	}
