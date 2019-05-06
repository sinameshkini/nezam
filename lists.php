<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

$query = "SELECT * FROM course";
$result = $conn->query($query);
?>
<!doctype html>


<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>لیست حضور غیاب</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
	

<body>
	
<?php
require_once ("header.php");
require_once ("menu.php");
?>
	
		<br />
		<br />
		
		<div id="Hozoorqiab">
			<p><b> لیست حضور غیاب دوره ها</b></p>
			<br />
	
	</div>
		<div style="direction: rtl;">
		<table >
    <tr>
        <th>کد دوره</th>
        <th>عنوان دوره</th>
        <th>مدرس</th>
        <th>لیست ها</th>
        
    </tr>
    <?php
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['code'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['teacher'] ?></td>
            <td>
            <a href="zheton.php?&course=<?php echo $row['code']?>" target="_blank"  class="updel">دریافت ژتون</a>
            <a href="presentation.php?present=1&course=<?php echo $row['code']?>" target="_blank" class="updel" >لیست حضور غیاب</a>
            <a href="exam.php?exam=1&course=<?php echo $row['code']?>" target="_blank" class="updel">لیست صورت جلسه امتحان</a>
			<a href="phone.php?mobile=1&course=<?php echo $row['code']?>" target="_blank" class="updel">لیست شماره تلفن همراه</a>
            <a href="mail.php?email=1&course=<?php echo $row['code']?>" target="_blank" class="updel">لیست ایمیل ها</a>
            <a href="notconfirm.php?&course=<?php echo $row['code']?>" target="_blank" class="updel">لیست ثبت نامهای تایید نشده</a>
			
        </td>
        </tr>
        <?php
    }
    ?>
</table>
		
		</div>
	
</body>
</html>


