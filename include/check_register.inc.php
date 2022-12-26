<?php
include_once 'include/config.inc.php';
include_once 'include/mysql.inc.php';
include_once 'include/tool.inc.php';
$con = connect();

if ($_POST['user_password'] != $_POST['user_password_repeat'])
    skip("register.php", 'error', '请确保两次输入的密码一致');

$query = "select * from user where user_account={$_POST['user_account']}";
$result = execute($con, $query);
if (mysqli_num_rows($result))
    skip("register.php", 'error', "该账户已存在");
