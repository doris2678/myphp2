<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
</head>
<body>
    <form action="check.php" method='post'>
        <div>
            <label for="acc">帳號:</label>
            <input type="text" name="acc" step="0.01" min="0" required>
        </div>
        <div>
            <label for="pw">密碼:</label>
            <input type="text" name="pw">
        </div>

        <input type="submit" value="登入">
        <input type="reset" value="清空內容">
    </form>

    
</body>
</html> -->

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員登入</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 18px;
      margin: 0;
      padding: 0;
      background-color:rgb(122, 182, 218);
      display: flex;
      justify-content: center; 
      align-items: center; 
      height: 100vh;      
    }

    .login_mem {
      width: 100%;
      max-width: 400px;
      background: #fff;
      padding: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 10px;
      text-align: center;
      border:1px solid black;      
    }

    .login_mem h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .button-group {
      margin-top: 20px;
      display: flex;
      justify-content:space-around;
     }

    input[type="submit"],
    input[type="reset"] {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    input[type="reset"] {
      background-color: #6c757d;
      color: #fff;
    }

    input[type="reset"]:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>
  <div class="login_mem">
    <h2>會員登入</h2>
    <form action="check.php" method="post">
      <div class="form-group">
        <label for="acc">帳號</label>
        <input type="text" id="acc" name="acc" placeholder="請輸入帳號" required>
      </div>
      <div class="form-group">
        <label for="pw">密碼</label>
        <input type="password" id="pw" name="pw" placeholder="請輸入密碼" required>
      </div>
      <div class="button-group">
        <input type="submit" value="登入">
        <input type="reset" value="清空內容">
      </div>
    </form>
  </div>
</body>
</html>


