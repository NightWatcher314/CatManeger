<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$teacher_id = is_login($con);
if (!$teacher_id)
    skip('login.php', 'error', '请先登录');
$query_teacher = "select * from teacher where id={$teacher_id}";
$result_teacher = execute($con, $query_teacher);
$value_teacher = mysqli_fetch_assoc($result_teacher);

$query_class = "select * from class where find_in_set('{$value_teacher['id']}',master_id)";
if (isset($_GET['class_range'])) {
    $cur_term = (date('m') >= 3 && date('m') <= 8) ? '1' : '2';
    $cur_year = ($cur_term == "秋季" && date('m') <= 2) ? date('Y') - 1 : date('Y');
    if ($_GET['class_range'] == 1) {
        $query_class .= " and term='{$cur_year},{$cur_term}'";
    } else if ($_GET['class_range'] == 2) {
        $query_class .= " and find_in_set({$cur_year},term)";
    } else if ($_GET['class_range'] == 3) {
        $query_class .= "";
    }
}
if (isset($_GET['class_sort'])) {
    if ($_GET['class_sort'] == 1) {
        $query_class .= " order by name asc";
    } else  if ($_GET['class_sort'] == 2) {
        $query_class .= " order by name desc";
    } else  if ($_GET['class_sort'] == 3) {
        $query_class .= " order by term asc";
    } else if ($_GET['class_sort'] == 4) {
        $query_class .= " order by term desc";
    }
}
$result_class = execute($con, $query_class);
$value_class = array();
$value_class_id = array();
$value_class_id_to_name = array();
while ($value = mysqli_fetch_assoc($result_class)) {
    array_push($value_class, $value);
    array_push($value_class_id, $value['id']);
    $value_class_id_to_name[$value['id']] = $value['name'];
}
$value_class_id = implode(',', $value_class_id);
if (!empty($value_class_id)) {
    $value_class_id = '(' . $value_class_id . ')';

    $query_task = "select * from task where class_id in {$value_class_id}";
    if (isset($_GET['task_range'])) {
        if ($_GET['task_range'] == 1)
            $query_task .= " and date_add(start_time,interval 7 day) >= now()";
        else if ($_GET['task_range'] == 2)
            $query_task .= " and date_add(start_time,interval 1 month) >= now()";
        else if ($_GET['task_range'] == 3)
            $query_task .= " and date_add(start_time,interval 1 year) >= now()";
        else if ($_GET['task_range'] == 4)
            $query_task .= "";
    }
    if (isset($_GET['task_sort'])) {
        if ($_GET['task_sort'] == 1) {
            $query_task .= " order by start_time asc";
        } else  if ($_GET['task_sort'] == 2) {
            $query_task .= " order by start_time desc";
        } else  if ($_GET['task_sort'] == 3) {
            $query_task .= " order by end_time asc";
        } else if ($_GET['task_sort'] == 4) {
            $query_task .= " order by end_time desc";
        }
    }
    $result_task = execute($con, $query_task);
    $value_task = array();
    while ($value = mysqli_fetch_assoc($result_task))
        array_push($value_task, $value);
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
    <title>ZWork教师首页</title>
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
    include 'include/header_teacher.inc.php';
    ?>

    <div class="container color-container">
        <div class="row">
            <div class="col">
                <p class="demo-panel-title" style="text-align:center">班级列表</p>
                <select class="form-control select select-primary" style="float:left" data-toggle="select" name='class_range' onchange="classRangeChange()">
                    <option value="0" selected>显示范围</option>
                    <option value="1">当前学期</option>
                    <option value="2">当前学年</option>
                    <option value="3">全部</option>
                </select>
                <select class="form-control select select-primary" style="float:right" data-toggle="select" name='class_sort' onchange="classSortChange()">
                    <option value="0" selected>显示顺序</option>
                    <option value="1">班级名称(升序)</option>
                    <option value="2">班级名称(降序)</option>
                    <option value="3">班级学期(升序)</option>
                    <option value="4">班级学期(降序)</option>
                </select>
                <br>
                <br>
                <div class="notice_list">
                    <?php
                    foreach ($value_class as $value) {
                        $value['term'] = explode(',', $value['term']);
                        $value['term'][1] = $value['term'][1] == 1 ? '春季' : '秋季';
                        $html = <<<A
                        <form method="post" class="login-form">
                            <div class="form-group">
                                <p class="">名称: <strong>{$value['name']}</strong> </p>
                                <p class="">描述: <strong>{$value['info']}</strong></p>
                                <p class="">学期: <strong>{$value['term'][0]}年{$value['term'][1]}学期</strong></p>
                                <p class="">班级密码: <strong>{$value['secret']}</strong></p>
                            </div>
                            <a href="teacher_show_class.php?id={$value['id']}" class="btn btn-primary btn-lg btn-block" >查看详情</a>
                        </form>
                        <br>
        A;
                        echo $html;
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <p class="demo-panel-title" style="text-align:center">作业列表</p>
                <select class="form-control select select-primary" style="float:left" data-toggle="select" name='task_range' onchange="taskRangeChange()">
                    <option value="0" selected>显示范围</option>
                    <option value="1">最近一周</option>
                    <option value="2">最近一月</option>
                    <option value="3">最近一年</option>
                    <option value="4">全部</option>
                </select>
                <select class="form-control select select-primary" style="float:right" data-toggle="select" name='task_sort' onchange="taskSortChange()">
                    <option value="0" selected>显示顺序</option>
                    <option value="1">开始时间(升序)</option>
                    <option value="2">开始时间(降序)</option>
                    <option value="3">结束时间(升序)</option>
                    <option value="4">结束时间(降序)</option>
                </select>
                <br>
                <br>
                <div class="notice_list">
                    <?php
                    foreach ($value_task as $value) {
                        $html = <<<A
                        <form method="post" class="login-form">
                            <div class="form-group">
                                <p class="">名称: <strong>{$value['name']}</strong> </p>
                                <p class="">描述: <strong>{$value['info']}</strong></p>
                                <p>来自班级: <strong>{$value_class_id_to_name[$value['class_id']]}</strong></p>
                                <p class="">开始时间: <strong>{$value['start_time']}</strong></p>
                                <p class="">结束时间: <strong>{$value['end_time']}</strong></p>
                            </div>
                            <a href="teacher_show_task.php?id={$value['id']}" class="btn btn-primary btn-lg btn-block" >查看详情</a>
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