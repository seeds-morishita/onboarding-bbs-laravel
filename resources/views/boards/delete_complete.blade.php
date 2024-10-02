<?php
// セッション開始
session_start();

// 送られてきた値を取得
$token = $_POST['token'];
$id = $_SESSION['id'];

// 送られてきたトークンのバリデーション
if($token != $_SESSION['token']){
    unset($_SESSION['token']);
    redirect("http://127.0.0.1:8000/index");
}

// データベースへの接続設定
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL文の準備
$stmt = $pdo->prepare('DELETE FROM `articles` WHERE id = ?');
$stmt->execute([$id]);

?>

<!--   HTML   -->
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>削除成功</title>
    </head>
    <body>
        <header>
            <h1>削除成功</h1>
        </header>
        <main>
            <a href="http://127.0.0.1:8000/index">戻る</a>
        </main>
    </body>
</html>