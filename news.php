<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['insert'])){
    $time = time();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $query = "INSERT INTO news (`date`,title,content)
              VALUES ('$time','$title','$content');";
    $conn->query($query) or die($time);
}
if(isset($_GET['replace'])){
    $id = $_GET['replace'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $query = "UPDATE news SET title='$title' ,content='$content' WHERE newsid=$id ;";
    if($conn->query($query)){
        echo "updated";
    }else{
        echo "error";
    }
    require_once("news.php");
    exit;
}

$query = "SELECT * FROM news ORDER BY newsid ";
$result = $conn->query($query);
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
    <title>اخبار و اطلاعیه ها</title>
    <link rel="stylesheet" type="text/css" href="style.css ">
</head>


<body>

<?php
require_once ("header.php");
require_once ("menu.php");
?>


    <div id="Akhbar">
        <p><b>اطلاعیه ها و اخبار</b></p>
    </div>
    <br />

    

    <div class="news">
        <div>
            

            <?php
            if(isset($_GET['update'])){
                $id = $_GET['update'];
                $query = "SELECT * FROM news WHERE newsid=$id";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                ?>
                <form action="news.php?replace=<?php echo $id?>" id="usrform" method="post">
                <b style="font-size: 20px; font-family:B Mitra;"><?php echo $row['title']?></b><input type="text" name="title">
                </div>
                <br>
                <textarea rows="20" cols="150" name="content" form="usrform">
                <?php echo $row['content']?>
                </textarea>
            </div>
        <?php
            }else{
            ?>
            <form action="news.php?insert=1" id="usrform" method="post">
                <b style="font-size: 20px; font-family:B Mitra;">عنوان خبر: </b><input type="text" name="title">
        </div>
        <br>
        <textarea rows="20" cols="150" name="content" form="usrform">
متن خبر در این قسمت نوشته می شود...
        </textarea>
    </div>
    <?php
    }
    ?>
    <div>
        <button id="btn" style="margin-left: 20px;" type="submit" value="ثبت خبر">ثبت خبر</button>
    </div>
    </form>
</div>

<div align="right" style="margin:20px;">
		
		<table style="direction: rtl; white-space:normal;">
        <tr>
            <th></th>
            <th> آخرین اخبار</th>
            <th></th>
            <th></th>
        </tr>
 
        
        <tr style="background-color:#ddeef0;">
        <td style="width:20%; font-size:17px;"><b>عنوان</b></td>
            <td style="width:70%; font-size:17px;"><b>متن</b></td>
            <td style="width:10%; font-size:17px;"><b>تاریخ</b></td>
            <td></td>
        </tr>
        
       
        <?php 
        $query = "SELECT * FROM news ORDER BY newsid ";
        $result = $conn->query($query);
         while($row = $result->fetch_assoc()){
        ?>
       
        <tr>
            <td><?php echo $row["title"] ?></td>
            <td><?php echo $row["content"] ?></td>
            <td><?php echo date('m/d/Y',$row["date"])?></td>
            <td>
                <!-- <a href="courses.php?delete=<?php echo $row['code']; ?>" class="updeld" >حذف</a> -->

                <a href="newsupdate.php?update=<?php echo $row["newsid"] ?>"class="updel">اصلاح</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

		
		</div>
</body>
</html>


