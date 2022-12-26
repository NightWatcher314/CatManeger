<?php

function skip($url, $pic, $message)
{
    echo "<script language=\"JavaScript\">\r\n";
    echo " window.location.href='{$url}';\r\n";
    // 历史返回；
    echo " alert('{$message}');\r\n";
    // 历史返回；
    echo "</script>";
    exit();
}

function is_login($con)
{
    session_start();
    if (isset($_SESSION['user_account']) && isset($_SESSION['user_password'])) {
        $query = "select * from {$_SESSION['user_type']} where user_account={$_SESSION['user_account']} and user_password ='{$_SESSION['user_password']}'";
        $result = execute($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $value = mysqli_fetch_assoc($result);
            return $value['user_id'];
        }
    } else
        return false;
}
