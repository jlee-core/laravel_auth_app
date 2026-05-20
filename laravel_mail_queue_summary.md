# Laravel メール送信・Queue問題まとめ

## ① 現象

-   同じ関数でMail::to() を2回実行するとjobsには2件が入る
-   1件が処理されたらemptyになる
-   Mailtrapには1通のみ届く

## ② 試したこと

-   Mail::to()->queue() の順番を変更して検証
-   delay（later）を追加して送信間隔を調整
-   queue workerの動作確認

## ③ 原因

-   Mailtrap（SMTP）のレート制限（550 5.7.0）
-   同時送信で拒否発生
-   Laravel queueは正常動作
-   送信段階（SMTP）で制限により失敗または抑制されている

## ④ 補助要因

-   default queueにMail/Notification混在
-   Job未使用で制御不能
-   同時実行による送信タイミング集中

## ⑤ 解決策

-   Mail送信をJob化して制御する
-   Bus::batchで処理単位を管理する
-   queueを用途別に分離（mail / notifications）
-   workerの処理間隔を調整する

## ⑥ 正しい構造

Controller → Bus::batch → Jobs → Mailable → SMTP

## ⑦ 結論

LaravelではなくSMTP制限と設計不足が原因
