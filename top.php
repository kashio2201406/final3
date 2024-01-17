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
    <link rel="stylesheet" href="css/top.css" />
    <title>県情報</title>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">県情報</h1>
            <hr>
            <button class="custom-button button is-success" onclick="location.href='toroku_input.php'">商品を登録する</button>
            <form action="" method="post">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="category">地域選択：</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="select">
                                    <select name="category" id="category">
                                        <option value="">すべての地域</option>
                                        <option value="北海道">北海道</option>
                                        <option value="東北">東北</option>
                                        <option value="関東">関東</option>
                                        <option value="中部">中部</option>
                                        <option value="近畿">近畿</option>
                                        <option value="中国">中国</option>
                                        <option value="四国">四国</option>
                                        <option value="九州">九州</option>
                                        <option value="沖縄">沖縄</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit">絞り込む</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>県名</th>
                        <th>観光地名</th>
                        <th>カテゴリ</th>
                        <th>名物</th>
                        <th>説明</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $filterRegion = isset($_POST['category']) ? $_POST['category'] : '';

                    $query = 'SELECT * FROM tourism';
                    if (!empty($filterRegion)) {
                        $query .= ' WHERE category = :category';
                    }

                    $stmt = $pdo->prepare($query);

                    if (!empty($filterRegion)) {
                        $stmt->bindParam(':category', $filterRegion, PDO::PARAM_STR);
                    }

                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>', $row['name'], '</td>';
                        echo '<td>', $row['kanko_name'], '</td>';
                        echo '<td>', $row['category'], '</td>';
                        echo '<td>', $row['Specialty'], '</td>';
                        echo '<td>', $row['exp'], '</td>';
                        echo '<td>';
                        echo '<form action="kousin_input.php" method="post">';
                        echo '<input type="hidden" name="id" value="', $row['name'], '">';
                        echo '<button class="button is-info" type="submit">更新</button>';
                        echo '</form>';
                        echo '</td>';
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
        </div>
    </section>
</body>

</html>