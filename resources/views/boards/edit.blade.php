<?php
// セッション開始
session_start();

// 送られてきた値をセッションに保存
$id = $_POST['id'];
$_SESSION['id'] = $id;

// 値のバリデーションを行う
if(empty($id)){
    redirect('http://127.0.0.1:8000/index');
}

// データベースへの接続設定
$dsn = 'mysql:host=127.0.0.1;dbname=laravel;charset=utf8';
$username = 'user';
$password = 'password';

// PDOインスタンスの作成
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL文の準備
$stmt = $pdo->prepare('SELECT * FROM `articles` WHERE id = ?');
$stmt->execute([$id]);

$article = $stmt-> fetch(PDO::FETCH_ASSOC);

// 編集する投稿データの取得
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿編集</title>
    <style>
        textarea{
            resize: vertical;
        }
        textarea, input[type=text] {
            border: solid 1px gray;
            box-sizing: border-box;
            padding: 4px;
            width: 100px;
        }
    </style>
</head>
<body>
    <header>
        <h1>投稿編集</h1>
    </header>
    <main>
        <form action="{{ route('edit.complete')}}" method="post">
            @csrf
            <input type="hidden" name="token" value="<?= $token ?>">
            <table>
                <tbody>
                <tr>
                    <th><label for="name">名前</label></th>
                    <td><input type="taxt" name="name" id="name" value="<?= $name ?>" required></td>
                </tr>    
                <tr>
                    <th><label for="content">投稿内容</label></th>
                    <td><textarea name="content" id="content" rows="4" required><?= $content ?></textarea></td>
                </tr>
                </tbody>
            </table>
            <button type="submit">編集</button>
        </form>
    </main>
</body>
</html>