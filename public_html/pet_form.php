<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "pet_insert.php";

if (array_key_exists("p_id", $_GET)) {
    $p_id = $_GET["p_id"];
    $query =  "select * from pet where p_id = $p_id";
    $res = mysqli_query($conn, $query);
    $pet = mysqli_fetch_array($res);
    if(!$pet) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "pet_modify.php";
}

$owner = array();
$species = array();

$query = "select * from owner";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $owner[$row['o_id']] = $row['o_name'];
}

$query = "select * from species";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $species[$row['s_id']] = $row['s_name'];
}
?>
    <div class="container">
        <form name="pet_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="p_id" value="<?=$pet['p_id']?>"/>
            <h3>펫 정보 <?=$mode?></h3>
            
            <p>
                <label for="p_name">이름</label>
                <input type="text" placeholder="펫이름 입력" id="p_name" name="p_name" value="<?=$pet['p_name']?>"/>
            </p>
            
            <p>
                <label for="age">나이</label>
                <input type="number" placeholder="나이는?" id="age" name="age" value="<?=$pet['age']?>" />
            </p>
            
            <p>
                <label for="gender">성별</label><br>
                <input type="radio" id="gender" name="gender" value="Female" checked/>Female<br>
                <input type="radio" id="gender" name="gender" value="Male"/>Male
            </p>
            
            <p>
            	<label for="o_id">주인</label>
            	<select name="o_id" id="o_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($owner as $id => $name) {
                            if($id == $pet['o_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
            	<label for="s_id">품종</label>
            	<select name="s_id" id="s_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($species as $id => $name) {
                            if($id == $pet['s_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("p_name").value == "") {
                        alert ("펫이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("age").value == "") {
                        alert ("나이를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("age").value == "") {
                        alert ("성별을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("o_id").value == "-1") {
                        alert ("주인을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("s_id").value == "-1") {
                        alert ("품종을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>