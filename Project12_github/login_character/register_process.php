<?php

session_start();

// 必要なファイルを読み込む
require_once '../functions/db_connect.php';
require_once '../functions/sql_util.php';
require_once '../functions/security.php';
loginCheck();

// POST送信されたデータを受け取る
$name = $_POST['name'];
$job = $_POST['job'];
$hp = $_POST['hp'];
$mp = $_POST['mp'];
// ログインIDを取得
$login_id = $_SESSION['login_id'] ?? null;
if (!$login_id) {
    die("ログインIDが取得できませんでした。");
}
// 登録完了メッセージをセッションに保存
$_SESSION['message'] = "$name を登録しました。";

// 1. データベースに接続
$pdo = db_connect();
$sql = 'INSERT INTO players (login_id, name, job, hp, mp) VALUES (:login_id, :name, :job, :hp, :mp)';
$params = [':login_id' => $login_id, ':name' => $name, ':job' => $job, ':hp' => $hp, ':mp' => $mp];
executeQuery($pdo, $sql, $params);

// 3. セッションに記録させる
$id = $pdo->lastInsertId();
$_SESSION['player'] = [
    'id' => $id,         // ここでidを追加
    'login_id' => $login_id,
    'name' => $name,
    'job' => $job,
    'hp' => $hp,
    'mp' => $mp
];

// 4．登録後の処理
header('Location: register_confirm.php'); 
    // 登録内容確認ページへ遷移
    exit();