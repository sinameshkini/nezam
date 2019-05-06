<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(!isset($_GET['update']))
    die("You must set a student number.");
$result = $conn->query("SELECT * FROM course WHERE `code` = {$_GET['update']}");
$course = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html style="direction: rtl">
<link rel="icon" href="Golestan.png">
<head>
    <title>اصلاح</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<?php
require_once ("header.php");
require_once ("menu.php");
?>
    <title>ثبت دوره جدید</title>
    <meta charset="utf-8" />
<form action="courses.php?update=<?php echo $course['code'] ?>" method="post">
    <table>
        
        <tr>
            <td>عنوان دوره</td>
            <td><input type="text" name="name" value="<?php echo $course['name'] ?>" /></td>
        </tr>
        <tr>
            <td>نام مدرس</td>
            <td><input type="text" name="teacher" value="<?php echo $course['teacher'] ?>" /></td>
        </tr>
        <tr>
            <td>تاریخ برگزاری</td>
            <td><input type="text" name="length" value="<?php echo $course['length'] ?>" /></td>
        </tr>
        <tr>
            <td>هزینه دوره (ریال)</td>
            <td><input type="text" name="coast" value="<?php echo $course['coast'] ?>" /></td>
        </tr>
        <tr>
            <td>محل برگزاری دوره</td>
            <td><input type="text" name="place" value="<?php echo $course['place'] ?>" /></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input id="btninsert" style="width:180px;" type="submit" value="اصلاح اطلاعات" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>