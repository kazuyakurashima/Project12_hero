<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// loginCheck()で使用するため、セッションを開始します。
// セッションが既に開始されている場合は、何もしません。

// htmlspecialchars()関数は、特殊文字をHTMLエンティティに変換します（エスケープする）。
// ENT_QUOTESは、シングルクォートとダブルクォートを共に変換します。
// ENT(entities)は、HTMLエンティティ(HTMLにおける特殊文字）を意味します。
// QUOTESは、シングルクォートとダブルクォートを意味します。
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
};


// ログインチェク処理 loginCheck()
// セッションハイジャック対策
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        // $_SESSION['chk_ssid'] が存在しない、または現在のセッションIDと一致しない場合に「ログインエラー」と判断します。
        exit('LOGIN ERROR');
    } else {
        session_regenerate_id(true);
        // セッションIDを再生成します。
        // 引数にtrueを指定すると、古いセッションIDを破棄します。
        $_SESSION['chk_ssid'] = session_id();
    }
}


// セッションIDの流れと不正アクセス防止の仕組みについて

/*
1. ユーザーがページ(session_start()があるページ)にアクセスすると、サーバーは新しいセッションIDを生成し、
   ユーザーのブラウザにクッキーとして送信します。このセッションIDはサーバー側に記録されます。
   クッキーとして送信するとは、ブラウザにセッションIDを保存することです。

2. ユーザーが別のページに移動すると、クッキーに保存されたセッションIDが自動的にサーバーに送られます。
   サーバーはそのセッションIDが記録されたものと一致すれば、同じユーザーと判断します。

3. しかし、セッションIDが漏洩し、悪意のある第三者がそのセッションIDを使ってアクセスした場合、
   クッキーのセッションIDとサーバーの記録は一致してしまい、なりすましが成立する可能性があります。

4. このコードでは、不正アクセスを防ぐために以下の仕組みを導入しています：
   - `$_SESSION['chk_ssid']` に現在のセッションIDを保存。
   - ページアクセス時に `$_SESSION['chk_ssid']` と現在のセッションIDを比較し、一致しない場合は不正アクセスと判断。
   - 一致した場合、セッションIDを再生成し、新しいIDを `$_SESSION['chk_ssid']` に保存。
     これにより、セッション固定攻撃を防ぎます。
*/

