<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from owner";
    
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>이름</th>
            <th>소개</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='owner_view.php?o_id={$row['o_id']}'>{$row['o_name']}</a></td>";
            echo "<td>{$row['intro']}</td>";
            echo "<td width='17%'>
                <a href='owner_form.php?o_id={$row['o_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['o_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(o_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "owner_delete.php?o_id=" + o_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>