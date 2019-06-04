<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$p_id = $_POST['p_id'];
$p_name = $_POST['p_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$o_id = $_POST['o_id'];
$s_id = $_POST['s_id'];

$ret = mysqli_query($conn, "update pet set p_name = '$p_name', age = $age, gender = '$gender', o_id = $o_id, s_id = $s_id where p_id = $p_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=pet_list.php'>";
}

?>

