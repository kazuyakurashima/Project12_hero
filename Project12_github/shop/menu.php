<?php
session_start(); // セッション開始
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

// クラス定義用のファイル

class Menu {
    //name,price,imageプロパティを定義 
    // これらは外部から変更出来ないように、プロパティのアクセス権をprotectedにしました。
    // 今回は、Menuクラスと継承したクラス(StressFree,Tool)からしかアクセスできないようにしました。

    // publicは、どこからでもアクセスできる
    // protectedは、自分自身と継承したクラスからアクセスできる
    // privateは、自分自身のクラスからのみアクセスできる

    protected $name;
    protected $price;
    protected $image;
    protected $orderCount = 0;
    // これらは、インスタンス毎に変わる値を取ることができます

    protected static $count = 0;
    // staticは、クラスに所属する変数や関数を定義する際に使う
    // staticは、クラスが持つデータであり、クラスプロパティという
    // staticは、インスタンスが持つデータ(プロパティ）ではない
    // staticは、インスタンスを作らなくても使える

    // コンストラクタ(construct)を定義（newを使って新しいインスタンスを作ると自動で生成するもの）
    // コンストラクタの引数に$name,$price,$imageを入れて、定義しちゃう
    // thisはクラスのメソッド内でのみ使える変数
    public function __construct($name,$price,$image) {
    $this->name = $name;
    $this->price = $price;
    $this->image = $image;
    self::$count++;
    // self::$countは、Menu::$countと同じ意味
    // selfのメリット：クラス内で使うと、クラス名を変更しても使える
    // selfのメリット：クラスを拡張（継承）しても使える
    // $countは、Menuのインスタンスが作られるたびに1ずつ増える（インスタンスの数を数える）
    }

    // getのメソッドを定義（privateにしているので、プロパティを呼び出す関数が必要）
    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getOrderCount() {
        return $this->orderCount;
    }

    // setOrderCountメソッドを定義（privateにしているので、値をセットする関数が必要）
    // nameやpriceは変わらない数字だが、orderCountはその都度変わる値。変数である。
    // setOrderCountという関数を使うと、orderCountを安全に変更できる
    public function setOrderCount($orderCount) {
        $this->orderCount = $orderCount;
    }

    // getTaxIncludedPriceメソッドを定義
    public function getTaxIncludedPrice() {
        return floor($this->price * 1.1);
    }

    // getTotalPriceメソッドを定義
    public function getTotalPrice() {
        return $this->getTaxIncludedPrice() * $this->orderCount;
    }

    // getReviewsメソッドを定義
    public function getReviews($allReviews) {
        $selectedReviews = array();
        // $selectedReviewsという空の配列を作成
        // $selectedReviewsは、商品名がクリックした商品と一致したレビューを入れるための配列
        foreach($allReviews as $review) {
            // allReviewsは、レビューのインスタンスが入っている配列
            // $allReviewsの中身を1つずつ取り出して、$reviewに代入
            if($review->getSelectedMenu() == $this->name) {
            // 取り出した1つのレビューの商品名と、今処理中（クリックした）商品名が一致した場合
                $selectedReviews[] = $review;
                // []は、配列の末尾に要素を追加する演算子
            }
        }
        return $selectedReviews;
        // 今処理中（クリックした）商品名と一致したレビューの集まりを返す
    }

    public static function getCount() {
        return self::$count;
    }

    // findByNameというクラスメソッドを定義
    // allMenus(商品一覧)から、クリックした商品名と一致する商品を探し出す
    // 名前が一致したら、$menuに商品情報を入れる
    public static function findByName($allMenus, $name){
        foreach($allMenus as $menu) {
            if($menu->getName() == $name) {
                return $menu;
            }
        }
    }

    // 普通のメソッドは、インスタンスを作成してから使う
    // クラスを定義して、そのクラスの実態（インスタンス）を作成
    // そのクラスのインスタンスに対して、メソッドを使う

    // static：静的な、変わらない、固定された
    // static：クラスに固定されたもの

    // 普通のメソッド（動的）：インスタンス毎に動きが変わる
    // staticメソッド（静的）：クラスに固定されたもの
}
?>