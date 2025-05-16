<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
</head>
 <style>
   /* h2 {
      text-align: center;
      margin-top: 5px;
      color: #333;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      height: 100vh;
      background-image: url('https://source.unsplash.com/1600x900/?technology');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    form {
      background-color:lightblue;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      width: 300px;
    }

    form div {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    } */

    /* .button-group {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }

    .button-group input {
      flex: 1;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"] {
      background-color: #007BFF;
      color: white;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    input[type="reset"] {
      background-color: #f44336;
      color: white;
    }

    input[type="reset"]:hover {
      background-color: #e53935;
    } */
   .container{
    width:300px;
    height:300px;
    display:flex;
    justify-content:space-around;
    align-item:center;
    background-color:lightblue;
    align:center;
   }

  </style>
<body>    

<div class="container">
  <form action="check.php" method='post'>
    <h2> 歡迎登入</h2>
   <div>
     <label for="acc">帳號:</label>
      <input type="text" name="acc" step="0.01" min="0">
   </div>

  <div>
     <label for="pw">密碼:</label>
     <input type="text" name="pw">
  <div>

  <div class="button-group">
   <input type="submit" value="登入">
   <input type="reset" value="清空內容">
  </div>
  </form>
</div>

</body>
</html>
