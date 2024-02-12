<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail.php';

$mail = new PHPMailer(true);

try {
    // SMTP設定
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // SMTPサーバーのアドレス
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username'; // SMTPユーザー名
    $mail->Password = 'your_password'; // SMTPパスワード
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // 受信者設定
    $mail->setFrom('yutakil0414@gmail.com', 'Mailer');
    $mail->addAddress('yutakil0414@gmail.com', 'Recipient Name');

    // コンテンツ設定
    $mail->isHTML(true);
    $mail->Subject = 'メールの件名';
    $mail->Body    = 'これは<b>HTML形式</b>のメール本文です。';
    $mail->AltBody = 'これはHTML非対応メールクライアント用のテキストメッセージです。';

    $mail->send();
    echo 'メッセージが送信されました';
} catch (Exception $e) {
    echo "メッセージの送信に失敗しました。Mailer Error: {$mail->ErrorInfo}";
}
?>
