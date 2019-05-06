<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
?>
<!DOCTYPE html>


<html style="direction: rtl">
<link rel="icon" href="Golestan.png">
<head>
    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>
    <title>ثبت دوره جدید</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="card" >

<form action="courses.php?insert=1" method="post">
    <center><table>
            <tr>
                <td>کد دوره</td>
                <td><input type="text" name="code" /></td>
            </tr>
        <tr>
            <td>عنوان دوره</td>
            <td><input type="text" name="name" /></td>
        </tr>
        <tr>
            <td>نام مدرس</td>
            <td><input type="text" name="teacher" /></td>
        </tr>
        <tr>
            <td>تاریخ برگزاری</td>
            <td><input type="text" name="length" /></td>
        </tr>
        <tr>
            <td>هزینه دوره (ریال)</td>
            <td><input type="text" name="coast" /></td>
        </tr>
        <tr>
            <td>محل برگزاری دوره</td>
            <td><input type="text" name="place" /></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input id="btninsert" type="submit" value="ثبت دوره" />
            </td>
        </tr>
    </table></center>
</form>
</body>
</html>