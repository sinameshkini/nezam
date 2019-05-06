<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['mobile'])) {
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
        <p><b> لیست شماره تلفن همراه</b></p>
        <br/>

    </div>
    <div style="direction: rtl;">
        <table>
            <?php
            while ($row = $result->fetch_assoc()) {
                $user_memnum = $row['user_memnum'];
                $query1 = "SELECT *  FROM user WHERE membernum = $user_memnum;";
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
               ?>
                <tr>
                    <td><?php echo $row1['mobile'] ?></td>
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
