<?php
session_start();

require_once '../functions/sql_util.php'; 
require_once '../functions/db_connect.php';
$pdo = db_connect();

// POSTデータを取得（ユーザーIDとパスワード）
$login_id = $_POST['login_id'];
$login_pw = $_POST['login_pw'];

// 'login'テーブルからユーザー情報を取得
$sql = 'SELECT * FROM login WHERE login_id = :login_id';
$params = [':login_id' => $login_id];
$user = fetchQuery($pdo, $sql, $params); // fetchQueryでデータ取得

// パスワードが正しいか確認,ハッシュ化されたパスワードと平のパスワードを比較    
if ($user && password_verify($login_pw, $user['login_pw'])) {
    // 'login'テーブルのユーザー情報が存在し（$userが空でない）し、かつ、平のパスワードとハッシュ化されたパスワードが一致する場合
    // セッションIDをセッションに保存   
    $_SESSION['chk_ssid'] = session_id();
    // chk_ssidは、セッションIDをチェックするための変数 
    // ユーザーIDをセッションに保存
    $_SESSION['login_id'] = $user['login_id'];

    // キャラクターが登録されているか確認
    $sql = 'SELECT * FROM players WHERE login_id = :login_id';
    $params = [':login_id' => $login_id];
    $player = fetchQuery($pdo, $sql, $params); // fetchQueryでデータ取得
    if ($player['login_id']) {
        // キャラクターが登録されている場合
        // ロイン成功時の処理
        header('Location: register_confirm.php'); // キャラクター登録確認画面へ
    } else {
        // キャラクターが登録されていない場合
        // ロイン成功時の処理
        header('Location: register.php'); // キャラクター登録画面へ
    }
} else {
    // ログイン失敗時
    header('Location: ../login.html?login=failed'); // ログイン画面へ
}
exit();