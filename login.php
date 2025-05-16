<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員登入</title>
  <style>
    .container {
      width: 300px;
      height: 300px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: lightblue;
      margin: auto;
    }
    .button-group {
      margin-top: 10px;
    }
  </style>
</head>
<body>

<?php
  if (isset($_GET['login']) && $_GET['login'] == 1) {
    echo "<p style='color:red; text-align:center;'>請先登入才能使用系統功能。</p>";
  }

  if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<p style='color:red; text-align:center;'>帳號或密碼錯誤！</p>";
  }
?>

<div class="container">
  <form action="check.php" method="post">
    <h2>歡迎登入</h2>
    <div>
      <label for="acc">帳號:</label>
      <input type="text" name="acc" required>
    </div>
    <div>
      <label for="pw">密碼:</label>
      <input type="password" name="pw" required>
    </div>
    <div class="button-group">
      <input type="submit" value="登入">
      <input type="reset" value="清空內容">
    </div>
  </form>
</div>

</body>
</html>
