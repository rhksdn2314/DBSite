<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("p_id", $_GET)) {
    $p_id = $_GET["p_id"];
    $query = "select * from pet natural join owner natural join species where p_id = $p_id";
    $res = mysqli_query($conn, $query);
    $pet = mysqli_fetch_assoc($res);
    if (!$pet) {
        msg("물품이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>펫 정보 상세 보기</h3>

        <p>
            <label for="p_id">펫 ID</label>
            <input readonly type="text" id="p_id" name="p_id" value="<?= $pet['p_id'] ?>"/>
        </p>

        <p>
            <label for="o_id">주인 ID</label>
            <input readonly type="text" id="o_id" name="o_id" value="<?= $pet['o_id'] ?>"/>
        </p>

        <p>
            <label for="o_name">주인명</label>
            <input readonly type="text" id="o_name" name="o_name" value="<?= $pet['o_name'] ?>"/>
        </p>

        <p>
            <label for="p_name">이름</label>
            <input readonly type="text" id="p_name" name="p_name" value="<?= $pet['p_name'] ?>"/>
        </p>

        <p>
            <label for="age">나이</label>
            <input readonly type="number" id="age" name="age" value="<?= $pet['age'] ?>"/>
        </p>

        <p>
            <label for="gender">성별</label>
            <input readonly type="text" id="gender" name="gender" value="<?= $pet['gender'] ?>"/>
        </p>
        
        <p>
            <label for="gender">품종</label>
            <input readonly type="text" id="s_name" name="s_name" value="<?= $pet['s_name'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>