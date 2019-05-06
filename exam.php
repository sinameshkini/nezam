<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['exam'])) {
    $course = $_GET['course'];
    $query = "SELECT user_memnum  FROM register WHERE course_id=$course AND pay=2;";
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
        <p><b> لیست صورت جلسه امتحان</b></p>
        <br/>

    </div>
    <div style="direction: rtl;">
        <table>
            <tr>
                <th>ردیف</th>
                <th>عکس</th>
                <th>شماره نظام مهندسی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>وضعیت ثبت نام</th>
                <th>امضاء</th>     

            </tr>
            <?php
            $counter = 1;
            $pay = $row['pay'];
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                
                ?>
                <tr>
                    <td><?php echo $counter++ ?></td>
                    <td  class="photo"><img src="<?php echo $row1['image']?>"></td>
                    <td><?php echo $row1['membernum'] ?></td>
                    <td><?php echo $row1['firstname'] ?></td>
                    <td><?php echo $row1['lastname'] ?></td>
                    <td>
                        <?php
                        // if($pay == 2){
                            echo "تکمیل";
                        // }else{
                            // echo "پرداخت نشده";
                        // }
                        ?>
                    </td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
            </tr>
            <?php
            $query = "SELECT user_memnum  FROM register WHERE course_id=$course AND pay!=2;";
            $result = $conn->query($query);        
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                
                ?>
                <tr>
                    <td><?php echo $counter++ ?></td>
                    <td  class="photo"><img src="<?php echo $row1['image']?>"></td>
                    <td><?php echo $row1['membernum'] ?></td>
                    <td><?php echo $row1['firstname'] ?></td>
                    <td><?php echo $row1['lastname'] ?></td>
                    <td>
                        <?php
                            echo "پرداخت نشده";
                        ?>
                    </td>
                    <td></td>
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
