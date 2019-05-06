<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

?>


<!doctype html>

<html>
<link rel="icon" href="Golestan.png">
<head>
    <meta charset="utf-8">
    <title>تعریف دوره ها</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<?php
require_once ("header.php");
require_once ("menu.php");
$query = "SELECT * FROM course";
$result = $conn->query($query);
?>



<br>




<div id="dore">
    <p><b>آپلود فایل درسی</b></p>
   

</div>
<div align="right">

     <form action="dore.php" method="get">
        <input type="search" name="search" class="search" />
        <input  type="submit" class="button" value="جستجو" />
    </form>

    <table style="direction: rtl; margin-top:20px;">
        <tr>
            <th>کد دوره</th>
            <th>عنوان دوره</th>
            <th>مدرس</th>
            <th></th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row['code'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['teacher'] ?></td>
                <td>
                    <a href="file.php?course=<?php echo $row['code']?>"class="updel" >انتخاب دوره</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
   
</div>

</body>
</html>


