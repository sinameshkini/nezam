<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(!isset($_GET['course'])) {
    require_once("lists.php");
    exit;
}
    $course = $_GET['course'];
    $query = "SELECT user_memnum  FROM register WHERE course_id=$course AND pay=2;";
    $result = $conn->query($query);

?>

<html>
<link rel="icon" href="Golestan.png">
<header>
<meta charset="utf-8">
<title>دریافت ژتون</title>
<link rel="stylesheet"  type="text/css" href="style.css">
</header>


<body>

<div id="zheton" >
<p><b>دریافت ژتون</b></p>
</div>

<div id="tbl-zheton">
<center>
<table>

 

    <?php
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                ?>
                <tr>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز اول</b></p>
                    </td>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز دوم</b></p>
                    </td>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز سوم</b></p>
                    </td>
                   

                </tr>
                <?php
            }
            ?>
            <tr>
                <td></td>    
                <td>پرداخت نشده ها</td>    
                <td></td>    
            </tr>
            <?php
            // echo "پرداخت نشده ها";
            $query = "SELECT user_memnum  FROM register WHERE course_id=$course AND pay!=2;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                ?>
                <tr>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز اول</b></p>
                    </td>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز دوم</b></p>
                    </td>
                    <td style="width:250px; height: 150px; direction:ltr;"><img src="Golestan.png"><br/>
                        <?php echo $row1['firstname']." ".$row1['lastname'] ?>  <br/>             
                        <?php echo $course ?><br/>
                        <p><b>روز سوم</b></p>
                    </td>
                   

                </tr>
                <?php
            }
            ?>

</table>
        </center>
</div>

</body>

</html>