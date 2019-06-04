<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$action = "comment_insert.php";

if (array_key_exists("a_id", $_GET)) {
    $a_id = $_GET["a_id"];
    $query = "select * from article natural join pet where a_id = $a_id";
    $res = mysqli_query($conn, $query);
    $article = mysqli_fetch_assoc($res);
    if (!$article) {
        msg("게시물이 존재하지 않습니다.");
    }
    
    $query2 = "select * from article natural join comment where c_id = $c_id";
    $res2 = mysqli_query($conn, $query2);
    $comments = mysqli_fetch_array($res2);
}



?>
    <div class="container fullwidth">

        <p>
            <label for="o_name">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $article['title'] ?>"/>
        </p>

        <p>
            <label for="content">내용</label>
            <textarea readonly id="content" name="content" rows="10"><?= $article['content'] ?></textarea>
        </p>

    </div>
    
    <br>
    <div class="container">
    	<p>
            <label for="c_id">댓글 작성</label>
        </p>
        <form name="comment_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="c_id" value="<?=$comments['c_id']?>"/>
            <input type="hidden" name="a_id" value="<?=$a_id?>"/>
            <p>
                <input type="text" placeholder="닉네임 입력" id="writer" name="writer" value="<?=$comments['writer']?>"/>
            </p>
            
            <p>
                <textarea placeholder="댓글 입력" id="words" name="words" rows="2"><?=$comments['words']?></textarea>
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();">쓰기</button></p>

            <script>
                function validate() {
                    if(document.getElementById("writer").value == "") {
                        alert ("닉네임을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("words").value == "") {
                        alert ("댓글을 입력해 주십시오. 최대 150자"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
    
    <br>
  
    
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from comment where a_id = $a_id";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>닉네임</th>
            <th>내용</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['writer']}</td>";
            echo "<td>{$row['words']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>



<? include("footer.php") ?>