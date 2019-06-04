<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>펫팸하우스</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="pet_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">펫팸하우스</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="펫 통합검색">
                </li>
                <li><a href='article_list.php'>펫게시판</a></li>
                <li><a href='owner_list.php'>펫주 목록</a></li>
                <li><a href='owner_form.php'>펫주 등록</a></li>
                <li><a href='pet_list.php'>펫 목록</a></li>
                <li><a href='pet_form.php'>펫 등록</a></li>
            </ul>
        </div>
    </div>
</form>