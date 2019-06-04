<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$o_name = $_POST['o_name'];
$intro = $_POST['intro'];

$ret = mysqli_query($conn, "insert into owner (o_name, intro) values('$o_name', '$intro')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=owner_list.php'>";
}

?>

