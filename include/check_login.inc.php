<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();

$query = "select * from user where user_account={$_POST['user_account']}";
$result = execute($con, $query);
if (mysqli_num_rows($result) == 0)
    skip("login.php", 'error', "账号不存在");
$value = mysqli_fetch_assoc($result);

if ($_POST['user_password'] != $value['user_password'])
    skip("login.php", 'error', "密码错误");
