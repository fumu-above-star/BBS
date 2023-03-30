<?php
session_start();
require('dbconnect.php');//require 他ファイルのプログラムを呼び出す

if( isset( $_SESSION['id']) && ($_SESSION['time'] + 3600 > time()) ){//一日以内であればセッションを通す
    $_SESSION['time'] = time();

    $members=$db->prepare('SELECT * FROM members WHERE id=?');//?はプレースホルダーSQLインジェクションの対策SQLを直接操作させない?にはその後のexecuteで変数を入れる
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
    }else{
    header('Location: test4.php');
    exit();    
}

if(!empty($_POST)){
    if( isset($_POST['token']) && ($_POST['token'] == $_SESSION['token']) ){
        $message=$db->prepare('INSERT INTO posts SET created_by=?, message=?, created=NOW()');//NOW()今の日付を取得
        $message->execute(array($member['id'], $_POST['message']));
        header('Location: test5.php');
        exit();
    }else{
        header('Location: test4.php');
        exit();
    }
}

$posts=$db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.created_by ORDER BY p.created DESC');
//なお、テーブル名は毎回入力するのが面倒。そこでFromの箇所で【members m】と書くことで、membersテーブルはmと省略可能になります。
//同様に、【posts p】と書くことで、postsテーブルはpと省略可能になります。
$TOKEN_LENGTH = 16;
$tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
$token = bin2hex($tokenByte);//2進数から16進数へ
$_SESSION['token'] = $token;

?>

<!DOCTYPE html>
<html lang="ja">

<body>

<header>
<div class="head">
<h1>週末プラン投稿画面</h1>
<span class="logout"><a href="test4.php">ログアウト</a></span>

</div>
</header>

<form action='' method="post">
<input type="hidden" name="token" value="<?=$token?>"> <!--ここでtokenがsubmitと同時に送られる name='token'を持ったpostになるらしい-->
<?php if(isset($error['login']) && ($error['login'] == 'token')):?>
    <p class="error">不正なアクセス</p>
<?php endif; ?>
<div class="edit">
<p><?php echo htmlspecialchars($member['name'], ENT_QUOTES);?>さん、ようこそ</p>
<textarea name="message" cols='50' rows='10'><?php echo htmlspecialchars($message??"", ENT_QUOTES);?></textarea>
</div>

<input type="submit" value="投稿する" class="button02">
</form>

<?php foreach($posts as $post): ?>
<div class="message">
<?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
<span class="name"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?> | <?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?>|
<!--</div> -->

<?php if($_SESSION['id'] == $post['created_by']):?>
<a href="test6.php?id=<?php echo htmlspecialchars($post['message_id'], ENT_QUOTES); ?>"> 削除</a>]<?php endif; ?></span></p>
<?php endforeach; ?>
</body>
</html>