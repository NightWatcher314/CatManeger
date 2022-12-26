<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$user_id = is_login($con);
if (!$user_id)
    skip('login.php', 'error', '请先登录');
$query_user = "select * from user where user_id={$user_id}";
$result_user = execute($con, $query_user);
$value_user = mysqli_fetch_assoc($result_user);

if (isset($_POST['submit'])) {
    if (isset($_POST['account'])) {
        skip("update_account_info.php", 'error', '账号禁止修改,建议重开');
    } else if (isset($_POST['user_password'])) {
        $query_update = "update user set user_password='{$_POST['password']}' where user_id={$user_id}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_account_info.php", 'ok', '修改密码成功');
    } else if (isset($_POST['user_name'])) {
        $query_update = "update user set user_name='{$_POST['user_name']}' where user_id={$user_id}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_account_info.php", 'ok', '修改姓名成功');
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZWork个人信息界面</title>
    <meta name="description" content="" />
    <meta name="viewport" content="">

    <link href="style/notice.css" rel="stylesheet">
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
    include "include/header_user.inc.php"
    ?>

    <div class="container color-container">
        <p class="demo-panel-title" style="text-align:center">账户信息</p>
        <div class="notice">
            <?php
            $html = <<<A
                <form class="" method="post">
                    <div class="row">
                        <p class="col">学号: <strong>{$value_user['user_account']}</strong> </p>
                        <input class="form-control login-field col" type="text" name='user_account' placeholder='新学号' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value="修改学号">
                        </div>
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">姓名: <strong>{$value_user['user_name']}</strong></p>    
                        <input class="form-control login-field col" type="text" name='user_name' placeholder='新姓名' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改姓名'>
                        </div> 
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">密码: <strong>我也不知道</strong></p>    
                        <input class="form-control login-field col" type="text" name='user_password' placeholder='新密码' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改密码'>
                        </div>
                    </div>
                </form>
                A;
            echo $html;
            ?>
        </div><br>
    </div>

</body>

</html>