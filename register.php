<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']=='admin') {
    require_once ("index.php");
    exit;
}
$msg = "";
if(isset($_GET['register'])){
    $membernum = $_GET['user'];
    $courseid = $_GET['course'];
    // $query = "select * from register where course_id=$courseid and user_memnum=$membernum;";
    // $result = $conn->query($query);
    // $row = $result->fetch_assoc();
    // echo "ok";
    // exit;
    // if($row){
    //     $msg = "کاربر گرامی شما این دوره را قبلا ثبت نام کرده اید";
    // }else{
        $query = "INSERT INTO register (course_id,user_memnum,pay)
        VALUES($courseid,$membernum,0)";
        $conn->query($query);
        // echo $query;
    //     if(){
    //         $msg = "ثبت نام شما با موفقیت انجام شد. لطفا مراحل ثبت نام را در بخش دوره های ثبت نام شده تکمیل کنید";
    //     }else{
    //         $msg = "خطا در سیستم. لطفا با پشتیبانی تماس بگیرید";
    //     } 
    // }
    require_once("coursesignedup.php");
    exit;
}
$membernum = $_SESSION['membernum'];
// echo "ok";
// echo $membernum;
// var_dump($_SESSION);
$query = "SELECT *  FROM course where activate=1";
$result = $conn->query($query);
?>
<!doctype html>




<html>
<head>
<link rel="icon" href="Golestan.png">
    <meta charset="utf-8">
    <title>ثبت نام دوره جدید</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<?php
require_once ("header.php");
echo $msg;
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
        <p><b> ثبت دوره جدید</b></p>
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
                <th></th>
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
                    <td><a href="register.php?register=1&course=<?php echo $row['code']?>&user=<?php echo $membernum; ?>" class="updel" style="color: black;">ثبت نام</td>

                </tr>
                <?php
            }
            ?>
        </table>

    </div>

</body>
</html>


