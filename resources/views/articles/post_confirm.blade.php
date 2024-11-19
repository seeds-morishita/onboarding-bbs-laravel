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
                <tr><th>名前</th><td><?= htmlspecialchars($_POST['name']) ?></td></tr>
                <tr><th>投稿内容</th><td><?= htmlspecialchars($_POST['content']) ?></td></tr>
            </tbody>
        </table>
        <form action="{{ route('articles.post_complete', $article)}}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ session('token') }}">
            <input type="hidden" name="name" value="<?= $_POST['name'] ?>">
            <input type="hidden" name="content" value="<?= $_POST['content'] ?>">
            <button type="submit">投稿</button>
        </form>
    </main>
</body>
</html>