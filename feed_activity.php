<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$user_id = is_login($con);
if (!$user_id)
    skip('login.php', 'error', '请先登录');

$map_user_id_to_name;
$map_cat_id_to_name;

$query_user = "select * from user";
$result_user = execute($con, $query_user);
$value_user = array();
while ($value = mysqli_fetch_assoc($result_user)) {
    array_push($value_user, $value);
    $map_user_id_to_name[$value['user_id']] = $value['user_name'];
}

$query_cat = "select * from cat";
$result_cat = execute($con, $query_cat);
$value_cat = array();
while ($value = mysqli_fetch_assoc($result_cat)) {
    array_push($value_cat, $value);
    $map_cat_id_to_name[$value['cat_id']] = $value['cat_name'];
}

$query_feed = "select * from feed";
$result_feed = execute($con, $query_feed);
$value_feed = array();
while ($value = mysqli_fetch_assoc($result_feed)) {
    $value['cat_name'] = $map_cat_id_to_name[$value['cat_id']];
    $value['user_name'] = $map_user_id_to_name[$value['user_id']];
    array_push($value_feed, $value);
}

?>

<script type="text/javascript">
    function feedRangeChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?feed_range=" + $('select[name=feed_range] option:selected').val();
        else {
            if (window.location.search.indexOf('feed_range=') != (-1))
                window.location.href = window.location.href.replace(/feed_range=\d/, "feed_range=" + $('select[name=feed_range] option:selected').val());
            else
                window.location.href = window.location.href + "&feed_range=" + $('select[name=feed_range] option:selected').val();
        }
    }

    function feedSortChange() {
        if (window.location.search == "")
            window.location.href = window.location.href + "?feed_sort=" + $('select[name=feed_sort] option:selected').val();
        else {
            if (window.location.search.indexOf('feed_sort=') != (-1))
                window.location.href = window.location.href.replace(/feed_sort=\d/, "feed_sort=" + $('select[name=feed_sort] option:selected').val());
            else
                window.location.href = window.location.href + "&feed_sort=" + $('select[name=feed_sort] option:selected').val();
        }
    }
</script>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ZCat投喂信息</title>
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
                <p class="demo-panel-title" style="text-align:center">投喂信息</p>
                <select class="form-control select select-primary" style="float:left" data-toggle="select" name='feed_range' onchange=" feedRangeChange()">
                    <option value="0" selected>显示范围</option>
                    <option value="1">今日</option>
                    <option value="2">今月</option>
                    <option value="3">全部</option>
                </select>
                <select class="form-control select select-primary" style="float:right" data-toggle="select" name='feed_sort' onchange="feedSortChange()">
                    <option value="0" selected>显示顺序</option>
                    <option value="1">时间升序</option>
                    <option value="2">时间降序</option>
                </select>
                <br>
                <br>
                <div class="notice_list">
                    <?php
                    foreach ($value_feed as $value) {
                        $html = <<<A
                        <form method="post" class="login-form">
                            <div class="form-group">      
                                <p  class="">名称: <strong>{$value['cat_name']}</strong> </p>
                                <p  class="">时间: <strong>{$value['feed_time']}</strong></p>
                                <p class="">地点: <strong>{$value['feed_position']}</strong></p>
                                <p class="">食物: <strong>{$value['feed_food']}</strong></p>
                                <p class="">投喂人: <strong>{$value['user_name']}</strong></p>
                            </div>
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