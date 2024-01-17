<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>県情報</title>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">新たな情報を追加します。</h1>
            <form action="toroku_output.php" method="post">
                <div class="field">
                    <label class="label">県名</label>
                    <div class="control">
                        <input class="input" type="text" name="name">
                    </div>
                </div>

                <div class="field">
                    <label class="label">観光地名</label>
                    <div class="control">
                        <input class="input" type="text" name="kanko_name">
                    </div>
                </div>

                <div class="field">
                    <label class="label">カテゴリ</label>
                    <div class="control">
                        <input class="input" type="text" name="category">
                    </div>
                </div>

                <div class="field">
                    <label class="label">名物</label>
                    <div class="control">
                        <input class="input" type="text" name="Specialty">
                    </div>
                </div>

                <div class="field">
                    <label class="label">説明</label>
                    <div class="control">
                        <input class="input" type="text" name="exp">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit">追加</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>