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

$query_cat = "select * from cat where cat_id={$_GET['cat_id']}";
$result_cat = execute($con, $query_cat);
$value_cat = mysqli_fetch_assoc($result_cat);


if (isset($_POST['submit'])) {
    if (isset($_POST['cat_name'])) {
        $query_update = "update cat set cat_name='{$_POST['cat_name']}' where cat_id={$_GET['cat_id']}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_cat_info.php?cat_id={$_GET['cat_id']}", 'ok', '修改姓名成功');
    } else if (isset($_POST['cat_color'])) {
        $query_update = "update cat set cat_color='{$_POST['cat_color']}' where cat_id={$_GET['cat_id']}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_cat_info.php?cat_id={$_GET['cat_id']}", 'ok', '修改姓名成功');
    } else if (isset($_POST['cat_type'])) {
        $query_update = "update cat set cat_type='{$_POST['cat_type']}' where cat_id={$_GET['cat_id']}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_cat_info.php?cat_id={$_GET['cat_id']}", 'ok', '修改姓名成功');
    } else if (isset($_POST['cat_food'])) {
        $query_update = "update cat set cat_food='{$_POST['cat_food']}' where cat_id={$_GET['cat_id']}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_cat_info.php?cat_id={$_GET['cat_id']}", 'ok', '修改姓名成功');
    } else if (isset($_POST['cat_position'])) {
        $query_update = "update cat set cat_position='{$_POST['cat_position']}' where cat_id={$_GET['cat_id']}";
        $result_update = execute($con, $query_update);
        if (mysqli_affected_rows($con) == 1)
            skip("update_cat_info.php?cat_id={$_GET['cat_id']}", 'ok', '修改姓名成功');
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat修改猫猫信息</title>
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
        <p class="demo-panel-title" style="text-align:center">猫猫信息</p>
        <div class="notice">
            <?php
            $html = <<<A
                <form class="" method="post">
                    <div class="row">
                        <p class="col">名字: <strong>{$value_cat['cat_name']}</strong> </p>
                        <input class="form-control login-field col" type="text" name='cat_name' placeholder='新名字' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value="修改名字">
                        </div>
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">颜色: <strong>{$value_cat['cat_color']}</strong></p>    
                        <input class="form-control login-field col" type="text" name='cat_color' placeholder='新颜色' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改颜色'>
                        </div> 
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">品种: <strong>{$value_cat['cat_type']}</strong></p>    
                        <input class="form-control login-field col" type="text" name='cat_type' placeholder='新品种' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改品种'>
                        </div> 
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">地点: <strong>{$value_cat['cat_position']}</strong></p>    
                        <input class="form-control login-field col" type="text" name='cat_type' placeholder='新地点' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改地点'>
                        </div> 
                    </div>
                </form>
                <form class="" method="post">
                    <hr>
                    <div class="row">
                        <p class="col">食品: <strong>{$value_cat['cat_food']}</strong></p>    
                        <input class="form-control login-field col" type="text" name='cat_type' placeholder='新食品' required">
                        <div class="col row">
                            <div class="col"></div>
                            <input class="col btn btn-block btn-lg btn-success" type='submit' name='submit' value='修改食品'>
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