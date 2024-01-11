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
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/list.css" />
    <title>県情報</title>
</head>

<body>
    <h1>県情報</h1>
    <hr />
    <h3>県一覧表</h3>
    <table id="tourism">
        <tr>
            <th>県名</th>
            <th>観光地名</th>
            <th>名物</th>
        </tr>
        <?php
        // Use the PDO instance $pdo already created in the previous code

        try {
            // テーブルから商品情報を取得
            $sql = "SELECT * FROM tourism";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("データベースエラー：" . $e->getMessage());
        }
        ?>

        <?php
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['kanko_name']}</td>";
            echo "<td>{$product['Specialty']}</td>";
            echo "<td>{$product['exp']}</td>";
            echo "<td>";
            echo "<button class='edit' onclick='handleButton({$product['id']}, \"編集\")'>編集</button>";
            echo "<button class='delete' onclick='handleButton({$product['id']}, \"削除\")'>削除</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>
    <script>
        // JavaScriptの処理を記述
        function handleButton(productId, action) {
            console.log(`商品ID ${productId} の${action}処理を実行`);
            // 実際の処理はここに実装
        }
    </script>
</body>

</html>