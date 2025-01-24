<?php

// データベース接続用の関数を定義
// データベースの接続に必要な情報を取得（$pdo）
//$pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);

// POD(PHP Data Objects)とは、PHPでデータベースを操作するためのクラス(設計図)
    // $pdo：       PDOクラスのインスタンス（実体）を指す変数
    // prepare()：  PDOクラスのメソッド

    //PDOのインスタンス名は、$pdoが一般的
    // prepare()というメソッドは、SQL文を実行する準備を行い、PDOStatementクラスのインスタンスを返す

        // 'mysql:dbname=データベース名; charset=文字コード; host=ホスト名'が接続情報です。
        // 'root'はユーザー名、''はパスワード（今回は空欄）。
        function db_connect() {
                try {

                    // $dsn =
                    // $user =
                    // $password =
                    // $pdo = new PDO($dsn, $user, $password);
                    // return $pdo;

            } catch (PDOException $e) {
                // エラー内容を表示
                error_log('PDOエラー: ' . $e->getMessage());
                exit('接続エラーが発生しました。管理者にご連絡ください。');
            }
        }