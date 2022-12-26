<?php

//连接数据库
function connect()
{
    $con = @mysqli_connect($host = DB_HOSTNAME, $user = DB_USERNAME, $password = DB_PASSWORD, $database = DB_DATABASE, $port = DB_PORT);
    if (mysqli_connect_errno()) {
        exit('Could not connect .' . mysqli_connect_error());
    }
    mysqli_set_charset($con, 'utf8');
    return $con;
}

//执行sql语句
//@return 结果集或布尔值
function execute($con, $query)
{
    $result = mysqli_query($con, $query);
    if (mysqli_errno($con)) {
        exit('Query failed. ' . mysqli_error($con));
    }
    return $result;
}

//执行sql语句
//@return 布尔值
function execute_bool($con, $query)
{
    $result = mysqli_real_query($con, $query);
    if (mysqli_errno($con)) {
        exit('Query failed. ' . mysqli_error($con));
    }
    return $result;
}

//一次性执行多条sql语句
//@return 结果集的集合
function execute_mul($con, $query_arr)
{
    $result_arr = array();
    $cnt = count($query_arr);
    for ($i = 0; $i < $cnt; $i++) {
        $result_arr[$i] = mysqli_query($con, $query_arr[$i]);
        if (!$result_arr[$i]) {
            $error = "Query failed in case $i(begin from case 0) ." . mysqli_error($con);
            exit($error);
        }
    }
    return $result_arr;
}

//获取记录数
//@return 记录数
function mysql_num($con, $sql_count)
{
    $result = execute($con, $sql_count);
    $count = mysqli_fetch_row($result);
    return $count[0];
}

//对语句进行转译
//@return 转译后的语句
function escape($con, $data)
{
    if (is_string($data)) {
        return mysqli_real_escape_string($con, $data);
    }
    if (is_array($data)) {
        foreach ($data as $key => $val) {
            $data[$key] = escape($con, $val);
        }
    }
    return $data;
}

function close($con)
{
    mysqli_close($con);
}
