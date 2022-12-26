<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();
session_start();
$student_id = is_login($con);
if (!$student_id) {
    skip('index.php', 'error', '你没有登录,不需要退出!');
}
setcookie(session_name(), session_id(), time() - 3600, '/');
skip('login.php', 'ok', '退出成功!');
