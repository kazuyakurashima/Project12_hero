<?php
session_start(); // セッション開始

// ファイルの読み込み
require_once 'stressFree.php';
require_once 'tool.php';
require_once 'review.php';
require_once 'user.php';
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

// データ定義用のファイル
//  Menuクラスのインスタンス（設計図）を作り、変数を定義した。引数も入れた。
$ErrorFreeMug = new StressFree('エラー回避のお守りG’sマグカップ', 1300, 'img/ErrorFreeMug.jpg', 'ハイテンション系');
$DeployCandle = new StressFree('必ずﾃﾞﾌﾟﾛｲ成功!アロマキャンドル', 700, 'img/DeployCandle.jpg', 'リラックス系');
$TurboThursday = new Tool('木曜日限定！徹夜コーヒー', 500, 'img/TurboThursday.jpg', 1);
$BugWand = new Tool('バグ消しの魔法の杖',12000, 'img/BugWand.jpg', 4);

// 配列に、4つのインスタンスを入れて、変数$allMenusに代入
$allMenus = array($ErrorFreeMug, $DeployCandle, $TurboThursday, $BugWand);


// ユーザーのインスタンスを作成
$user1 = new User('ジーズ', 'warrior');
$user2 = new User('まえたつ', 'mage');
$user3 = new User('サリーちゃん', 'mage');
$user4 = new User('きんぱつかのみ', 'warrior');

// ユーザーのインスタンスを配列に入れる
$allUsers = array($user1, $user2, $user3, $user4);

// レビューのインスタンスを作成
$review1 = new Review($ErrorFreeMug->getName(), $user1->getId(), 'とても使いやすかったです。持ちやすくてお気に入りです。');
$review2 = new Review($DeployCandle->getName(), $user1->getId(), '香りがいいです。部屋がリラックスした雰囲気になりました。');
$review3 = new Review($TurboThursday->getName(), $user2->getId(), '朝まで頑張れました。元気が出る味です。');
$review4 = new Review($BugWand->getName(), $user2->getId(), 'バグが消えました。コードレビューが楽になりました。');
$review5 = new Review($ErrorFreeMug->getName(), $user3->getId(), 'エラーが出なくなりました。快適なコーディング時間が過ごせます。');
$review6 = new Review($DeployCandle->getName(), $user3->getId(), 'リラックスできました。集中力が持続します。');
$review7 = new Review($TurboThursday->getName(), $user4->getId(), 'コーヒーが美味しかったです。疲れが吹き飛びました。');
$review8 = new Review($BugWand->getName(), $user4->getId(), 'バグが消えるのが早かったです。ストレスが軽減しました。');
$review9 = new Review($ErrorFreeMug->getName(), $user1->getId(), '軽くて丈夫です。洗いやすい点も素晴らしいです。');
$review10 = new Review($DeployCandle->getName(), $user2->getId(), '作業が捗ります。優しい香りが心地よいです。');
$review11 = new Review($TurboThursday->getName(), $user3->getId(), '夜更かしが楽になりました。パッケージもおしゃれです。');
$review12 = new Review($BugWand->getName(), $user4->getId(), '魔法のようでした。毎日使いたいです。');
$review13 = new Review($ErrorFreeMug->getName(), $user2->getId(), 'デザインが素敵です。プレゼントにも最適です。');
$review14 = new Review($DeployCandle->getName(), $user4->getId(), 'おしゃれな香りです。来客にも褒められました。');
$review15 = new Review($TurboThursday->getName(), $user1->getId(), '朝が楽でした。一日の始まりに欠かせません。');
$review16 = new Review($BugWand->getName(), $user3->getId(), '驚くほど効きました。これなしでは作業できません。');

// $ErrorFreeMugの親クラスはStressFree。その親クラスはMenu。
// Menuで定義したプロパティは、protectedなので、子クラスからもアクセスできる。
// ただし、プロパティ（例えばname）使う場合には、ゲッターを使う必要がある。

// レビューのインスタンスを配列に入れる
$allReviews = array(
    $review1, $review2, $review3, $review4, $review5, $review6, $review7, $review8,
    $review9, $review10, $review11, $review12, $review13, $review14, $review15, $review16
);
?>