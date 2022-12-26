<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
if (isset($_POST['submit'])) {
    include 'include/check_register.inc.php';
    $query = "insert into user(user_account,user_password,user_name,user_type) values({$_POST['user_account']},
    '{$_POST['user_password']}','{$_POST['user_name']}','{$_POST['user_type']}')";
    execute($con, $query);
    if (mysqli_affected_rows($con) == 1)
        skip('login.php', 'ok', '注册成功');
    else
        skip('register.php', 'error', '注册失败,请重试');
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZWork注册界面</title>
    <meta name="description" content="" />
    <meta name="viewport" content="">
    <link href="FlatUI/dist/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link href="FlatUI/dist/css/flat-ui.css" rel="stylesheet">
    <link href="FlatUI/docs/assets/css/demo.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 requires Popper.js -->
    <script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
    <script src="FlatUI/dist/scripts/flat-ui.js"></script>
    <script src="FlatUI/docs/assets/js/application.js"></script>
</head>

<body>
    <?php
    include "include/header_login.inc.php"
    ?>

    <div class="container">
        <div class="login">
            <div class="login-screen">
                <div class="login-icon">
                    <img src="src/icon.png" alt="Welcome here" />
                    <h4>Welecome <small>here</small></h4>
                </div>
                <form method="post" class="login-form">
                    <div class="form-group">
                        <input class="form-control login-field" type="text" name='user_account' placeholder='学号 6至12位 纯数字' required pattern="\d{6,12}">
                        <input class="form-control login-field" type="password" name='user_password' placeholder='密码 6至24位 字母 数字 下划线' required pattern="\w{6,24}">
                        <input class="form-control login-field" type="password" name='user_password_repeat' placeholder='重复密码' required>
                        <input class="form-control login-field" type="text" name='user_name' placeholder='姓名 2至10位 汉字' required pattern="[\u4E00-\u9FFF+\w]{2,10}">
                    </div>
                    <div class="form-group">
                        <select name='user_type' class="form-control select select-primary" data-toggle="select">
                            <option value="user" selected> 用户注册</option>
                            <option value="admin"> 管理员注册</option>
                        </select>
                    </div>
                    <input class="btn btn-primary btn-lg btn-block" type="submit" name='submit' value='注册'>
                </form>
            </div>
        </div>
    </div>

</body>

</html>