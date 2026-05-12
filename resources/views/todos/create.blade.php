<h2>Todo作成</h2>

<form method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="title">タイトル</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}">

        @error('title')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body">内容</label>
        <textarea id="body" name="body">{{ old('body') }}</textarea>

        @error('body')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">登録</button>
</form>
<a href="{{ route('todos.index') }}">一覧へ戻る</a>