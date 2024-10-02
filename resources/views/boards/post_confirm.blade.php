<?php
// セッション開始
session_start();

// 送られてきた値を取得
$name = $_POST['name'];
$content = $_POST['content'];

// セッションに保存
$_SESSION['name'] = $name;
$_SESSION['content'] = $content;

// 値のバリデーションを行う 
if(empty($name) || empty($content)){
    redirect('http://127.0.0.1:8000/index');
}

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
    <title>投稿確認</title>
</head>
<body>
    <header>
        <h1>確認</h1>
    </header>
    <main>
        <div>下記の内容で投稿しますがよろしいですか</div>
        <table>
            <tbody>
                <tr><th>名前</th><td><?= htmlspecialchars($name) ?></td></tr>
                <tr><th>投稿内容</th><td><?= htmlspecialchars($content) ?></td></tr>
            </tbody>
        </table>
        <form action="{{ route('post.complete')}}" method="POST">
            @csrf
            <input type="hidden" name="token" value="<?= $token ?>">
            <button type="submit">投稿</button>
        </form>
    </main>
</body>
</html>