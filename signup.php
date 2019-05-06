<?php
require_once ("include.php");
if(isset($_GET['insert'])) {
    $membernum = $_POST['membernum'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $codemeli = $_POST['codemeli'];
    $parvanenum = $_POST['parvanenum'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $hashedpass = md5($password.$salt);

    $result=$conn->query("SELECT * FROM user WHERE codemeli='$codemeli'");
    $row=$result->fetch_assoc();
    if($row["codemeli"] != null){
        echo "این کد ملی قبلا ثبت شده است";
        exit;
    }
    $result=$conn->query("SELECT * FROM user WHERE membernum='$membernum'");
    $row=$result->fetch_assoc();
    if($row["membernum"] != null){
        echo "این شماذه عضویت نظام مهندسی قبلا ثبت شده است";
        exit;
    }
    if($_FILES['photo']['size']>10){

    // file upload
    //$currentDir = getcwd();
    $uploadDirectory = "images/";

    //$errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['photo']['name'];
    $fileSize = $_FILES['photo']['size'];
    $fileTmpName  = $_FILES['photo']['tmp_name'];
    $fileType = $_FILES['photo']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $photoName = $codemeli . '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $photoName;

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a jpeg or png or jpg file";
    }

    if ($fileSize > 500000) {
        $errors[] = "This file is more than 500KB. Sorry, it has to be less than or equal to 500KB";
    }

    if (empty($errors)) {
	//echo $fileTmpName;
	//echo $uploadPath;
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        echo "up:".$uploadPath;
        echo " ft:".$fileTmpName;
        echo " res:".$didUpload;
        if (!$didUpload) {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
    
    $query = "INSERT INTO user (membernum,firstname,lastname,codemeli,parvanenum,phone,mobile,email,address,password,image)
     VALUES('$membernum','$firstname','$lastname','$codemeli','$parvanenum','$phone','$mobile','$email','$address','$hashedpass','$uploadPath')";
    $conn->query($query) or die("Unsuccsicfully signup,Database Error");
}else{
    $query = "INSERT INTO user (membernum,firstname,lastname,codemeli,parvanenum,phone,mobile,email,address,password)
    VALUES('$membernum','$firstname','$lastname','$codemeli','$parvanenum','$phone','$mobile','$email','$address','$hashedpass')";
   $conn->query($query) or die("Unsuccsicfully signup,Database Error");
}
echo "ثبت نام شما با موفقیت انجام شد";
$_SESSION['username'] = $codemeli;
$_SESSION['lastname'] = $lastname;
$_SESSION['membernum'] = $membernum;
require_once ("register.php");
exit;
    
}else{

    ?>
    <!doctype html>
    <style>


        input[type=text], input[type=password] {
            width: 450px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid powderblue;
            box-sizing: border-box;
        }

        button a {
            text-decoration: none;
            list-style: none;
        }


    </style>


    <html>
    <link rel="icon" href="Golestan.png">
    <head>
        <meta charset="utf-8">
        <title>ثبت نام در سامانه</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>
    <?php
    require_once ("header.php");
    ?>

    <div class="card">
             <div class="container">
                <center>
                    <p id="samane"><b>ثبت نام در سامانه</b></p>
                </center>
                <br/>
                <form action="signup.php?insert=1" method="post" enctype="multipart/form-data">
                    <center>
                        <label for="uname"><b style="padding-left: 300px;">نام: *</b></label>
                        <input type="text" name="firstname" placeholder="فقط حروف فارسی" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 233px;">نام خانوادگی: *</b></label>

                        <input type="text" name="lastname" placeholder="فقط حروف فارسی" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 273px;">کدملی: *</b></label>

                        <input type="text" name="codemeli" placeholder="اعداد لاتین - 10 رقم" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 120px;">شماره عضویت نظام مهندسی: *</b></label>

                        <input type="text" name="membernum" placeholder="اعداد لاتین - 10 رقم" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 138px;">شماره پروانه اشتغال به کار: *</b></label>

                        <input type="text" name="parvanenum" placeholder="اعداد لاتین" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 198px;">شماره تماس ثابت:</b></label>

                        <input type="text" name="phone" placeholder="اعداد لاتین - 11 رقم" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 190px;">شماره تماس همراه: *</b></label>

                        <input type="text" name="mobile" placeholder="اعداد لاتین - 11 رقم" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 276px;">ایمیل: *</b></label>

                        <input type="text" name="email" required/>
                        <br/>
                        <label for="uname"><b style="padding-left: 273px;">آدرس:</b></label>

                        <input type="text" name="address" placeholder="حروف فارسی" required/>
                        <br/>

                        <label for="psw"><b style="padding-left: 250px;">رمز عبور: *</b></label>
                        <input type="password" name="password" required>
                        <br />
                        <br />
                        <label for="uname"><b style="margin-left: 450px;">آپلود عکس</b></label>
                        <input type="file" name="photo" >
                    </center>
                    <br/>
                    <center>
                        <button type="submit"><a id="a-index" href="signup.php"><b>ثبت نام</b></a></button>
                    </center>
                    
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <label>
                    <input type="checkbox" checked="checked" name="remember"> مرا بخاطر بسپار
                </label>

            </div>

    </div>
    </body>
    </html>
    <?php
}
?>
