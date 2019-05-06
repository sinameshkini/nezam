<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']=='admin') {
    require_once ("index.php");
    exit;
}

$user_memnum = $_SESSION['membernum'];
$query = "SELECT course_id FROM register WHERE user_memnum=$user_memnum AND pay=2;";
$result = $conn->query($query);
// var_dump($result);
// echo "ok";
// exit;
if(!$result){
    echo "هیچ فایل درسی برای شما وجود تدارد!";
    require_once("register.php");
    exit;
}
$row = $result->fetch_assoc();

$course_id = $row['course_id'];
$query = "SELECT * FROM files WHERE course_id=$course_id;";
$result = $conn->query($query);

?>
<!doctype html>

<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>آپلود فایل درسی</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
<?php
    require_once ("header.php");
?>

<div class="card" >
		<div class="topnav">
		<a href="coursesignedup.php"><b>دوره های ثبت نام شده</b></a>
  		<a href="register.php"><b>ثبت نام دوره جدید</b></a>
		<a href="userfile.php"><b>فایلهای درسی</b></a>
		</div>
		<br />
		<br />
	</div>


<div align="right">

<table style="direction: rtl;">
    <tr>
        <th>نام</th>
        <th>KB حجم</th>
        <th></th>
    </tr>


    <?php
    while($row = $result->fetch_assoc()){
        
    ?>
    <tr>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['size']/1000 ?></td>
        <td>
            <a href="file/<?php echo $row['name']?>"class="download" >دانلود</a>
        </td>
    </tr>
        <?php
    }
    ?>
</table>