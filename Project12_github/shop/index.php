<?php
session_start(); // セッション開始

require_once '../functions/security.php';
require_once 'data.php';
require_once 'menu.php';
loginCheck();

// セッションからデータを取得
$player = $_SESSION['player'] ?? null;
// ??nullは、$playerがnullの場合、nullを返すという意味
// $playerがnullの場合、エラーが発生するので、nullを返すようにしている
// 従来は、isset()関数を使って,$playerのあるなしを記述した。
// 現在は、null合体演算子(??null)を使って簡潔に記述することができる。
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ギークマーケット</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/stylesheet.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <!-- ファビコン設定 -->  
  <link rel="icon" type="image/png" href="./img/fab-theSupper.png">
</head>
<body>
  <div class="menu-wrapper container">
    
    <!-- register_prosessで登録した名前を使って「いらっしゃいませ「name」様と表記させる -->
    <p class="menu-wrapper">
      いらっしゃいませ <?php echo h($player['name']); ?> 様
    </p>

    <h1 class="logo">ジーズ専用！秘密のギークマーケット</h1>
    <h3>メニュー<?php echo Menu::getCount() ?>品</h3>
    <form action="confirm.php" method="post">
      <input type="hidden" name="player_id" value="<?php echo h($player['id']); ?>">
      <!-- 購入結果をデータベースに登録するため -->

        <div class="menu-items">
        <!-- 配列$menusの要素を変数$menuとするforeach(endforeachを活用）で記入 -->
        <?php foreach($allMenus as $menu):?>
            <div class="menu-item">
                <img src="<?php echo $menu->getImage()?>" alt="image">
                
                <!-- show.phpにリンクを貼る -->
                <h3 class="menu-item-name">
                  <a href="show.php?name=<?php echo $menu->getName()?>">
                    <!-- ?　を使ってクエリ情報を送る -->
                    <!-- href="show.php?name=CURRY" -->
                    <!-- href="show.php?キー名=値" -->
                    <?php echo $menu->getName()?>
                    <!-- echoしないとURLに反映されない！ -->
                  </a>
                </h3>

                <!-- if文を用いて、$menuがStressFreeクラスとToolクラスで表示を変える -->
                <?php if($menu instanceof StressFree): ?>
                    <!-- ムードを表示させる -->
                    <p class="menu-item-type">ムード：<?php echo $menu->getType()?></p>
                    <?php else: ?>
                    <!-- for文を用いて、durationプロパティの数だけ表示させる -->
                    <?php for ($i=0; $i < $menu->getDuration(); $i++): ?>
                        <img src="img/clock.png" alt="clock" class='icon-clock'>
                    <?php endfor ?>
                <?php endif ?>
                
                <p class="price">¥<?php echo $menu->getTaxIncludedPrice()?>(税込)</p>
                <!-- <input>タグで入力ボックスを作成（繰り返す） -->
                <!-- ここで入力された値（orderCount)は、nameで識別していますよ！！！ -->
                <input type="text" value="0" name="<?php echo $menu->getName()?>">
                <span>個</span>
            </div>
        <?php endforeach ?>
        </div>
        <!-- <input>タグで送信ボタンを作成 -->
        <input type="submit" value="注文する">
    </form>
  </div>
</body>
</html>