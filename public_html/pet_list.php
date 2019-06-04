<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from pet natural join owner natural join species";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where p_name like '%$search_keyword%' or o_name like '%$search_keyword%' or s_name like '%$search_keyword%'";
    
    }
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
            <th>나이</th>
            <th>성별</th>
            <th>주인</th>
            <th>품종</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='pet_view.php?p_id={$row['p_id']}'>{$row['p_name']}</a></td>";
            echo "<td>{$row['age']}</td>";
            echo "<td>{$row['gender']}</td>";
            echo "<td>{$row['o_name']}</td>";
            echo "<td>{$row['s_name']}</td>";
            echo "<td width='17%'>
                <a href='pet_form.php?p_id={$row['p_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['p_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(p_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "pet_delete.php?p_id=" + p_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
