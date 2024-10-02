<?php
// セッション開始
session_start();

// 送られてきた値を取得
$token = $_POST['token'];
$name = $_POST['name'];
$content = $_POST['content'];

// 送られてきたトークンのバリデーション
if($token != $_SESSION['token']){
    unset($_SESSION['token']);
    redirect('http://127.0.0.1:8000/index');
}

// 値のバリデーション
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(empty($name) || empty($content)){
    redirect('http://127.0.0.1:8000/edit');
}

// idの取得
$id = $_SESSION['id'];

// SQL文の準備
$sql = 'UPDATE articles SET name = ?, content = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $content, $id]);

// セッション内のデータ削除
unset($_SESSION['token']);
unset($_SESSION['id']);

?>

<!--   HTML   -->
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>編集成功</title>
    </head>
    <body>
        <header>
            <h1>編集成功</h1>
        </header>
        <main>
            <a href="http://127.0.0.1:8000/index">戻る</a>
        </main>
    </body>
</html>