<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
$user_id = is_login($con);
?>

<nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg" role="navigation">
    <a class="navbar-brand" href="#">ZCat</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav mr-auto">
            <li><a href="index.php">首页</span></a></li>
            <li><a href="website_info.php">网站信息</a></li>
        </ul>
        <div class="navbar-form form-inline my-2 my-lg-0">
            <div class="form-group">
                <?php
                if ($user_id) {
                    $query_user_head = "select * from user where id={$user_id}";
                    $result_user_head = execute($con, $query_user_head);
                    $value_user_head = mysqli_fetch_assoc($result_user_head);
                    $str = "<a href='account_info.php'>欢迎用户 {$value_user_head['user_name']} |</a>";
                    $str .= "<a href='logout.php'> 退出登录</a>";
                    echo $str;
                } else {
                    $str = "<a href='login.php'>登录</a> | <a href='register.php'>注册</a>";
                    echo $str;
                }
                ?>
            </div>
        </div>
    </div>
</nav>