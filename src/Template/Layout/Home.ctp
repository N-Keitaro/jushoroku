<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0" />
	<title><?= h($title) ?></title>

<?php
	echo $this->Html->css('common.css');
?>

</head>
<body id = "bodyid">
	<div class = "header"></div>
	<div class = "title_text"><?= h($title) ?></div>
	<div class = "header_2"></div>

	<?= $this->fetch('content') ?>
	<div class = "footer"></div>
</body>
</html>
