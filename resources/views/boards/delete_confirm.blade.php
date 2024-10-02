<?php
// セッション開始
session_start();

// 送られてきた値を取得, セッションに保存
$id = $_POST['id'];
$_SESSION['id'] = $id;

// 値のバリデーションを行う
if(empty($id)){
    header('Location: http://127.0.0.1:8000/index');
}

// データベースへの接続設定
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

// SQL分の準備
$stmt = $pdo->prepare('SELECT * FROM `articles` WHERE id = ?');
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

// 削除する投稿のデータ
$name = $article['name'];
$content = $article['content'];

// トークン発行(時刻)
$token = strval(time());
$_SESSION['token'] = $token;
?>

<!--   HTML   -->
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>削除確認</title>
</head>
<body>
    <header>
        <h1>確認</h1>
    </header>
    <main>
        <div>下記の内容を削除しますがよろしいですか？</div>
        <table>
            <tbody>
                <tr><th>名前</th><td><?= htmlspecialchars($name) ?></td></tr>
                <tr><th>投稿内容</th><td><?= htmlspecialchars($content) ?></td></tr>
                </tbody>
        </table>
        <form action="{{ route('delete.complete')}}"  method="post">
        @csrf
            <input type="hidden" name="token" value="<?= $token ?>">
            <button type="submit">削除</button>
        </form>
    </main>
</body>
</html>