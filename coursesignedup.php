<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']=='admin'){
    require_once ("index.php");
    exit;
}
// if(isset($_GET['register'])){
//     $membernum = $_GET['user'];
//     $courseid = $_GET['course'];
//     $query = "INSERT INTO register (course_id,user_memnum,pay)
//     VALUES($courseid,$membernum,0)";
//     $conn->query($query) or die($query);
// }
$membernum = $_SESSION['membernum'];
if(isset($_GET['del'])){
    $courseid = $_GET['del'];
    $query = "DELETE FROM register WHERE course_id = {$_GET['del']} AND user_memnum=$membernum AND pay!=2";
    // echo $query;
    $result = $conn->query($query);

}



$query = "SELECT course.*  FROM course,register WHERE course.code=register.course_id AND user_memnum=$membernum;";
$result = $conn->query($query);

?>
<!doctype html>


<html>
<link rel="icon" href="Golestan.png">
<head>
    <meta charset="utf-8">
    <title>ثبت نام دوره جدید</title>
    <link rel="stylesheet" href="style.css" type="text/css">
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

    <div id="Hozoorqiab">
        <p><b> دوره های ثبت نام شده</b></p>
        <br />

    </div>
    <div style="direction: rtl;">
        <table >
            <tr>
                <th>کد دوره</th>
                <th>عنوان دوره</th>
                <th>مدرس</th>
                <th>طول دوره</th>
                <th>هزینه ثبت نام</th>
                <th>وضعیت ثبت نام</th>
                <th class="photo">فیش واریزی</th>
                <th>پرداخت شهریه</th>
                <th>حذف دوره</th>
            </tr>
            <?php
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['code'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['teacher'] ?></td>
                    <td><?php echo $row['length'] ?></td>
                    <td><?php echo $row['coast'] ?></td>
                    <?php
                    $course_id = $row['code'];
                    $query2 = "SELECT * FROM register WHERE user_memnum = $membernum AND course_id=$course_id";
                    $result2 = $conn->query($query2);
                    $row2 = $result2->fetch_assoc();
                    if ($row2['pay'] == 0){
                        ?>
                        <td>شهریه پرداخت نشده</td>
                        <?php
                    }elseif($row2['pay']==1){
                        ?>
                        <td>در انتظار تایید</td>
                        <?php
                    }elseif($row2['pay']==2){
                        ?>
                        <td>تکمیل شد</td>
                        <?php
                    }elseif($row2['pay']==3){
                        ?>
                        <td>فیش نامعتبر</td>
                        <?php
                    }
                    
                    ?>   
                    <?php
          $src="license/".$membernum."-".$course_id.".jpg";
          ?>
          <td class="photo"><img src="<?php echo $src?>"></td>
                    <td><a href="license.php?course=<?php echo $course_id ?>&name=<?php echo $row['name'] ?>" class="updel" style="color: black;">آپلود فیش واریزی</a></td>
                    <td><a href="?del=<?php echo $course_id ?>" class="updeld">حذف</a></td>
                </tr>
                <?php
            }
            ?>
        </table>

    </div>

</body>
</html>


