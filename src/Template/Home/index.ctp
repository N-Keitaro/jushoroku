<?php
	use Cake\Datasource\ConnectionManager;

	$this->autoRender = false;

	// 検索情報を変数に代入
	$search_data = $this->request->getQuery('search');
	// 検索情報フラグ
	$search_flug = false;

	// 検索情報がGetで受信できかつそれが空文字でなければフラグをtrueにする
	if(isset($search_data)){
		if($search_data !== ""){
			$search_flug = true;
		}
	}
	
	// 初期値がない場合に空文字を与える
	if(!$search_flug) $search_data = "";

	// SQL文
	$sql = "SELECT * FROM jushoroku";
	// データベース接続情報を取得
	$connection = ConnectionManager::get('default');
	// ログ取得有効化
	$connection->logQueries(true);
	// SQL文の設定
	$data = $connection->query($sql)->fetchAll('assoc');
	// ログ取得無効化
	$connection->logQueries(false);

	/* 検索フォーム
	 * 1つのテキストボックスと1つのボタンを有する。
	 * ボタンをクリックすると、テキストエリアの文字を同ページに送信する。
	 * Getで受け取った検索情報をテキストエリアに保存する。
	 */
	echo $this->Form->create('.', ['type' => 'get', 'url' => '/Home']);
	echo "<p class = \"search\">";
	echo $this->Form->control('search', ['default' => $search_data, 'label' => "ふりがな検索："]);
	echo $this->Form->submit('検索', ['class' => 'search_button']);
	echo "</p>";
	echo $this->Form->end();

	/* メッセージ表示枠
	 * 編集完了、削除完了等のメッセージがあれば表示する
	 */
	echo "<p class=\"message\">";
	$messagetext = $this->request->getData('messagetext');
	if(isset($messagetext)){
		echo htmlspecialchars($messagetext);
	}
	echo "</p>";

	/* データベース表示
	 * 列数6、行数1~(maxnum+1)のテーブル
	 * 1行目をカラムとし、2行目以降にデータベースから取得したデータを表示する。
	 * 1行目 ... 氏名、2行目 ... ふりがな、3行目 ... 郵便番号、4行目 ... 住所
	 * 5列目 ... 編集ボタン、6列目 ... 削除ボタン
	 * 編集ボタンは、その行のIDを、editページに送信する。
	 * 削除ボタンは、その行のIDを、deleteページに送信する。
	 */
	echo "<div class='outertable'>";
	echo "<table class = \"hometable\">";
	echo "<tr class='top_column'><th class='name_th'>氏名</th><th class='huri_th'>ふりがな</th><th class='post_th'>郵便番号</th><th class='adds_th'>住所</th><th class='edit_th'></th><th class='delete_th'></th></tr>";
	foreach($data as $element){
		// フラグがfalse、または検索単語が含まれるとき
		if(!$search_flug || strpos($element['furigana'], $search_data) !== false){
			echo "<tr>";

			echo "<td>";
			echo htmlspecialchars($element['name']);
			echo "</td>";

			echo "<td>";
			echo htmlspecialchars($element['furigana']);
			echo "</td>";

			echo "<td>";
			echo htmlspecialchars($element['post']);
			echo "</td>";

			echo "<td>";
			echo htmlspecialchars($element['address']);
			echo "</td>";

			echo "<td>";
			echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home/edit']);
			echo $this->Form->control('editid', ['type' => 'hidden', 'value' => $element['ID']]);
			echo $this->Form->submit('編集', ['class' => 'edit_button']);
			echo $this->Form->end();
			echo "</td>";

			echo "<td>";
			echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home/delete']);
			echo $this->Form->control('deleteid', ['type' => 'hidden', 'value' => $element['ID']]);
			echo $this->Form->submit('削除', ['class' => 'delete_button']);
			echo $this->Form->end();
			echo "</td>";

			echo "</tr>";
		}
	}
  	echo "</table>";
	echo "</div>";

	/* 新規作成ボタン
	 * 新規登録画面へのリンク。
	 * 上限値maxnumに達しているなら、同ページにメッセージを送信する。
	 */
	if(count($data) >= $maxnum){
		echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home']);
		echo $this->Form->control('messagetext', ['type' => 'hidden', 'value' => "登録数が上限に達しています(上限：{$maxnum})"]);
		echo $this->Form->submit('新規登録', ['class' => 'regist_button']);
		echo $this->Form->end();
	}
	else{
		echo $this->Form->create('.', ['type' => 'post', 'url' => '/Home/regist']);
		echo $this->Form->submit('新規登録', ['class' => 'regist_button']);
		echo $this->Form->end();
	}
