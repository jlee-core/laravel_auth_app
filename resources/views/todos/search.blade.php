<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/style.css')
    <title>検索結果ページ</title>
</head>

<body>
    <h3>検索結果</h3>
    <ul>
        @foreach ($todos as $todo)
        <li>{{ $todo->title }}</li>
        @endforeach
    </ul>
    <form action="{{ route('todos.search') }}" method="GET">
        <button type="submit" name="sort" value="{{ $sort === 'desc' ? 'asc' : 'desc' }}">
            並べ替え({{ $sort === 'desc' ? '新し順' : '古い順' }})</button>
    </form>
    <a href="{{ route('todos.index') }}">一覧へ戻る</a>
</body>

</html>