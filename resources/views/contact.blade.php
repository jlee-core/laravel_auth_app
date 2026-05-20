<h1>お問い合わせ</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('contact.send') }}">
    @csrf

    <div>
        <label for="name">お名前</label>
        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name') }}"
        >

        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email">メールアドレス</label>
        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
        >

        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="message">お問い合わせ内容</label>
        <textarea id="message" name="message">{{ old('message') }}</textarea>

        @error('message')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">送信</button>
    <br>
    <a href="{{ route('dashboard') }}">ダッシュボードへ戻る</a>
</form>