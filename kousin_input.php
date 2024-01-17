<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1518127-final';
const USER = 'LAA1518127';
const PASS = 'PASS0317';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

try {
	// データベースに接続し、エラーモードを例外に設定する
	$pdo = new PDO($connect, USER, PASS);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("データベース接続エラー：" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
	<link rel="stylesheet" href="css/kousin_input.css">
	<title>県情報</title>
</head>

<body>
	<section class="section">
		<div class="container">
			<h1 class="title">県情報更新画面</h1>
			<table class="table is-fullwidth">
				<tbody>
					<?php
					$pdo = new PDO($connect, USER, PASS);
					$sql = $pdo->prepare('select * from tourism where name=?');
					$sql->execute(array($_POST['id']));
					foreach ($sql as $row) {
						echo '<tr>';
						echo '<form class="columns is-vcentered" action="kousin_output.php" method="post">';
						echo '<td><div class="ken"><label class="label">県名</label></div></td>';
						echo '<td class="column">', $row['name'], '<input type="hidden" name="ken" value="', $row['name'], '"></td>';
						echo '<td><div class="ken"><label class="label">観光地名</label></div></td>';
						echo '<td class="column"><input class="input" type="text" name="kanko_name" value="', $row['kanko_name'], '"></td>';
						echo '<td><div class="ken"><label class="label">カテゴリ</label></div></td>';
						echo '<td class="column"><input class="input" type="text" name="category" value="', isset($row['category']) ? $row['category'] : '', '"></td>';
						echo '<td><div class="ken"><label class="label">名物</label></div></td>';
						echo '<td class="column"> <input class="input" type="text" name="Specialty" value="', $row['Specialty'], '"></td>';
						echo '<td><div class="ken"><label class="label">説明</label></div></td>';
						echo '<td class="column"> <input class="input" type="text" name="exp" value="', $row['exp'], '"></td>';
						echo '<td class="column"><input class="button is-success" type="submit" value="更新"></td>';
						echo '</form>';
						echo '</tr>';
						echo "\n";
					}
					?>
				</tbody>
			</table>
			<button class="button is-info" onclick="location.href='top.php'">トップへ戻る</button>
		</div>
	</section>
</body>

</html>