<?php
session_start();
require_once '../functions/sql_util.php';
require_once '../functions/db_connect.php';

$pdo = db_connect();
$login_id = $_POST['login_id'];
$login_pw = $_POST['login_pw'];


// ユーザーIDが既に存在するか確認
$sql = 'SELECT COUNT(*) AS count FROM login WHERE login_id = :login_id';
// COUNT(*) の結果に「count」という名前をつける
// ユーザーIDが存在する場合は1以上、存在しない場合は0が代入される

$params = [':login_id' => $login_id];
$count = fetchQuery($pdo, $sql, $params);
// $countには、該当するユーザーIDの情報が格納される

if ($count['count'] > 0) {
    // 既にユーザーIDが存在する場合
    header('Location: ../login.html?error=exists');
    exit();
}


//新規登録処理
$hashed_pw = password_hash($login_pw, PASSWORD_DEFAULT);
// パスワードのハッシュ化
// ユーザー情報（ユーザーIDとハッシュ化されたパスワード）をDBに登録
$sql = 'INSERT INTO login (login_id, login_pw) VALUES (:login_id, :login_pw)';
$params = [':login_id' => $login_id, ':login_pw' => $hashed_pw];
executeQuery($pdo, $sql, $params);
header('Location: ../login.html?message=registered'); // ログイン画面へリダイレクト
exit();
?>