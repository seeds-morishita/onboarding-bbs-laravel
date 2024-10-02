<?php
// セッション開始
session_start();

// 送られてきた値を取得
$token = $_POST['token'];

// 送られてきたトークンのバリデーション
if($token != $_SESSION['token']){
    unset($_SESSION['token']);
    redirect('http://127.0.0.1:8000/index');
}

// セッション内の投稿内容の取得
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$content = isset($_SESSION['content']) ? $_SESSION['content'] : '';

// データベースへの接続設定
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLクエリの準備
$sql = 'INSERT INTO articles (name, content) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);

// パラメータのバインディングとクエリの実行
$stmt->execute([$name, $content]);

// セッション内のデータの削除
unset($_SESSION['name']);
unset($_SESSION['content']);
unset($_SESSION['token']);




?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>登録成功</title>
</head>
<body>
    <header>
        <hi>登録成功</hi>
    </header>
    <main>
        <a href="http://127.0.0.1:8000/index">戻る</a>
    </main>
</body>
</html> 