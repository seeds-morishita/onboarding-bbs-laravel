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
        <form action="{{ route('articles.edit_complete',$article)}}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ session('token') }}">
            <table>
                <tbody>
                <tr>
                    <th><label for="name">名前</label></th>
                    <td><input type="text" name="name" id="name" value="{{ $article['name'] }}" required></td>
                </tr>    
                <tr>
                    <th><label for="content">投稿内容</label></th>
                    <td><textarea name="content" id="content" rows="4" required>{{ $article['content'] }} </textarea></td>
                </tr>
                </tbody>
            </table>
            <button type="submit">編集</button>
        </form>
    </main>
</body>
</html>