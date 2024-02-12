<?php
require_once __DIR__ . '/../php_inc/functions.php'; // functions.phpをインクルード
include __DIR__ . '/../php_inc/header.php';
try {
    // データベースへの接続
    $dbh = db_open();

    // SQLクエリの作成
    $sql = "SELECT * FROM user";

    // クエリの実行
    $stmt = $dbh->query($sql);

    // 結果の表示"
    if ($stmt) {
        echo "<table><tr><th>ID</th><th>User</th></th></tr>";
        // データの出力
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . str2html($row["id"]) . "</td><td>" . str2html($row["user"]) . "</td><td>" ;
        }
        echo "</table>";
    } else {
        echo "Query failed.";
    }
} catch (PDOException $e) {
    echo "Error: " . str2html($e->getMessage());
} finally {
    // データベース接続のクローズ
    if (isset($dbh)) {
        $dbh = null;
    }
}
?>
<?php 
include __DIR__ . '/../php_inc/footer.php';
