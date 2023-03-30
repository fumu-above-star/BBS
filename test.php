<?php
session_start();
require('dbconnect.php');
if(!empty($_POST)){
    $_SESSION['join'] = $_POST;
    header('Location: test3.php');//header("Location: http://www.example.com/"); /* ブラウザをリダイレクトします */
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>会員登録をする</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" class="registrationform">


    <p>ニックネーム<input type="text" name="name" style="width:150px" value="<?php echo htmlspecialchars($_POST['name']??"", ENT_QUOTES); ?>"></p>
    <p>email<input type="text" name="email" style="width:150px" value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>"></p> <!-- 誤 htmlspecailchars 正 htmlspecialchars -->
    <p>パスワード<input type="password" name="password" style="width:150px" value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>"></p>
    <p>パスワード再入力<span class="red">*</span><input type="password" name="password2" style="width:150px"></p> <!-- span要素は特定の意味を持ちませんが、class、lang、dir属性といったグローバル属性と組み合わせることで、内包するフレーズをグループ化できます。 -->
<input type="submit" value="確認する" class="button">
</form>
</body>
</html>
