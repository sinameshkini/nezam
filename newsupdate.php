<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(!isset($_GET['update'])){
    echo "هیچ خبری انتخاب نشده است!";
    exit;
}
$newsid = $_GET['update'];
// $query = "SELECT * FROM news WHERE newsid=$newsid";
// echo $query;
$result = $conn->query("SELECT * FROM news WHERE newsid=$newsid");

$row = $result->fetch_assoc();
// var_dump($row);
?>

<!doctype html>

<style>
    input[type=text]{
        width:990px;
        padding:10px 18px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid powderblue;
        box-sizing: border-box;
    }
</style>


<html>
<link rel="icon" href="Golestan.png">
<head>
    <meta charset="utf-8">
    <title>اصلاح خبر</title>
    <link rel="stylesheet" type="text/css" href="style.css ">
</head>


<body>

<?php
require_once ("header.php");
require_once ("menu.php");
?>


    <div id="Akhbar">
        <p><b>اصلاح خبر</b></p>
    </div>
    <br />

    

    <div class="news">
        <div>
            <form action="news.php?replace=<?php echo $newsid ?>" id="usrform" method="post">
                <b style="font-size: 20px; font-family:B Mitra;">عنوان خبر: </b>
                <input type="text" value=<?php echo $row['title'] ?> name="title">
        </div>
        <br>
        <textarea rows="20" cols="150" name="content" form="usrform">
            <?php echo $row['content'] ?>
        </textarea>
    </div>
    <div>
        <button id="btn" style="margin-left: 20px;" type="submit" value="ثبت خبر">ثبت خبر</button>
    </div>
    </form>
</div>
</body>
</html>


