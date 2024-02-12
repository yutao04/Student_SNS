<?php
// post_handler.php
session_start();
require_once __DIR__ . '/../php_inc/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postContent = $_POST["content"]; // フォームから送信されたcontentを取得
    $imageUrl = null; // 画像の初期値をnullに設定

    // 画像が選択されているか確認
    if (!empty($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        // 画像をアップロード
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imageUrl = $targetFile; // アップロードされた画像のパスを取得
        } else {
            // アップロード失敗時の処理
            echo "ファイルのアップロードに失敗しました。";
            exit();
        }
    }
    
     $id = $_SESSION['id'] ?? 15;//idがnullの場合に、「名無しさん」というユーザーに切り替わる

     if ($id === null) {
         echo "エラー: ユーザーIDが不明です。";
         exit;
     }

    try {
        $dbh = db_open();
        $sql = "INSERT INTO posts (id, content, image_url, posted_at, updated_at) 
                VALUES (:id, :content, :image_url, NOW(), NOW())";
        $stmt = $dbh->prepare($sql);

        // ユーザーIDなど、必要に応じて他の値も取得し、バインドする
        // 例: ログインユーザーのID
        

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":content", $postContent, PDO::PARAM_STR);
        $stmt->bindParam(":image_url", $imageUrl, PDO::PARAM_STR);

        $stmt->execute();

        // 成功時の処理やリダイレクトなどを行う
        $_SESSION['message'] = '投稿が成功しました。';
        header("Location: open.php"); // 投稿後にホームページなどにリダイレクトする
        exit();
    } catch (PDOException $e) {
        // エラー時の処理を行う
        echo "エラー!: " . str2html($e->getMessage());
        exit();
    }
}

?>



