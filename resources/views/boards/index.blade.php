<?php
// セッション開始
session_start();

// データベースへの接続設定
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL文の準備
$stmt = $pdo->prepare('SELECT * FROM `articles`');
$stmt->execute();
$articles = $stmt->fetchall(PDO::FETCH_ASSOC);

/* ------------------------------------------------------
 * ダミーデータ
 * ------------------------------------------------------ */
/*$articles = [
    ['id' => 1, 'name' => 'Dummy', 'content' => 'Dummy' , 'created_at' => '2020-12-09 00:00:00', 'updated_at' => '2020-12-09 00:00:00']
];
*/

?>
<!-- HTML -->
<!doctype html>
<html lang="ja">

<!-- 最初の画面 -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>オンボーディング掲示板</title>
    <style>
        textarea{
            resize: vertical;
        }
        textarea, input[type=text]{
            border: solid 1px gray;
            box-sizing: border-box;
            padding: 4px;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>オンボーディング掲示板</h1>
    </header>
    <main>
        <ul>
            <?php foreach ($articles as $article) { ?>
                <li>
                    <div>
                        <?= htmlspecialchars($article['id']) ?>:&nbsp;<?= htmlspecialchars($article['name']) ?>&nbsp;<?= htmlspecialchars($article['updated_at']) ?>
                    </div>
                    <div><?= htmlspecialchars($article['content'])?></div>
                    <div style="display: inline-flex;">
                        <form action="{{ route('edit', $article['id']) }}" method="post">
                        @csrf
                            <input type="hidden" name="id" value="<?= $article['id']?>">
                            <button type="submit">編集</button>
                        </form>
                        &nbsp;
                        <form action="{{ route('delete.confirm')}}" method="post">
                        @csrf
                            <input type="hidden" name="id" value="<?= $article['id']?> ">
                            <button type="submit">削除</button>
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div>
            <form action="{{ route('post.confirm') }}" method="post">
            @csrf
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">新規投稿</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><label for="name">名前</label></th>
                        <td><input type="text" name="name" id="name" required></td>
                    </tr>
                    <tr>
                        <th><label for="content">投稿内容</label></th>
                        <td><textarea name="content" id="content" rows="4" required></textarea></td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit">投稿</button>
            </form>
        </div>
    </main>
</body>
</html>
