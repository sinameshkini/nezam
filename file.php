<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(isset($_GET['delete'])){
    $result = $conn->query("DELETE FROM files WHERE `name` = '{$_GET['delete']}'");
    unlink("file/".$_GET['delete']);
}
$course = $_GET['course'];
//echo $course;
if(isset($_GET['upload'])){
    $course_id = $_GET['course'];
    $uploadDirectory = "file/";

    //$errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['docx','pptx','pdf','rar','zip']; // Get all the file extensions

    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileTmpName  = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $photoName = $fileName; 
    //. '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $photoName;

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a pdf or pptx or docx or rar or zip file";
    }

    if ($fileSize > 500000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if (!$didUpload) {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
        else{
            $query = "INSERT INTO files (course_id,`name`,size) VALUES ('$course','$fileName','$fileSize')";
            $result = $conn->query($query);
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }

}
$query = "SELECT * FROM files WHERE course_id='$course'";
$result = $conn->query($query);
?>
<!doctype html>

<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>آپلود فایل درسی</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
<?php
    require_once ("header.php");
    require_once ("menu.php");
?>
<div align="right" >
    <form method="post" action="file.php?upload=1&course=<?php echo $course;?>" enctype="multipart/form-data">
        <input type="file" name="file"/>
        <input style="margin-left: 100px;" type="submit" name="submit" value="Upload"/>
    </form>

</div>

<div align="right">

    <table style="direction: rtl;">
        <tr>
            <th>نام</th>
            <th>KB حجم</th>
            <th></th>
        </tr>


        <?php
        while($row = $result->fetch_assoc()){
            
        ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['size']/1000 ?></td>
            <td>
                <a href="file/<?php echo $row['name']?>"class="download" >دانلود</a>
                <a href="file.php?delete=<?php echo $row['name']?>&course=<?php echo $course?>"class="updeld" >حذف</a>
            </td>
        </tr>
            <?php
        }
        ?>
    </table>

</body>
</html>


