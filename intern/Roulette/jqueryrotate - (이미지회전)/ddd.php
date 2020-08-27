<html>
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
</head>
<?php
	$userid1 = $_POST["userid1"];
	$userid2 = $_POST["userid2"];
	$userid3 = $_POST["userid3"];
?>
<body>
	<ul>
		<li>관리자 아이디 : <?= $userid1?></li>
		<li>관리자 아이디 : <?= $userid2?></li>
		<li>관리자 아이디 : <?= $userid3?></li>
	</ul>
</body>
</html>
