<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}



if(isset($_GET['delete'])){
    $result = $conn->query("DELETE FROM course WHERE code = {$_GET['delete']}");
    $result = $conn->query("DELETE FROM cost WHERE course_id = {$_GET['delete']}");
    $query = "SELECT * FROM course";
    $result = $conn->query($query);
}else if(isset($_GET['insert'])){
    $code = convertoeng($_POST['code']);
    $name = $_POST['name'];
    $teacher = $_POST['teacher'];
    $length = $_POST['length'];
    $coast = $_POST['coast'];
    $place = $_POST['place'];
    $query = "INSERT INTO course (`code`,`name`, `teacher`, `length`, `coast`,`place`)
                                    VALUES ('$code','$name','$teacher','$length','$coast','$place');";
    $conn->query($query) or die("error course insert");
    $query = "INSERT INTO cost (course_id,greetings,lunch,personnel,other)
                                    VALUES ('$code',0,0,0,0);";
    $conn->query($query) or die("error course insert");
    $query = "SELECT * FROM course";
    $result = $conn->query($query);
}else if(isset($_GET['update'])){
    $name = $_POST['name'];
    $teacher = $_POST['teacher'];
    $length = $_POST['length'];
    $coast = $_POST['coast'];
    $place = $_POST['place'];
    $query = "UPDATE course SET `name` = '$name' , teacher = '$teacher' ,
     `length` = '$length' , coast = '$coast' , place = '$place' WHERE code = {$_GET['update']}";
    $conn->query($query);
    $query = "SELECT * FROM course";
    $result = $conn->query($query);
}else if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM course WHERE name LIKE '%$search%' OR teacher LIKE '%$search%'";
    $result = $conn->query($query);
}else if(isset($_GET['active'])){
    $query = "UPDATE course SET `activate` = 1 WHERE code = {$_GET['active']}";
    $conn->query($query);
    $query = "SELECT * FROM course";
    $result = $conn->query($query);
}else if(isset($_GET['deactive'])){
    echo $_GET['deactive'];
    $query = "UPDATE course SET `activate` = 0 WHERE code = {$_GET['deactive']}";
    $conn->query($query);
    $query = "SELECT * FROM course";
    $result = $conn->query($query);

}else{
    $query = "SELECT * FROM course";
    $result = $conn->query($query);
}
?>
<!doctype html>

<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>تعریف دوره ها</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	
<?php
require_once ("header.php");
require_once ("menu.php");
?>

		<br />
		<br />
		
		<div id="dore">
			<p><b>تعریف دوره ها</b></p>
          
          <div>  
            <form action="courses.php" method="get">
            <input type="text" name="search" class="search" placeholder="نام دوره"/>
            <input style="margin-top:15px;" type="submit" class="button" value="جستجو" />
             <a style="color: black; margin-left:170px; " href="insert.php" class="insert">
    ثبت دوره جدید</a>
</form>
</div>
<br>
	
	</div>
		<div align="right">
		
		<table style="direction: rtl;">
    <tr>
        <th>کد دوره</th>
        <th>عنوان دوره</th>
        <th>مدرس</th>
        <th>تاریخ برگزاری</th>
        <th>هزینه ثبت نام (ریال)</th>
        <th>محل برگزاری</th>
        <th>وضعیت</th>
        <th>ویرایش</th>
    </tr>
    <?php
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $row['code'] ?></td>
            <td style="text-align:center;"><?php echo $row['name'] ?></td>
            <td style="text-align:center;"><?php echo $row['teacher'] ?></td>
            <td style="text-align:center;"><?php echo $row['length'] ?></td>
            <td style="text-align:center;"><?php echo $row['coast'] ?></td>
            <td style="text-align:center;"><?php echo $row['place'] ?></td>
            <td>
                <?php
                if($row['activate'] == 1){
                ?>
                    <a href="courses.php?deactive=<?php echo $row['code']; ?>" class="updeld" >غیرفعال کردن</a>
                <?php              
                }else{
                ?>
                    <a href="courses.php?active=<?php echo $row['code']; ?>" class="updel" >فعال کردن</a>
                <?php
                }
                ?>
            </td>
            <td>
                <a href="courseupdate.php?update=<?php echo $row['code']; ?>"class="updel">اصلاح</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

		
		</div>
	
</body>
</html>


