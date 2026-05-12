<x-mail::message>
# お問い合わせを受け付けました

以下の内容でお問い合わせを受け付けました。

## お名前

{{ $name }}

## メールアドレス

{{ $email }}

## お問い合わせ内容

{{ $messageBody }}

<x-mail::button :url="url('/')">
サイトを確認する
</x-mail::button>

内容を確認のうえ、担当者よりご連絡いたします。
</x-mail::message>