<h1>通知一覧</h1>

<ul>
    @foreach ($notifications as $notification)
        <li>
            {{ $notification->data['message'] }}
            <a href="{{ $notification->data['url'] }}">→ 詳細</a>
        </li>
    @endforeach
</ul>

<a href="{{ route('dashboard') }}">ダッシュボードへ戻る</a>