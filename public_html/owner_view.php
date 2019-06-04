<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("o_id", $_GET)) {
    $o_id = $_GET["o_id"];
    $query = "select * from owner where o_id = $o_id";
    $res = mysqli_query($conn, $query);
    $owner = mysqli_fetch_assoc($res);
    if (!$owner) {
        msg("물품이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>펫주 정보 상세 보기</h3>

        <p>
            <label for="o_id">펫주 ID</label>
            <input readonly type="text" id="o_id" name="o_id" value="<?= $owner['o_id'] ?>"/>
        </p>

        <p>
            <label for="o_name">펫주명</label>
            <input readonly type="text" id="o_name" name="o_name" value="<?= $owner['o_name'] ?>"/>
        </p>

        <p>
            <label for="intro">소개글</label>
            <textarea readonly id="intro" name="intro" rows="10"><?= $owner['intro'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>