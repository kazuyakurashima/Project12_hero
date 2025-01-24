<?php
session_start(); // セッション開始
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

// Userクラスを定義
class User {
    // プロパティを定義
    private $id;
    private $name;
    private $gender;
    private static $count = 0;
    // staticは、クラスに所属する変数や関数を定義する際に使う
    // staticは、クラスが持つデータであり、クラスプロパティという
    // staticは、インスタンスが持つデータ(プロパティ）ではない
    // staticは、インスタンスを作らなくても使える

    public function __construct($name,$gender) {
        $this->name = $name;
        $this->gender = $gender;
        
        self::$count++;
        // self::$countは、Menu::$countと同じ意味
        // selfのメリット：クラス内で使うと、クラス名を変更しても使える
        // selfのメリット：クラスを拡張（継承）しても使える
        // $countは、Userのインスタンスが作られるたびに1ずつ増える（インスタンスの数を数える）

        // idプロパティにクラスプロパティ$countの値を代入
        $this->id = self::$count;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getGender() {
        return $this->gender;
    }
}
?>