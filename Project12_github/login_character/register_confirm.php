<?php

// -----------------------------------------------------
session_start();

// -----------------------------------------------------
// 必要なファイルを読み込む
require_once '../functions/security.php'; 
require_once '../functions/db_connect.php'; 
require_once '../functions/sql_util.php';

$pdo = db_connect(); 
loginCheck();

// -----------------------------------------------------
// ログイン中のユーザーIDを取得
$login_id = $_SESSION['login_id'];

// データを取得する
// （その1）料理したものを、1品取り出す（ログインidに紐づく直近のデータを取得）
$sql_latest = 'SELECT * FROM players WHERE login_id = :login_id ORDER BY created_at DESC LIMIT 1';
$params = [':login_id' => $login_id];
$latest_player = fetchQuery($pdo, $sql_latest, $params);

// （その2）料理したものを、全品取り出す（ログインidに紐づく全データを取得）
$sql_all = 'SELECT * FROM players WHERE login_id = :login_id ORDER BY created_at DESC';
$params = [':login_id' => $login_id];
$all_players = fetchAllQuery($pdo, $sql_all, $params);
?>


<!-- ----------------------------------------------------- -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録内容確認</title> <!-- ページのタイトル -->
    <link rel="stylesheet" href="css/character.css">
    <link rel="icon" href="img/project8.png"> <!-- ファビコンの設定 -->
</head>
<body>
    <!-- 直近に登録されたデータの表示 -->
    <h1>登録内容確認</h1>
    
    <!-- 操作結果のメッセージを表示 -->
    <!-- セッションにメッセージが保存されている場合、その内容を画面に表示する -->
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green; font-weight: bold;">
            <?php echo h($_SESSION['message']); ?> 
            <!-- htmlspecialchars()で無害化して表示 -->
        </p>
        <?php unset($_SESSION['message']); ?> 
        <!-- 表示後、セッションからメッセージを削除 -->
        <!-- リロード時に再表示されないように -->
    <?php endif; ?>

    <!-- セッションからidに紐づく最新のプレイヤー情報を表示 -->
    <?php if ($latest_player): ?>
        <p>名前: <?php echo h($latest_player['name']); ?></p>
        <p>職業: <?php echo h($latest_player['job']); ?></p>
        <p>HP: <?php echo h($latest_player['hp']); ?></p>
        <p>MP: <?php echo h($latest_player['mp']); ?></p>
    <?php else: ?>
        <p>プレイヤー情報がありません。</p>
    <?php endif; ?>

    <!-- shopフォルダにあるindex.htmlに飛ぶリンク -->
    <a href="../shop/index.php">ギークマーケットへ</a><!-- ギークマーケットページに飛ぶリンク -->
    <!-- 登録画面に戻るリンク -->
    <a href="register.php">キャラ登録画面へ戻る</a> <!-- 登録ページに戻るリンク -->

    <!-- 全てのデータを一覧表示する -->
        <!-- tr:Table Row           テーブルを作るよ -->
        <!-- th:Table Header        項目（ヘッダー）を定義 -->
        <!-- td:Table Table Data    実際のデータを入れるよ -->

    <h2>登録済みデータ一覧</h2>
    <table border="1"> <!-- 表を作成します（border="1"で枠線を付ける） -->
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>職業</th>
            <th>HP</th>
            <th>MP</th>
            <th>登録日時</th>
            <th>編集</th>   
        </tr>
        <!-- foreach文を使って、データベースから取得したidに紐づく全てのデータを1行ずつ表示 -->
        <?php foreach ($all_players as $player): ?>
            <tr>
                <!-- htmlspecialchars()関数で表示する内容を無害化します（セキュリティ対策） -->
                <td><?php echo h($player['id']); ?></td> <!-- IDを表示 -->
                <td><?php echo h($player['name']); ?></td> <!-- 名前を表示 -->
                <td><?php echo h($player['job']); ?></td> <!-- 職業を表示 -->
                <td><?php echo h($player['hp']); ?></td> <!-- HPを表示 -->
                <td><?php echo h($player['mp']); ?></td> <!-- MPを表示 -->
                <td><?php echo h($player['created_at']); ?></td> <!-- 登録日時を表示 -->
                <td>
                    <!-- 編集ボタンを設置 -->
                     <!-- リンク先とクリックしたデータのidを送る -->
                    <a href="update.php?id=<?php echo h($player['id']); ?>">✏️</a> <!-- 編集ページへのリンク -->
                    <!-- ?          クエリパラメータを示す記号 -->
                    <!-- ?id        idというクエリパラメータを、サーバーに渡します -->
                    <!-- $player     プレイヤーの関する連想配列 -->

                    <!-- 例えば、id=1をクリックした場合、リンク先："update.php、データ：id=1が伝わる -->
                     <!-- phpなので、変数を埋め込むためにはechoが必要。データ：1は、：<php echo h($player['id']);?>と表現  -->

                    <!-- 削除ボタンを設置 -->
                    <a href="delete.php?id=<?php echo h($player['id']); ?>">🗑️</a> <!-- 削除ページへのリンク -->
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>