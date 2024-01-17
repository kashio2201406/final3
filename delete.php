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
    <title>県情報</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <button class="button is-info" onclick="location.href='top.php'">トップへ戻る</button>
    <?php
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = $pdo->prepare('DELETE FROM tourism WHERE name = ?');
        if ($sql->execute([$id])) {
            echo '<h1 class="title is-size-4 has-text-success mt-4">削除に成功しました。</h1>';
        } else {
            echo '<h1 class="title is-size-4 has-text-danger mt-4">削除に失敗しました。</h1>';
        }
    } else {
        echo '<h1 class="title is-size-4 mt-4">削除するデータがありません。</h1>';
    }
    ?>
    <!-- 削除画面の表を更新 -->
    <table class="table">
        <thead>
            <tr>
                <th>県名</th>
                <th>観光地名</th>
                <th>名物</th>
                <th>説明</th>
                <th>カテゴリ</th> <!-- カテゴリ列を追加 -->
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pdo->query('select * from tourism') as $row) {
                echo '<tr>';
                echo '<td>', $row['name'], '</td>';
                echo '<td>', $row['kanko_name'], '</td>';
                echo '<td>', $row['Specialty'], '</td>';
                echo '<td>', $row['exp'], '</td>';
                echo '<td>', $row['category'], '</td>';
                echo '<td>';
                echo '<form action="delete.php" method="post">';
                echo '<input type="hidden" name="id" value="', $row['name'], '">';
                echo '<button class="button is-danger" type="submit">削除</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                echo "\n";
            }
            ?>
        </tbody>
    </table>