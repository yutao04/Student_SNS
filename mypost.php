<?php
session_start();
require_once __DIR__ . '/../php_inc/functions.php';

$userID = $_SESSION['user_id'] ?? null;  // ログインユーザーのIDを取得
$user = $_SESSION['user'] ?? "名無しさん";

// データベース接続
$dbh = db_open();

// データベースからログインユーザーの投稿を取得
$sql = "SELECT posts.*, user.user FROM posts LEFT JOIN user ON posts.id = user.id WHERE posts.id = :user_id ORDER BY posts.posted_at DESC";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/php/mypage_style.css">
    <style>
        .uploaded-image {
            max-width: 40%;
            height: auto;
        }
    </style>
    <title>sower_sns - 投稿一覧</title>
</head>
<body>

<div>
    <?php
    // 投稿が存在するかチェック
    if (count($posts) > 0) {
        foreach ($posts as $post) {
            echo '<div>';
            echo '<p>' .
                '投稿ID:'  . str2html($post['post_id']) . ' ' .
                "ユーザー名:" . str2html($post['user']) .
                '　ユーザーID:' . str2html($post['id']) . '<br>' .
                str2html($post['content']) .
                '</p>';

            // 画像があれば表示
            if (!empty($post['image_url'])) {
                echo '<img class="uploaded-image" src="' . str2html($post['image_url']) . '" alt="投稿画像">';
            }
            echo '<p>投稿日時: ' . str2html($post['posted_at']) . "<br>" . "---------------------------------------------------------------".'</p>';
            echo '</div>';
        }
    } else {
        echo '<p>まだ投稿がありません。</p>';
    }
    ?>
</div>

</body>
</html>

