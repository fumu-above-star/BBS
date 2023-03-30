<?php
    try{
        $db = new PDO ('mysql:dbname=test2; host=127.0.0.1; charset=utf8', 'root', '');//左から順にDB名、DBの場所、charset、DBのユーザー名、パスワード
    } catch(PDOExecption $e){// PDOExecption PDO が発するエラーを表します。
        echo 'DB接続エラー' . $e->getMessage;
    }

?>