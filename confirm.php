<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(isset($_GET['accept'])){
    $course = $_GET['course_id'];
    $mem = $_GET['user'];
    $query = "UPDATE register SET pay = 2  WHERE course_id = '$course' AND user_memnum='$mem'";
    $conn->query($query) or die("Ridi!");

}

if(isset($_GET['reject'])){
    $course = $_GET['course_id'];
    $mem = $_GET['user'];
    $query = "UPDATE register SET pay = 3  WHERE course_id = '$course' AND user_memnum='$mem'";
    $conn->query($query) or die("Ridi!");

}

$query = "SELECT * FROM register WHERE pay=1;";
$result=$conn->query($query) or die("error");



?>



<html>
<link rel="icon" href="Golestan.png">
<header>
    <title>تایید پرداخت</title>
<?php
require_once("header.php");
require_once("menu.php");
?>
<link rel="stylesheet" href="style.css" type="text/css">
</header>

<body>
<div id="karbaran">
<p><b>تایید پرداخت</b></p>
</div> 

<div style="direction:rtl;">
<table style="direction:rtl;">

    <tr>
        <th>شماره نظام مهندسی</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>کد دوره</th>
        <th>فیش</th>
        <th></th>
    </tr>
    <?php
            while($row = $result->fetch_assoc()){
                $user = $row['user_memnum'];
                $query1 = "SELECT * FROM user WHERE membernum = $user;";
                $result1=$conn->query($query1) or die("error");
                $row1 = $result1->fetch_assoc();
                ?>

      <tr>
          <td><?php echo $row['user_memnum']?></td>
          <td><?php echo $row1['firstname']?></td>
          <td><?php echo $row1['lastname']?></td>
          <td><?php echo $row['course_id']?></td>
          <?php
          $src="license/".$row['user_memnum']."-".$row['course_id'].".jpg";
          ?>
          <td class="photo"><img src="<?php echo $src?>"></td>
          <td>
                <a href="confirm.php?accept=1&user=<?php echo $row['user_memnum']?>&course_id=<?php echo $row['course_id']?>"class="download" >تایید</a>
                <a href="confirm.php?reject=1&user=<?php echo $row['user_memnum']?>&course_id=<?php echo $row['course_id']?>"class="updeld" >رد</a>
            </td>

            </tr>    
    <?php
            }
            ?>

</table>
</div>


</body>

</html>