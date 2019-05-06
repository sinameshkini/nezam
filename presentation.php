<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['present'])) {
    $course = $_GET['course'];
    $query = "SELECT *  FROM course WHERE code='$course';";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $teacher = $row['teacher'];
    $title = "نام دوره: ".$name." --    مدرس: ".$teacher;
    $query = "SELECT *  FROM register WHERE course_id=$course AND pay=2;";
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


    <div id="Hozoorqiab">
        <p><b> لیست حضور غیاب دوره ها</b></p>
        <br/>

    </div>
    <div style="direction: rtl;">
        <b><?php echo $title ?></b>
        <br><br>
        <table>
            <tr>
                <th>شماره نظام مهندسی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ایمیل</th>
                <th>شماره تماس</th>
                <th>وضعیت ثبت نام</th>

            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $pay = $row['pay'];
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                
                ?>
                <tr>
                    <td><?php echo $row1['membernum'] ?></td>
                    <td><?php echo $row1['firstname'] ?></td>
                    <td><?php echo $row1['lastname'] ?></td>
                    <td><?php echo $row1['email'] ?></td>
                    <td><?php echo $row1['mobile'] ?></td>
                    <td>
                        <?php
                        if($pay == 2){
                            echo "تکمیل";
                        }else{
                            echo "پرداخت نشده";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
                $query = "SELECT *  FROM register WHERE course_id=$course AND pay!=2;";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $pay = $row['pay'];
                    $user_memnum = $row['user_memnum'];
                    $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                    $result1 = $conn->query($query1);
                    $row1 = $result1->fetch_assoc();
                
                ?>
                <tr>
                    <td><?php echo $row1['membernum'] ?></td>
                    <td><?php echo $row1['firstname'] ?></td>
                    <td><?php echo $row1['lastname'] ?></td>
                    <td><?php echo $row1['email'] ?></td>
                    <td><?php echo $row1['mobile'] ?></td>
                    <td>
                        <?php
                        if($pay == 2){
                            echo "تکمیل";
                        }else{
                            echo "پرداخت نشده";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

    </div>

    </body>
    </html>

    <?php
}
