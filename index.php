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


$query_cat = "select * from cat";
$result_cat = execute($con, $query_cat);
$value_cat = array();
while ($value = mysqli_fetch_assoc($result_cat)) {
    array_push($value_cat, $value);
}

?>

<script type="text/javascript">
    function classRangeChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?class_range=" + $('select[name=class_range] option:selected').val();
        else {
            if (window.location.search.indexOf('class_range=') != (-1))
                window.location.href = window.location.href.replace(/class_range=\d/, "class_range=" + $('select[name=class_range] option:selected').val());
            else
                window.location.href = window.location.href + "&class_range=" + $('select[name=class_range] option:selected').val();
        }
    }

    function classSortChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?class_sort=" + $('select[name=class_sort] option:selected').val();
        else {
            if (window.location.search.indexOf('class_sort=') != (-1))
                window.location.href = window.location.href.replace(/class_sort=\d/, "class_sort=" + $('select[name=class_sort] option:selected').val());
            else
                window.location.href = window.location.href + "&class_sort=" + $('select[name=class_sort] option:selected').val();
        }
    }

    function taskRangeChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?task_range=" + $('select[name=task_range] option:selected').val();
        else {
            if (window.location.search.indexOf('task_range=') != (-1))
                window.location.href = window.location.href.replace(/task_range=\d/, "task_range=" + $('select[name=task_range] option:selected').val());
            else
                window.location.href = window.location.href + "&task_range=" + $('select[name=task_range] option:selected').val();
        }
    }

    function taskSortChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?task_sort=" + $('select[name=task_sort] option:selected').val();
        else {
            if (window.location.search.indexOf('task_sort=') != (-1))
                window.location.href = window.location.href.replace(/task_sort=\d/, "task_sort=" + $('select[name=task_sort] option:selected').val());
            else
                window.location.href = window.location.href + "&task_sort=" + $('select[name=task_sort] option:selected').val();
        }
    }
</script>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat用户首页</title>
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
        <div class="row">
            <div class="col">
                <p class="demo-panel-title" style="text-align:center">猫猫列表</p>
                <div class="notice_list">
                    <?php
                    foreach ($value_cat as $value) {
                        $html = <<<A
                        <form method="post" class="login-form">
                            <div class="form-group">      
                                <p  class="">名称: <strong>{$value['cat_name']}</strong> </p>
                                <p  class="">品种: <strong>{$value['cat_type']}</strong></p>
                                <p class="">颜色: <strong>{$value['cat_color']}</strong></p>
                                <p class="">地点: <strong>{$value['cat_position']}</strong></p>
                                <p class="">食物: <strong>{$value['cat_food']}</strong></p>
                                <p class="">性格: <strong>{$value['cat_character']}</strong></p>
                            </div>
                            <a href="add_blockin_activity.php?cat_id={$value['cat_id']}" class="btn btn-primary btn-lg btn-block" >打卡</a>
                            <a href="add_feed_activity.php?cat_id={$value['cat_id']}" class="btn btn-primary btn-lg btn-block" >投喂</a>
                            <a href="update_cat_info.php?cat_id={$value['cat_id']}" class="btn btn-primary btn-lg btn-block" >修改信息</a>
                            </form>
                        <br>
                        A;
                        echo $html;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br>
</body>

</html>