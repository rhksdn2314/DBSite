<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from article natural join pet";
    
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>펫 이름</th>
            <th>제목</th>
            <th>등록일</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='pet_view.php?p_id={$row['p_id']}'>{$row['p_name']}</td>";
            echo "<td><a href='article_view.php?a_id={$row['a_id']}'>{$row['title']}</a></td>";
            echo "<td>{$row['date']}</td>";
            echo "<td width='17%'>
                <a href='article_form.php?a_id={$row['a_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['a_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
        
    </table>
    
    <div class='container'>
            <ul class='pull-right'>
                <button><a href='article_form.php'>글쓰기</button></li>
    		</ul>
    </div>
    <br>
    
    
    <script>
        function deleteConfirm(a_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "article_delete.php?a_id=" + a_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>