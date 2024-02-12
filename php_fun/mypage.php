<?php
session_start();
require_once __DIR__ . '/../php_inc/functions.php';
include __DIR__ . '/../php_inc/header.php';

$user = $_SESSION['user'];
$id = $_SESSION['id'];//idがnullの場合に、「名無しさん」というユーザーに切り替わる

     if ($id === null) {
         echo "エラー: ユーザーIDが不明です。";
         exit;
     }

$dbh = db_open();
$sql = "SELECT mypage.*, user.user FROM mypage LEFT JOIN user ON mypage.id = user.id WHERE mypage.id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
//SELECT posts.*, user.user FROM posts LEFT JOIN user ON posts.id = user.id WHERE user.id = 
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$follow = $result['follow'];
$follower = $result['follower'];
$StatusMassage = $result['StatusMassage'];
//$StatusMassage =　$result;

function formatNumber($number) {
    if ($number >= 1000 && $number < 10000) {
        return round($number / 1000, 1) . "k";
    } elseif ($number >= 10000) {
        return round($number / 10000, 1) . "M";
    } else {
        return $number;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/php/mypage_style.css">
    
    <title>SNS マイページ</title>
</head>
<body>
    <div class="profile-section">
        <h2>My プロフィール</h2>
    </div>
    
    <div class="container">
        
    <div class="edit">
        <!--<input type="submit" value="編集">-->
        <a href="edit.php"><input type="submit" value="編集"></a>
    </div>
    <div class="flex">
        <div class="icon">
            <img src="/uploads/kv.jpeg">
        </div>
        <div class="user-info">
            <p><?php echo $user; ?></p>
            <p><?php echo "@" . $id; ?></p>
        </div>
    </div>
    <div class="statusMassage">
        <p><?php echo $StatusMassage; ?></p>
    </div>
    <div class="follow_follower">
        <p><?php echo "フォロー " . formatNumber($follow) . "  " .  "フォロワー " . formatNumber($follower); ?></p>
    </div>
    
      <div class="flex2">
    
　　<div class="tab-wrap">
　　    <input id="TAB-01" type="radio" name="TAB" class="tab-switch" checked="checked" /><label class="tab-label" for="TAB-01">My posts</label>
        <div class="tab-content">
            <?php include __DIR__ . '/mypost.php'; ?>
        </div>
    
        <input id="TAB-02" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-02">Reply</label>
        <div class="tab-content">
            コンテンツ 2
        </div>
        <input id="TAB-03" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-03">いいね</label>
        <div class="tab-content">
            コンテンツ 3
        </div>
    </div>
    </div>
      </div>

</body>
</html>

<?php include __DIR__ . '/../php_inc/footer.php'; ?>