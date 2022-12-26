<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();

$con = connect();
$user_id = is_login($con);
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat网站信息</title>
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
    if (!$user_id)
        include 'include/header_login.inc.php';
    else
        include 'include/header_user.inc.php';
    ?>
    <div class="container color-container">
        <p class="demo-panel-title" style="text-align:center">网站信息</p>
        <div class="notice">
            暂无
        </div><br>
    </div>

    <div class="footer">
    </div>
</body>

</html>