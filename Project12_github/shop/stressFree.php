<?php
session_start(); // セッション開始
require_once 'menu.php';
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

// Menuクラスを継承したStressFreeクラスを定義
class StressFree extends Menu {
        // typeプロパティを定義
        private $type;

// コンストラクタを定義
// Menuクラスのコンストラクタをオーバーライドする
// 引数に$typeを追加
    public function __construct($name, $price, $image, $type) {
    parent:: __construct($name, $price, $image);
    // parent::は、親クラス（Menuクラス）のメソッドを呼び出す時に使う
    // 親クラスのコンストラクタは一番したを参照
    // オーバーライド：親クラスのメソッドを子クラスで上書きすること
    $this->type = $type;
    // $this->typeは、StressFreeクラスのプロパティ
    // $typeは、親クラス(Menuクラス)にはないプロパティなのでこちらで定義する   
  }

        // getTypeメソッドを定義
        public function getType() {
            return $this->type;
        }

    }

    // Menuクラスのコンストラクタは、下記の通り
    // public function __construct($name,$price,$image) {
    //     $this->name = $name;
    //     $this->price = $price;
    //     $this->image = $image;