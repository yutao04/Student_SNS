<!--ログイン-->
<?php
//login.php
session_start();
require_once __DIR__ . '/../php_inc/functions.php';
include __DIR__ . '/../php_inc/header.php';
?>
<form  method="post" action="login.php">
    <p>
        <label for="user">ユーザー名:</label>
        <input type="text" name="user">
    </p>
    <p>
        <label for="password">パスワード:</label>
        <input type="password" name="password">
    </p>
    <input type="submit" value="送信する">
</form>

<li><a href="./input.php">追加</a></li>
<?php include __DIR__ . '/../php_inc/footer.php';?>
<?php
if (!empty($_SESSION['login'])) {
    echo "ログイン済みです<br>";
    echo "<a href=index.php>リストに戻る</a>";
    exit;
}

if((empty($_POST['user'])) || (empty($_POST['password']))){
  //echo "ユーザー名、パスワードを入力してください。";
    exit;
}

try{
    $dbh = db_open();
    $sql = "SELECT id, password FROM user WHERE user = :user";//WHEREは検索条件
    $stmt = $dbh->prepare($sql);//SQLインジェクション攻撃を防ぐためにプリペアドステートメントを作成
    $stmt->bindParam(":user", $_POST['user'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$result){
        echo "ログインに失敗しました。ユーザー名が見つかりません。";
        exit;
    }
    //ハッシュ値を使用したパスワードの照合
    if(password_verify($_POST['password'], $result['password'])){//password_verify(パスワード文字列,ハッシュ値文字列)
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['user'] = $_POST['user']; // ユーザー名
        
        header("Location: index.php");//index.php(ホームページに遷移)
    }else{
        echo "ログインに失敗しました。パスワードが見つかりません。";
    }
} catch (PDOException $e){
    echo "エラー!: " . str2html($e->getMessage());
    exit;
}
?>
