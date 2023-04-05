<?php
session_start();
require('dbconnect.php');

if(!empty($_POST)){
    if(($_POST['email'] != '') && ($_POST['password'] != '')){
        $login = $db->prepare('SELECT * FROM members WHERE email=?');
        $login->execute(array($_POST['email']));
        $member=$login->fetch();//emailに該当する行のデータを1行取るmemberをfetchallは全ての行

        if(password_verify($_POST['password'],$member['password'])){//password_verify(); ◆password_verify ハッシュ化したパスワードを認証するときにつかう
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();
            header('Location: bbs.php');
            exit();
        }else{
            $error['login'] = 'failed';
        }
    }else{
        $error['login'] = 'blank';
    }
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
</head>
<body>

<form action="" method="post">

    <p>email<input type="text" name="email" style="width:150px" value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES);?>">
    <?php if( isset($error['login']) && ($error['login'] == 'blank') ):?>
    <p class="error"> メールとパスワードを入力してください</p>
    <?php endif; ?>

    <?php if( isset($error['login']) && ($error['login'] == 'failed') ):?>
    <p class="error">メールかパスワードが間違っています</p>
    <?php endif; ?>
    </p><br>

    <p>パスワード<input type="password" name="password" style="width:150px" value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES);?>">
    </p>

<div class="login2"><input type="submit" value="ログインする" class="button"></div>

</form>
</body>
</html>