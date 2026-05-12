<nav>
    @auth
        <p>こんにちは、{{ auth()->user()->name }} さん</p>

        <a href="{{ route('dashboard') }}">ダッシュボード</a>
        <a href="{{ route('mypage') }}">マイページ</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit">ログアウト</button>
        </form>
    @else
        <a href="{{ route('login') }}">ログイン</a>
        <a href="{{ route('register') }}">新規登録</a>
    @endauth
</nav>