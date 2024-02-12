<?php
// セッションがまだ開始されていない場合にセッションを開始する
if(!isset($_SESSION)){
    session_start();
}

if(empty($_POST['token'])){
    echo "エラーが発生しました。";
    exit;
}

// セッションに保存されているトークンとPOSTリクエストで送信されたトークン一致、
if(!(hash_equals($_SESSION['token'], $_POST['token']))){// hash_equals関数は、タイミング攻撃に対して安全な文字列比較を行うために使用される
    echo "エラーが発生しました。";
    exit;
}

?>
