<?php
// if($_POST['acc']== 'admin' && $_POST['pw'] == '1234'){
//   echo "登入成功";
// }else{
//   echo "登入失敗";
// }

// header("location:login.php?login=1");
session_start();

$username = $_POST['acc'] ?? '';
$password = $_POST['pw'] ?? '';

// 假設帳號密碼為 admin / 1234
if ($username === 'admin' && $password === '1234') {
    $_SESSION['user_id'] = $username;
    header("Location: check_login.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
?>

