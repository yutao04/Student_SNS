<!--
    XSS対策
    PhpMyAdminのログイン
-->
<?php
function str2html(string $string) :string{
    //htmlインジェクションを防ぐ
    return htmlspecialchars($string,ENT_QUOTES, 'UTF-8');
}

// データベースへの接続を行う関数を定義
function db_open() :PDO{
    $user = "root";
    $password = "ramen";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,// エラーモードを例外モードに設定
        PDO::ATTR_EMULATE_PREPARES => false,        // エミュレートされたステートメントを無効にする
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,  // 複数のSQLステートメントの実行を無効にする
    ];
    // データベース「alcohol」へのPDO接続を作成
    $dbh = new PDO('mysql:host=localhost;dbname=alcohol', $user, $password, $opt);
    return $dbh;
}