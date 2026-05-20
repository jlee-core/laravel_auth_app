<x-mail::message>
# 新しいTodoが作成されました

新しいTodoが作成されました。

## 作成者

{{ $todo->user->name }}（{{ $todo->user->email }}）

## タイトル

{{ $todo->title }}

## 詳細

{{ $todo->body ?? '詳細はありません。' }}

<x-mail::button :url="route('todos.index')">
Todo一覧を確認する
</x-mail::button>
</x-mail::message>