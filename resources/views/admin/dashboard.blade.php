<h1>管理画面</h1>

<p>この画面は管理者だけがアクセスできます。</p>

<ul>
    <li>ユーザー管理</li>
    <ul>
        @foreach ($users as $user)
            <h3>{{ $user->name }}</h3>
        @endforeach
    </ul>
    <li>Todo全体確認</li>
    <ul>
        @foreach ($todos as $todo)
        <div>
            <h3>userID:{{ $todo->user_id }}</h3>
            <h3>title:{{ $todo->title }}</h3>

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
    <li>操作ログ確認</li>
</ul>

<p>
    <a href="{{ route('dashboard') }}">ダッシュボードへ戻る</a>
</p>