<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$user_id = is_login($con);
if (!$user_id)
    skip('login.php', 'error', '请先登录');

if (isset($_POST['submit'])) {
    $query = "insert into cat(cat_name,cat_color,cat_food,cat_type,cat_position) 
    values('{$_POST['cat_name']}','{$_POST['cat_color']}','{$_POST['cat_food']}','{$_POST['cat_type']}','{$_POST['cat_position']}')";
    execute($con, $query);
    if (mysqli_affected_rows($con) == 1)
        skip('index.php', 'ok', '添加成功');
    else
        skip('add_cat_info.php', 'error', '添加失败,请重试');
}

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat添加猫猫</title>
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
        <p class="demo-panel-title" style="text-align:center">新增猫猫</p>
        <form method="post" class="login-form">
            <div class="form-group">
                猫猫名称:
                <input class="form-control login-field" type="text" name="cat_name" placeholder="请输入猫猫名字" required "><br>
                猫猫颜色:
                <input class=" form-control login-field" type="text" name="cat_color" placeholder="请输入猫猫颜色" required">
            </div>
            <div class="form-group">
                猫猫种类:
                <input class="form-control login-field" type="text" name="cat_type" placeholder="请输入猫猫种类" required"><br>
                猫猫地点:
                <input class="form-control login-field" type="text" name="cat_position" placeholder="请输入猫猫地点" required ">
            </div>
            <div class=" form-group">
                猫猫食物:
                <input class="form-control login-field" type="text" name="cat_food" placeholder="请输入猫猫食物" required"><br>
            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="添加">
        </form>
        <br>
    </div>


    <div class="footer">
    </div>
</body>

</html>