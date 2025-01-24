<?php

// 1. 必要なファイルを読み込む
// 2. URLから取得したIDを基にデータベースから該当キャラクターを取得
// 3. HTML(編集フォーム）

// 1. 必要なファイルを読み込む
require_once '../functions/security.php';
require_once '../functions/sql_util.php'; 
require_once '../functions/db_connect.php';
loginCheck();
$pdo = db_connect(); 


// 2. URLから取得したIDを基にデータベースから該当キャラクターを取得
$id = $_GET['id']; 
$sql = 'SELECT * FROM players WHERE id = :id'; 
$paramas = [':id' => $id]; 
$player = fetchQuery($pdo, $sql, $paramas); 

if (!$player) {
    exit('キャラクターが見つかりませんでした。');
}
?>

<!-- 3.HTML(編集フォーム） -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>キャラクター編集</title>
    <link rel="stylesheet" href="css/character.css">
    <link rel="icon" href="img/project8.png"> <!-- ファビコンの設定 -->
</head>
<body>
    <h1>キャラクター編集</h1>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo h($player['id']); ?>"> 
        <!-- idは変更されることがないため、hiddenで送信 -->
        
        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="<?php echo h($player['name']); ?>" required><br>
        <!-- value：入力欄の中に初期値を設定する値 -->
        <label for="job">職業</label>
        <select id="job" name="job" required>
            <option value="戦士" <?php if ($player['job'] === '戦士') echo 'selected'; ?>>戦士</option>
            <option value="魔法使い" <?php if ($player['job'] === '魔法使い') echo 'selected'; ?>>魔法使い</option>
            <option value="Gsクリエーター" <?php if ($player['job'] === 'Gsクリエーター') echo 'selected'; ?>>Gsクリエーター</option>
            <option value="Gsイノベーター" <?php if ($player['job'] === 'Gsイノベーター') echo 'selected'; ?>>Gsイノベーター</option>
            <option value="Gsバグバスター" <?php if ($player['job'] === 'Gsバグバスター') echo 'selected'; ?>>Gsバグバスター</option>
            <!-- 現在の職業が、条件に一致すると選択される -->
             <!-- 職業を変えると、それがvalueに入って送信される -->
        </select><br>

        <label for="hp">HP</label>
        <input type="number" id="hp" name="hp" value="<?php echo h($player['hp']); ?>" min="0" required><br>
        <!-- 最小値を0にしました -->

        <label for="mp">MP</label>
        <input type="number" id="mp" name="mp" value="<?php echo h($player['mp']); ?>" min="0" required><br>

        <button type="submit">更新</button>
    </form>
    <a href="register_confirm.php">戻る</a>
</body>
</html>
