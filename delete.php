<?php
require_once __DIR__.'/../../db_config.php';
if(empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
try {
    $id = (int)$_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'delete from recipes where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$id,PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "ID".htmlspecialchars($id,ENT_QUOTES)."削除が完了しました";
} catch(PDOException $e) {
    echo "エラー発生：".htmlspecialchars($e->getMessage(),ENT_QUOTES)."<br>";
    exit;
}