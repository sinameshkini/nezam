<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin') {
    require_once ("index.php");
    exit;
}
if(isset($_GET['register'])){
    $membernum = $_GET['user'];
    $courseid = $_GET['course'];
    $query = "INSERT INTO register (course_id,user_memnum,pay)
    VALUES($courseid,$membernum,0)";
    // echo $query;
    if(!$conn->query($query)){ ?>
    <script>
   javascript:confirm('شما این دوره را قبلا ثبت نام کرده اید.');
   </script>
<?php
    }   
    require_once("ad-coursesignedup.php");
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

if(isset($_GET['memnum']) && $_SESSION['membernum'] != $_GET['memnum']){
    $_SESSION['membernum'] = $_GET['memnum'];
}

$query = "SELECT *  FROM course;";
$result = $conn->query($query);
$membernum = $_SESSION['membernum'];
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
require_once("menu.php");
?>


<div class="card" >
    <div class="topnav">

        <a href="ad-coursesignedup.php"><b>دوره های ثبت نام شده</b></a>
  		<a href="ad-register.php"><b>ثبت نام دوره جدید</b></a>
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
                    <td><a href="ad-register.php?register=1&course=<?php echo $row['code']?>&user=<?php echo $membernum; ?>" class="updel" style="color: black;">ثبت نام</td>

                </tr>
                <?php
            }
            ?>
        </table>

    </div>

</body>
</html>


