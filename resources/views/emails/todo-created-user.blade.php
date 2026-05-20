<x-mail::message>
# Todoを作成しました

以下の内容でTodoを作成しました。

## タイトル

{{ $todo->title }}

## 詳細

{{ $todo->body ?? '詳細はありません。' }}

<x-mail::button :url="route('todos.index')">
Todo一覧を確認する
</x-mail::button>

引き続き、タスク管理にご活用ください。
</x-mail::message>