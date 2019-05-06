<?php
require_once ('include.php');
require_once("class.phpmailer.php");
$msg = "";
if(isset($_GET['recovery'])){
    if(!isset($_POST['mail']) || $_POST['mail'] == null){
        $msg = "فیلد ایمیل را پر کنید";
    }else{
        $mail_address = $_POST['mail'];
        $result=$conn->query("SELECT * FROM user WHERE email='$mail_address'");
        $row=$result->fetch_assoc();
        if($row["email"] == null){
            $msg = "این ایمیل ثبت نام نشده است";
        }else{
            $mail = new PHPMailer();
            $mail->addAddress($mail_address);
            $mail->setFrom('info@sottabyte.ir', 'Support');
            $mail->addReplyTo("info@sottabyte.ir");
            $mail->Subject    = 'Golestan Nezam password recovery';
            $ath = md5($row['codemeli']);
            $memnum = $row['membernum'];
            $mail->Body = "<h2>یازیابی کلمه عبور سامانه نظام مهندسی دانشگاه گلستان</h2><br>جهت بازیابی برروی لینک زیر کلیک کنید<br><a href='http://10.75.48.183/nezam/recovery.php?mem=$memnum&ath=$ath'>بازیابی کلمه عبور</a>";
            $mail->isHTML(true);
            if ($mail->send()) {
                $msg = 'لطفا ایمیل خود را چک کنید. همچنین پوشه اسپم را چک کنید';
            } else {
                $msg = 'خطا در سیستم لطفا با پشتیبانی تماس بگیرید';
            }
        }
    }
}
if(isset($_GET['sub'])){
        $ath = $_GET['sub'];
        $memnum = $_GET['mem'];
        $result=$conn->query("SELECT * FROM user WHERE membernum='$memnum'");
        $row=$result->fetch_assoc();
        $codemeli = $row['codemeli'];
        $hashcodemeli = md5($codemeli);
        if($hashcodemeli == $ath){
            $pass = $_POST['pass'];
            $confirm = $_POST['confirm'];
            if($pass == $confirm){
                $hashedpass = md5($pass.$salt);
                $result=$conn->query("UPDATE user SET `password`='$hashedpass' WHERE membernum='$memnum'");
                if($result){
                    $msg = "کلمه عبور شما با موفقیت تغییر یافت";
                }else{
                    $msg = "خطا در سرور. با پشتیبانی تماس بگیرید";
                }
            }else{
                $msg = "کلمه عبور مطابقت ندارد. لطفا دوباره روی لینکی که برای شما ایمیل شد کلیک کنید و دوباره کلمه عبور را وارد کنید";
            }

        }else{
            $msg = "درخواست غیر مجاز";
        }


}
?>

<style>

input[type=text], input[type=password]
{
    width: 200px;
    padding:10px 16px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid powderblue;
    box-sizing: border-box;
    border-radius: 50px;
}

</style>

<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>بازیابی کلمه عبور</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<div id="header">
<div style="float: right; width: 7%; height: 100px;">
    <img src="Golestan.png">
</div>
<div id="golestan" style="padding-right: 10px; float: right; direction: rtl; width: 65%; height: 100px;line-height: 100px;">مرکز آموزش های کوتاه مدت دانشگاه گلستان</div>
<div id="golestan" style="float: left; direction: rtl; width: 15%; height: 100px;line-height: 100px;">


</div>
</div>
<div class="card">
   
   <center>
       <p id="modiriat"><b>سامانه برگزاری دوره های آموزشی نظام مهندسی</b></p>
  
    <br />
    <?php echo $msg;
    if(!isset($_GET['ath'])){
    ?>
    <div id="card2" style="float:center; width:400px; margin=auto;">
            <div style="padding-top:40px;">
                <form role="form" action="?recovery=1" method="post">
                    <div class="form-group">
                        <label for="usrname"><b style="padding-left: 23px; padding-right: 35px; ">ایمیل:</b></label>
                        <input type="text" name="mail" class="form-control" id="usrname">

                    </div>
                    <br />
                    <center>
                   
                    <button id="btn-index" style="width:150px; padding:5px;" type="submit" >ارسال ایمیل بازیابی</button>
                    <br />
                </form>
            </div>
        </div>
        <?php
    }else{
        $ath = $_GET['ath'];
        $memnum = $_GET['mem'];
        $result=$conn->query("SELECT * FROM user WHERE membernum='$memnum'");
        $row=$result->fetch_assoc();
        $codemeli = $row['codemeli'];
        $hashcodemeli = md5($codemeli);
        if($hashcodemeli == $ath){
        ?>
            <div id="card2" style="float:center; width:400px; margin=auto;">
                <div style="padding-top:40px;">
                    <form role="form" action=<?php echo "http://10.75.48.183/nezam/recovery.php?sub=$ath&mem=$memnum"; ?> method="post">
                        <div class="form-group">
                            <label for="usrname"><b style="padding-left: 23px; padding-right: 35px; ">کلمه عبور جدید:</b></label>
                            <input type="password" name="pass" class="form-control" id="usrname">
                            <br>
                            <label for="usrname"><b style="padding-left: 23px; padding-right: 35px; ">تکرار کلمه عبور:</b></label>
                            <input type="password" name="confirm" class="form-control" id="usrname">
                        </div>
                        <br />
                        <center>
                    
                        <button id="btn-index" style="width:150px; padding:5px;" type="submit" >تغییر کلمه عبور</button>
                        <br />
                    </form>
                </div>
            </div>
        <?php 
    }else{
        echo "لینک تا معتبر";
    }
}
        ?>

        </center>