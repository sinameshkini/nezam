<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['course'])) {
    $course = $_GET['course'];
    $query = "SELECT user_memnum  FROM register WHERE course_id=$course AND pay!=2;";
    $result = $conn->query($query);
    ?>
    <!doctype html>

    <html>
    <head>
        <meta charset="utf-8">
        <title>لیست ثبت نامهای تایید نشده</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>

    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>


    <div id="Hozoorqiab">
        <p><b>لیست ثبت نامهای تایید نشده</b></p>
        <br/>

    </div>
    <div style="direction: rtl;">
        <table>
            <tr>
                <th>شماره نظام مهندسی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>موبایل</th>
                <th>ایمیل</th>
                

            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo $row1['membernum'] ?></td>
                    <td><?php echo $row1['firstname'] ?></td>
                    <td><?php echo $row1['lastname'] ?></td>
                    <td><?php echo $row1['mobile'] ?></td>
                    <td><?php echo $row1['email'] ?></td>


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
