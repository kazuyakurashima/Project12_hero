<?php
session_start(); // セッション開始
require_once 'menu.php';
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

// Menuクラスを継承したToolクラスを定義
class Tool extends Menu {
    // $durationというプロパティを定義
    private $duration;

// コンストラクタを定義
public function __construct($name, $price, $image, $duration) {
    // Menuクラスのコンストラクタを呼び出す
    parent:: __construct($name, $price, $image);
    // $durationプロパティに$durationを代入する
    $this->duration = $duration;
}

// getDurationメソッドを定義
public function getDuration() {
    return $this->duration;
}
}