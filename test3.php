<?php
session_start();//セッションは、Webサイトにアクセスして行う一連の流れのことです。サイトを訪れたユーザデータを個別に管理できます。簡単に言うと、サーバー側に情報を保存できる仕組みです。
require('dbconnect.php');

if(!isset($_SESSION['join'])){
    header('Location: test2.php');
    exit();
}

$hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);//パスワードをハッシュ変換

if(!empty($_POST)){
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');//membersというデータベースにname email password の値と現在時刻を挿入する準備
    $statement->execute(array($_SESSION['join']['name'],$_SESSION['join']['email'],$hash));//execute ::PDOStatement 準備されているstatementを実行する 今回はsql文実行
    unset($_SESSION['join']);//unset unset() は指定した変数を破棄します
    header('Location: test4.php');
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>キレてないっすよ</title>
</head>
<body>
<form action="" method="post">

<input type="hidden" name="action" value="submit">
<div class="label">
    <p>ニックネーム
    <span class="check"><?php echo (htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?></span>
    </p><br />
    <p>email
    <span class="check"><?php echo (htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></span>
    </p><br />
    <p>パスワード
    <span class="check">[セキュリティのため非表示] </span>
</p><br />

<input type="button" onclick="location.href='test2.php?action=rewrite'" value="修正する" name="rewrite" class="button02"><!-- test2.php?action=rewriteはGET['action'] = 'rewrite' -->
<input type="submit" onclick="location.href='test4.php'" value="登録する" name="registration" class="button">
</form>
</body>
</html>