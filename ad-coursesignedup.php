<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(!isset($_SESSION['membernum'])){
    if(isset($_GET["memnum"])){
        $_SESSION['membernum'] = $_GET['memnum'];
    }else{
        echo "Access denied!";
        exit;
    }
}

if(isset($_GET['pay'])){
    $membernum = $_SESSION['membernum'];
    $courseid = $_GET['course'];
    
    $query = "UPDATE register SET pay = 2  WHERE course_id = '$courseid' AND user_memnum='$membernum'";
    $conn->query($query);   
    // require_once("ad-coursesignedup.php");
    // exit;
}
if(isset($_GET['unpay'])){
    $membernum = $_SESSION['membernum'];
    $courseid = $_GET['course'];
    
    $query = "UPDATE register SET pay = 0  WHERE course_id = '$courseid' AND user_memnum='$membernum'";
    $conn->query($query);   
    // require_once("ad-coursesignedup.php");
    // exit;
}
// if(isset($_GET['register'])){
//     $membernum = $_GET['user'];
//     $courseid = $_GET['course'];
//     $query = "INSERT INTO register (course_id,user_memnum,pay)
//     VALUES($courseid,$membernum,0)";
//     $conn->query($query) or die($query);
// }
$membernum = $_SESSION['membernum'];
//echo $membernum;
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
require_once ("menu.php");
?>



<div class="card" >
    <div class="topnav">

        <a href="ad-coursesignedup.php"><b>دوره های ثبت نام شده</b></a>
  		<a href="ad-register.php"><b>ثبت نام دوره جدید</b></a>
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
                <!-- <th>طول دوره</th> -->
                <th>هزینه ثبت نام</th>
                <!-- <th>محل برگزاری</th> -->
                <th>وضعیت ثبت نام</th>
                <th class="photo">فیش واریزی</th>
                <th></th>
            </tr>
            <?php
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['code'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['teacher'] ?></td>
                    <!-- <td><?php echo $row['length'] ?></td> -->
                    <td><?php echo $row['coast'] ?></td>
                    <!-- <td><?php echo $row['place'] ?></td>  -->
                   

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
                    <td><a href="?pay=1&course=<?php echo $course_id ?>&name=<?php echo $row['name'] ?>" class="updel" style="color: black;">پرداخت شد</a></td>
                    <td><a href="?unpay=1&course=<?php echo $course_id ?>&name=<?php echo $row['name'] ?>" class="updel" style="color: black;">عدم پرداخت </a></td>
                </tr>
                <?php
            }
            ?>
        </table>

    </div>

</body>
</html>


