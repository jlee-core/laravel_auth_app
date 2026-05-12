<nav>
    <a href="{{ route('todos.index') }}">一覧</a>
    <a href="{{ route('todos.create') }}">新規作成</a>
</nav>
<!-- 検索欄 -->
<div>
    <form action="{{ route('todos.search') }}" method="GET">
        <input type="text" name="keyword">
        <button type="submit">検索</button>
    </form>
</div>
<h2>Todo一覧</h2>
<ul>
    @foreach ($todos as $todo)
    <div>
        <h2>{{ $todo->title }}</h2>

        @can('update', $todo)
        <a href="{{ route('todos.edit', $todo) }}">編集</a>
        @endcan

        @can('delete', $todo)
        <form method="POST" action="{{ route('todos.destroy', $todo) }}">
            @csrf
            @method('DELETE')

            <button type="submit">削除</button>
        </form>
        @endcan
    </div>
    @endforeach
</ul>
<nav>
    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
    @else
    <a href="{{ route('login') }}">ログイン</a>
    @endauth
</nav>