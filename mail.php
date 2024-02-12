<?php
$to = 'yutakil0414@gmail.com'; // 受信者のメールアドレス
$subject = 'メールの件名'; // メールの件名
$message = 'メールの本文です。'; // メールの本文
$headers = 'From: yutali0414@gmail.com'; // 送信者のメールアドレス

// メールを送信
if(mail($to, $subject, $message, $headers)) {
    echo 'メール送信に成功しました。';
} else {
    echo 'メール送信に失敗しました。';
}
?>
