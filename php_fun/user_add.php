<!--新規登録の処理-->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/token_check.php';
require_once __DIR__ . '/../php_inc/functions.php';
include __DIR__ . '/../php_inc/user_error_check.php';
include __DIR__ . '/../php_inc/header.php';

try{
    $dbh = db_open();
    $sql = "INSERT INTO user (id, user, password)
    VALUES (NULL, :user, :password)";
    $stmt = $dbh->prepare($sql);

    $password = $_POST['password'];

    // パスワードをハッシュ化
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt->bindParam(":user", $_POST['user'], PDO::PARAM_STR);  
    $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);

    $stmt->execute();
    echo "ユーザが追加されました。<br>";
    echo "<a href= 'login.php'>ログイン画面へ戻る</a>";
}catch(PDOException $e){
    echo "error!<br>" . str2html($e->getMessage()) . "<br>";
    exit;
}
?>
<?php 
include __DIR__ . '/../php_inc/footer.php';