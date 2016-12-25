<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员登录</title>
    <link rel="stylesheet" href="../static/css/login.min.css">
</head>
<body class="ts">

    <form action="login.php?action=login" name="login" method="post">
        <h2>管理员登录</h2>
        <p>
            <label for="username">用户名</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="password">密码</label>
            <input type="password" name="password" id="password">
        </p>
        <p>
            <label for="authcode">验证码</label>
            <input type="text" name="authcode" id="authcode">
            <img src="../code.php" alt="" id="code">
        </p>
        <p><input type="submit" value="登录"></p>
    </form>
    <script type="text/javascript">
        document.querySelector("#code").onclick = function() {
            this.src = "../code.php?id=" + Math.random();
        }
    </script>
</body>
</html>
