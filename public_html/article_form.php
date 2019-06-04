<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "article_insert.php";

if (array_key_exists("a_id", $_GET)) {
    $a_id = $_GET["a_id"];
    $query =  "select * from article natural join pet where a_id = $a_id";
    $res = mysqli_query($conn, $query);
    $article = mysqli_fetch_array($res);
    if(!$article) {
        msg("글이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "article_modify.php";
}

$pet = array();

$query = "select * from pet";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $pet[$row['p_id']] = $row['p_name'];
}

?>
    <div class="container">
        <form name="article_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="a_id" value="<?=$article['a_id']?>"/>
            <h3>글 <?=$mode?></h3>
            
            <p>
            	<label for="p_id">펫 이름</label>
            	<select name="p_id" id="p_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($pet as $id => $name) {
                            if($id == $article['p_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="title">제목</label></label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$article['title']?>"/>
            </p>
            
            <p>
                <label for="content">내용</label>
                <textarea placeholder="내용 입력" id="content" name="content" rows="10"><?=$article['content']?></textarea>
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("p_id").value == "-1") {
                        alert ("펫 이름을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("글 내용을 입력해 주십시오. 최대 150자"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>