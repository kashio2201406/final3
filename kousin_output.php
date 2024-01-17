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
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <button class="button is-info" onclick="location.href='top.php'">トップ画面へ戻る</button>
    <section class="section">
        <div class="container">
            <?php
            $pdo = new PDO($connect, USER, PASS);

            if (empty($_POST['kanko_name'])) {
                echo '<div class="notification is-danger">観光地名を入力してください。</div>';
            } elseif (empty($_POST['category'])) {
                echo '<div class="notification is-danger">カテゴリを入力してください。</div>';
            } elseif (empty($_POST['Specialty'])) {
                echo '<div class="notification is-danger">名物を入力してください。</div>';
            } elseif (empty($_POST['exp'])) {
                echo '<div class="notification is-danger">説明を入力してください。</div>';
            } else {
                $sql = $pdo->prepare('UPDATE tourism SET kanko_name=?, category=?, Specialty=?, exp=? WHERE name=?');

                if ($sql->execute([htmlspecialchars($_POST['kanko_name']), htmlspecialchars($_POST['category']), htmlspecialchars($_POST['Specialty']), $_POST['exp'], $_POST['ken']])) {
                    echo '<div class="notification is-success">更新に成功しました。</div>';
                } else {
                    echo '<div class="notification is-danger">更新に失敗しました。</div>';
                }
            }
            ?>
            <hr>
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>県名</th>
                        <th>観光地名</th>
                        <th>カテゴリ</th>
                        <th>名物</th>
                        <th>説明</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pdo->query('SELECT * FROM tourism') as $row) {
                        echo '<tr>';
                        echo '<td>', $row['name'], '</td>';
                        echo '<td>', $row['kanko_name'], '</td>';
                        echo '<td>', isset($row['category']) ? $row['category'] : '', '</td>';
                        echo '<td>', $row['Specialty'], '</td>';
                        echo '<td>', $row['exp'], '</td>';
                        echo '</tr>';
                        echo "\n";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </section>
</body>

</html>