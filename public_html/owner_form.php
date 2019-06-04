<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "owner_insert.php";

if (array_key_exists("o_id", $_GET)) {
    $o_id = $_GET["o_id"];
    $query =  "select * from owner where o_id = $o_id";
    $res = mysqli_query($conn, $query);
    $owner = mysqli_fetch_array($res);
    if(!$owner) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "owner_modify.php";
}

?>
    <div class="container">
        <form name="owner_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="o_id" value="<?=$owner['o_id']?>"/>
            <h3>펫주 정보 <?=$mode?></h3>
            
            <p>
                <label for="p_name">이름</label>
                <input type="text" placeholder="펫주명 입력" id="o_name" name="o_name" value="<?=$owner['o_name']?>"/>
            </p>
            
            <p>
                <label for="intro">소개글</label>
                <textarea placeholder="소개글 입력" id="intro" name="intro" rows="10"><?=$owner['intro']?></textarea>
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("o_name").value == "") {
                        alert ("펫주명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("intro").value == "") {
                        alert ("소개글을 입력해 주십시오. 최대 150자"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>