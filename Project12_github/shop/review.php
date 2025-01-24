<?php
session_start(); // セッション開始
require_once '../functions/security.php';
loginCheck(); // ログインしていない場合、ログイン画面にリダイレクト

class Review {
    private $selectedMenu;
    // $selectedMenuは、選択されたレビューの商品名
    private $reviewerId;
    // $reviewerIdは、レビューを書いたユーザーのID(ユーザーIDと紐付け)
    private $reviewContent;
    // $reviewContentは、レビューの内容

    // Reviewクラスのコンストラクトを定義
    public function __construct($selectedMenu, $reviewerId, $reviewContent) {
        $this->selectedMenu = $selectedMenu;
        $this->reviewerId = $reviewerId;
        $this->reviewContent = $reviewContent;
    }

    // Reviewクラスのゲッターを定義
    public function getSelectedMenu() {
        return $this->selectedMenu;
    }

    // Reviewクラスのゲッターを定義
    public function getUser($allUsers) {
        foreach($allUsers as $user) {
            if($user->getId() === $this->reviewerId) {
                return $user;
            }
        }
    }

    public function getReviewContent() {
        return $this->reviewContent;
    }
}