﻿<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$p_id = $_POST['p_id'];
$title = $_POST['title'];
$content = $_POST['content'];

$ret = mysqli_query($conn, "insert into article (p_id, title, content, date) values($p_id, '$title', '$content', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=article_list.php'>";
}

?>
