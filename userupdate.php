<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(!isset($_GET['update']))
    die("You must set a student number.");
$result = $conn->query("SELECT * FROM user WHERE `codemeli` = '{$_GET['update']}'") or die("error");
$user = $result->fetch_assoc();
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
	<form action="user_managment.php?update=<?php echo $user['codemeli'] ?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>شماره نظام مهندسی</td>
            <td><input type="text" name="membernum" value="<?php echo $user['membernum'] ?>" /></td>
        </tr>
        <tr>
            <td>نام</td>
            <td><input type="text" name="firstname" value="<?php echo $user['firstname'] ?>" /></td>
        </tr>
        <tr>
            <td>نام خانوادگی</td>
            <td><input type="text" name="lastname" value="<?php echo $user['lastname'] ?>" /></td>
        </tr>
        <tr>
            <td>کد ملی</td>
            <td><input type="text" name="codemeli" value="<?php echo $user['codemeli'] ?>" /></td>
        </tr>
        <tr>
            <td>شماره پروانه</td>
            <td><input type="text" name="parvanenum" value="<?php echo $user['parvanenum'] ?>" /></td>
        </tr>
        <tr>
            <td>شماره تلفن ثابت</td>
            <td><input type="text" name="phone" value="<?php echo $user['phone'] ?>" /></td>
        </tr>
        <tr>
            <td>شماره تلفن همراه</td>
            <td><input type="text" name="mobile" value="<?php echo $user['mobile'] ?>" /></td>
        </tr>
        <tr>
            <td>ایمیل</td>
            <td><input type="text" name="email" value="<?php echo $user['email'] ?>" /></td>
        </tr>
        <tr>
            <td>آدرس</td>
            <td><input type="text" name="address" value="<?php echo $user['address'] ?>" /></td>
        </tr>
       <!-- <tr>
           <td>تصویر</td>
           <td><input type="file" name="photo"></td>
       </tr> -->
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" id="btninsert" style="width:180px;" value="اصلاح اطلاعات" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>