<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']=='admin') {
    require_once ("index.php");
    exit;
}
if(isset($_GET['usr'])){
    $usr=$_GET['usr'];
    $course=$_GET['course'];
    $mem = $_SESSION['membernum'];
    
    $uploadDirectory = "license/";

    //$errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['photo']['name'];
    $fileSize = $_FILES['photo']['size'];
    $fileTmpName  = $_FILES['photo']['tmp_name'];
    $fileType = $_FILES['photo']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $photoName = $mem."-".$course.'.'.$fileExtension;
    $uploadPath = $uploadDirectory . $photoName;

    //echo $fileExtension;
    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 500000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
	//echo $fileTmpName;
	//echo $uploadPath;
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if (!$didUpload) {
            echo "An error occurred somewhere. Try again or contact the admin";
        }else{
            $query = "UPDATE register SET pay = 1  WHERE course_id = '$course' AND user_memnum='$mem'";
            $conn->query($query) or die("Rid!");
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
require_once("coursesignedup.php");
exit;



}
if(!(isset($_GET['name']) && isset($_GET['course']))){
    echo "درخواست نامعتبر";
    exit;
}
$course_name = $_GET['name'];
?>



<html>
<link rel="icon" href="Golestan.png">
<head>
    <meta charset="utf-8">
    <title>آپلود فیش واریزی</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<?php
require_once ("header.php");
?>

<body>

 <div id="Hozoorqiab">
        <p><b> آپلود عکس فیش</b></p>
        <br/>
    </div>
    <div id="felan">
    <?php
    $s1="این فیش توسط ";
    $s2=" برای دوره";
    $s3="به ادمین ارسال میشود";
    $s = $s1." \" ".$_SESSION['lastname']." \" ".$s2." \" ".$course_name." \" ".$s3;
    echo $s;  
    $usr = $_SESSION['username'];
    $course = $_GET['course']; 
    ?>
    <br/>
    <br/>
    <b> فرمتهای قابل قبول</b>
    <br/>
    <b> jpg , png , jpeg</b>
    <br/>
    <b> حداکثر حجم فایل</b>
    <br/>
    <b> ۵۰۰ کیلوبایت</b>
    </div>

<center><div id="license">
<form method="post" action="license.php?usr=<?php echo $usr;?>&course=<?php echo $course;?>" enctype="multipart/form-data">
        <input style="margin-top:50px;" type="file" name="photo"/>
        <input style="margin-left: 100px;" type="submit" name="submit" value="Upload"/>
    </form>
</div></center>

</body>

</html>