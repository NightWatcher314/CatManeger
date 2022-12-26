<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$user_id = is_login($con);
if ($user_id && $_SESSION['user_type'] == "user")
    skip('index.php', 'ok', '您已登录');
if ($user_id && $_SESSION['user_type'] == "admin")
    skip('admin_index.php', 'ok', '您已登录');
if (isset($_POST['submit'])) {
    include 'include/check_login.inc.php';
    session_start();
    $time = 30 * 24 * 60 * 60;
    setcookie(session_name(), session_id(), time() + $time, '/');
    $_SESSION['user_account'] = $_POST['user_account'];
    $_SESSION['user_password'] = $_POST['user_password'];
    $_SESSION['user_type'] = $_POST['user_type'];
    if ($_POST['user_type'] == 'user')
        skip("index.php", 'ok', '登录成功');
    else
        skip("admin_index.php", 'ok', '登录成功');
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat登录界面</title>
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
                    <h4>Welcome<small>here</small></h4>
                </div>
                <form method="post" class="login-form">
                    <div class="form-group">
                        <input class="form-control login-field" type="text" name='user_account' placeholder='学号 6至12位 纯数字' required pattern="\d{6,12}">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>
                    <div class="form-group">
                        <input class="form-control login-field" type="password" name='user_password' placeholder='密码 6至24位 字母 数字 下划线' required pattern="\w{6,24}">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                    <div class="form-group">
                        <select name='user_type' class="form-control select select-primary" data-toggle="select">
                            <option value="user" selected> 用户登录</option>
                            <option value="admin"> 管理员登录</option>
                        </select>
                    </div>
                    <input class="btn btn-primary btn-lg btn-block" type="submit" name='submit' value='登录'>
                </form>
            </div>
        </div>
    </div>

</body>

</html>