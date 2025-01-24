<?php

session_start();

// <データ削除の流れ＞
    // 必要なファイルを読み込み
    // データベースに接続
    // リンクから送られるIDを取得
    // SQL文を作成してデータを登録
    // データ削除後の処理


// 必要なファイルを読み込む
require_once '../functions/security.php';
require_once '../functions/db_connect.php';
require_once '../functions/sql_util.php';


// データベースに接続
$pdo = db_connect();
loginCheck();

// リンクから送られるIDを取得
$id = $_POST['id'];
$sql = 'DELETE from players where id = :id';
$params = [':id' => $id];
executeQuery($pdo, $sql, $params);

// データ削除後の処理
$_SESSION['message'] = 'キャラクターが正常に削除されました。新しいキャラクターを登録しましょう！';
header('Location: register_confirm.php');
exit;