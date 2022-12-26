<?php
if ($_FILES["file"]["size"] > 20971520) {
    skip($_SERVER['HTTP_REFERER'], 'error', '文件不得大于20MB');
}
if ($_FILES["file"]["error"] > 0) {
    skip($_SERVER['HTTP_REFERER'], 'error', '请重试');
}
$query_task_upload = "select * from task where id={$_GET['task_id']}";
$result_task_upload = execute($con, $query_task_upload);
$value_task_upload = mysqli_fetch_assoc($result_task_upload);
$file_rename = "upload/" . "{$value_task_upload['class_id']}/" . "{$value_task_upload['name']}/" . "{$_SESSION['account']}_{$value_student['name']}.pdf";

$query_change_time = "set time_zone='+8:00'";
execute($con, $query_change_time);
$query_upload = "insert into upload(student_id,task_id,time) values({$student_id},{$_GET['task_id']},now())";
execute($con, $query_upload);
if (mysqli_affected_rows($con) == 0)
    skip($_SERVER['HTTP_REFERER'], 'error', '记录更新失败,请重新提交');
if (!file_exists('upload/' . $value_task_upload['class_id'])) {
    mkdir('upload/' . $value_task_upload['class_id'], 0777, true);
}
if (!file_exists('upload/' . $value_task_upload['class_id'] . "/" . $value_task_upload['name'])) {
    mkdir('upload/' . $value_task_upload['class_id'] . "/" . $value_task_upload['name'], 0777, true);
}
if (file_exists($file_rename)) {
    unlink($file_rename);
    move_uploaded_file($_FILES["file"]["tmp_name"], $file_rename);
    skip($_SERVER['HTTP_REFERER'], 'ok', '文件重新提交成功,已重命名');
} else {
    move_uploaded_file($_FILES["file"]["tmp_name"], $file_rename);
    skip($_SERVER['HTTP_REFERER'], 'ok', '文件提交成功,已重命名');
}
