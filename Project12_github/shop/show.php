<?php
session_start();

// セキュリティ対策のためのファイルを読み込む
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト
require_once 'data.php';
require_once 'menu.php';


// $_GETでクエリ情報の値を受け取って、変数に代入
// 商品名をクリックした際に、URLにクエリ情報が付与されている
$selectedMenu = $_GET['name'];
// Menuクラスに対してfindByNameというクラスメソッドを呼び出す
$menu = Menu::findByName($allMenus, $selectedMenu);
// MenuのクラスメソッドfindByNameに、$allMenusと$selectedMenuを引数として渡す
// $allMenusは、全ての商品情報が入っている配列
// $selectedMenuは、クリックした商品名が入っている,Reviewクラスのプロパティ
// $menuは、$allMenusの中から、$selectedMenuと一致する商品情報が入っている
// $menuは、Menuクラスを継承した、stressFree,toolのインスタンスが入っている
// $menuは、name,price,image,orderCountのプロパティを持っているオブジェクトでもある

// 該当した商品（menu)と一致したレビューの集まりを取得
$allSelectedReviews = $menu->getReviews($allReviews);
// $allSelectedReviewsは、$menuの商品名と一致したレビューの集まりが入っている
// $allReviewsから、reviewの名前と、$menuの名前が一致したものを取り出す
// 取りだしたreviewを、allSelectedReviews（配列）に入れる
// getReviews()では、selectedReviewsを返す
// $allSelectedReviewsは、getReviews()で返されたselectedReviewsが入っている

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Progate</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
      </var><!-- ファビコン設定 -->  
      <link rel="icon" type="image/png" href="./img/fab-theSupper.png">
  </head>

  <body>
    
    <!-- クリックされた商品の表示 -->
      <div class="review-wrapper">
        <div class="review-menu-item">
          <!-- クリックされた商品の写真・名前・タイプ/寿命・料金を表示させる -->
          <img src="<?php echo $menu->getImage() ?>" class="menu-item-image">
          <h3 class="menu-item-name"><?php echo $menu->getName() ?></h3>
          <!-- $menuは、選ばれた商品のオブジェクト（name,price,imageなどプロパティを持つ） -->

          <!-- $menuがStressFreeクラスのインスタンスならタイプを表示 -->
          <?php if ($menu instanceof StressFree): ?>
            <p class="menu-item-type"><?php echo $menu->getType() ?></p>
          <?php else: ?>
          <!-- $menuがToolクラスのインスタンスなら寿命アイコンを表示 -->
            <?php for ($i = 0; $i < $menu->getDuration(); $i++): ?>
              <img src="img/clock.png" alt="clock" class='icon-clock'>
            <?php endfor ?>
          <?php endif ?>
          <!-- クリックされた商品の料金表示 -->
          <p class="price">¥<?php echo $menu->getTaxIncludedPrice() ?></p>
        </div>

      <!-- レビュー一覧の表示 -->
        <div class="review-list-wrapper">
          <div class="review-list">
            <div class="review-list-title">
              <img src="img/star.jpeg" class='icon-review'>
              <h4>レビュー一覧</h4>
              <h4>
              <a href="show_review.php?product_name=<?php echo urlencode($menu->getName()); ?>">レビューを書く</a>
              </h4>
              <?php foreach ($allSelectedReviews as $review): ?>
                <!-- $allSelectedReviewsは、$menuの商品名と一致したレビューの集まりが入っている -->
                <!-- $reviewは、$allSelectedReviewsの中から、一つずつ取り出される -->
                <!-- $reviewは、Reviewクラスのインスタンス（selectedMenu,reviewer,reviewContent） -->
              <?php $user = $review->getUser($allUsers) ?>
              <!-- $userは、$reviewのreviewer（レビューを書いた人の名前）と、ユーザーの名前が一致した人のオブジェクトを返す（name,genderというプロパティを持つ） -->
                <div class="review-list-item">
                  <div class="review-user">
                    <!-- if文を用いてgenderプロパティによって画像を表示 -->
                    <?php if ($user->getGender() === 'warrior'): ?>
                    <img src="img/warrior.jpeg" class='icon-user'>
                    <?php else: ?>
                    <img src="img/mage.jpeg" class='icon-user'>
                    <?php endif ?>
                  <p><?php echo $user->getName() ?></p>
                </div>
                <p class="review-text"><?php echo $review->getReviewContent() ?></p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      <a href="index.php">← メニュー一覧へ</a>
    </div>
  </body>
</html>