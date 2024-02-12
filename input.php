<!--ユーザーの新規登録-->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token'] = $token;
?>
    <?php 
    include __DIR__ . '/../php_inc/header.php'; 
    ?>
    <a href= 'login.php'>ログイン画面へ戻る</a>
    <form action="user_add.php" method="post">
        <p>
            <label for="user">ユーザー名(必須・255文字まで):</label>
            <input type="text" name="user">
        </p>
        <p>
            <label for="password">パスワード(255文字まで):</label>
            <input type="password" name="password">
        </p>
        
        <p class="button">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <input type="submit" value="送信する">
        </p>
    </form>
    <?php
    include __DIR__ . '/../php_inc/footer.php';
