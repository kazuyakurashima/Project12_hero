<?php

// 1. 必要なファイルを読み込む
// 2. URLから取得したIDを基にデータベースから該当キャラクターを取得
// 4. 現在のデータを表示
// 5. 削除確認フォーム


// 1. 必要なファイルを読み込む
require_once '../functions/security.php';
require_once '../functions/sql_util.php'; 
require_once '../functions/db_connect.php';
$pdo = db_connect(); 
loginCheck();


// 2. URLから取得したIDを基にデータベースから該当キャラクターを取得
$id = $_GET['id']; 
$sql = 'SELECT * FROM players WHERE id = :id'; 
$params = [':id' => $id]; 
$player = fetchQuery($pdo, $sql, $params); 

if (!$player) {
    exit('キャラクターが見つかりませんでした。');
}
?>


<!-- 4．現在のデータを表示 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>キャラクター削除</title>
    <link rel="stylesheet" href="css/character.css">
    <link rel="icon" href="img/project8.png"> <!-- ファビコンの設定 -->
</head>
<body>
    <h1>キャラクター削除</h1>
    <p>名前: <?php echo h($player['name']); ?></p>  <!-- 修正: 簡潔に記述 -->
    <p>職業: <?php echo h($player['job']); ?></p>
    <p>HP: <?php echo h($player['hp']); ?></p>
    <p>MP: <?php echo h($player['mp']); ?></p>
    <br>
    <h2>本当に削除しますか？</h2>

<!-- 5．削除確認フォーム -->
    <form action="delete_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo h($player['id']); ?>"> 
        <!-- idは変更されることがないため、hiddenで送信 -->
        <button type="submit">削除</button>
    </form>
    <a href="register_confirm.php">戻る</a>
</body>
</html>
