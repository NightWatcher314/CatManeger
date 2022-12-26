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
    $query = "INSERT INTO blockin(blockin_time, blockin_image,user_id, cat_id, blockin_position) 
    VALUES (now(), '{$_POST['blockin_image']}',{$user_id} ,{$_GET['cat_id']}, '{$_POST['blockin_position']}')";
    execute($con, $query);
    if (mysqli_affected_rows($con) == 1) {
        skip("index.php", 'ok', "投喂成功");
    } else
        skip("join_class.php", 'error', "加入失败请重试");
}

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat新增打卡</title>
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
    include 'include/header_user.inc.php';
    ?>
    <div class="container color-container">
        <br>
        <form method="post" class="login-form">
            <div class="form-group">
                <input class="form-control login-field" type="text" name='blockin_position' placeholder='地点' required>
                <br>
                <input class="form-control login-field" type="text" name='blockin_image' placeholder='图片' required>
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name='submit' value='打卡'>
        </form>
        <br>
    </div>

    <div class="footer">
    </div>
</body>

</html>