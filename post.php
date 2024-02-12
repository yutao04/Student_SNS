

<?php
// session_start();
// // ユーザーが認証されていない場合
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php"); // ログインページにリダイレクト
//     exit();
// }

include __DIR__ . '/../php_inc/header.php';
?>

<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>テキスト投稿</title>
</head>
<body>

<h2>テキスト投稿</h2>

<?php
// メッセージがセットされている場合に表示
if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']); // メッセージを表示したら削除
}
?>

<form action="post_handler.php" method="post" enctype="multipart/form-data">
    <label for="content">投稿内容:</label>
    <textarea name="content" id="content" rows="4" cols="50" required></textarea>
    <br>
    <label for="image">画像アップロード:</label>
    <input type="file" name="image" id="image">
    <br>
    <input type="submit" value="投稿する">
</form>


</body>
</html>
<?php include __DIR__ . '/../php_inc/footer.php'; // フッターの読み込み ?>
