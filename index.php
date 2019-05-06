<?php
require_once ('include.php');
if(isset($_GET['login'])){
    login();
}elseif (isset($_GET['logout'])){
    logout();
}
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']==1) {
        require_once("admin.php");
    }elseif($_SESSION['user_type']==0){
        require_once("register.php");
    }else{
        echo "شما کاربر غیر مجاز هستید و به این صفحه دسترسی ندارید";
    }
    exit;
}
function login(){
    global $conn;
    global $salt;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result=$conn->query("SELECT * FROM user WHERE codemeli='$username'");
    $row=$result->fetch_assoc();
    if($row["codemeli"] == null){
        // echo "Login Failed. Check your Username and Password";
        ?>
        <script>
            alert("Hello! I am an alert box!");
        </script>
        <?php
        exit;
    }
    else{
        $hashedpass = md5($password.$salt);
        if($row['password'] == $hashedpass){
            $_SESSION['username'] = $username;
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['membernum'] = $row['membernum'];
            if($_SESSION['user_type']==0){
                require_once("register.php");
            }
            elseif($_SESSION['user_type']==1){
                require_once('admin.php');
            }else{
                echo "شما کاربر غیر مجاز هستید و به این صفحه دسترسی ندارید";
            }
            exit;
        }
        else{
            echo "Login Failed. Check your Username and Password";
            exit;
        }
    }
}

function logout(){
    $_SESSION = array();
    session_destroy();
}

$query = "SELECT * FROM news ORDER BY newsid DESC LIMIT 5";
$result = $conn->query($query);


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
<head>
    <meta charset="utf-8">
    <title>ورود به پنل مدیریت</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="icon" href="Golestan.png">
</head>


<body>

<div id="header">
    <div style="float: right; width: 7%; height: 100px;">
        <img src="Golestan.png">
    </div>
    <div id="golestan" style="padding-right: 10px; float: right; direction: rtl; width: 65%; height: 100px;line-height: 100px;">مرکز آموزش های کوتاه مدت دانشگاه گلستان</div>
    <div id="golestan" style="float: left; direction: rtl; width: 15%; height: 100px;line-height: 100px;"></div>
</div>

<?php
  //  require_once("eror.php");
?>
    <div class="card">
   
    <center>
        <p id="modiriat"><b>سامانه برگزاری دوره های آموزشی نظام مهندسی</b></p>
    </center>
    <br />
    
    <div id="news" style="float:left; width:50%;  margin-top:80px; margin-left:80px;">
    
   

    <table id="overflowTest" style="white-space:normal;">
        <tr>
            <th></th>
            <th> آخرین اخبار</th>
            <th></th>
        </tr>
 
        
        <tr style="background-color:#ddeef0;">
       
            <td style="width:10%; font-size:17px; text-align:center;"><b>تاریخ</b></td>
            <td style="width:70%; font-size:17px; text-align:center;"><b>متن</b></td>
            <td style="width:20%; font-size:17px; text-align:center;"><b>عنوان</b></td>
       
        </tr>
        
       
        <?php 
         while($row = $result->fetch_assoc()){
        ?>
       
        <tr>
            <td><?php echo date('m/d/Y',$row["date"])?></td>
            <td style="text-align:right; text-direction:rtl;"><?php echo $row["content"] ?></td>
            <td><?php echo $row["title"] ?></td>
        </tr>

        
        
        <?php
        }
        ?>
    </table>
</div>
</div>

    
        <div id="card2" style="float:left; width:400px; margin: 50 50 30 70">
            <div style="padding-top:40px;">
                <form role="form" action="index.php?login=1" method="post">
                    <div class="form-group">
                        <label for="usrname"><b style="padding-left: 23px; padding-right: 35px; ">کد ملی:</b></label>
                        <input type="text" name="username" class="form-control" id="usrname">

                    </div>
                    <br />
                    <div class="form-group">
                        <label for="psw"><b style="padding-left:10px; padding-right:35px;">رمز عبور:</b></label>
                        <input type="password" name="password" class="form-control" id="psw">
                    </div>
                    <center>
                   
                    <button id="btn-index" style="width:150px; padding:5px;" type="submit" >ورود</button>
                    <br />
                    <a id="a-index" style="width:150px; padding-right:2px; padding-left:2px; padding-top:5px; padding-bottom:5px;" href="signup.php">ثبت نام</a>
                
                    <a id="btn-index" style="width:150px; padding-right:2px; padding-left:2px; padding-top:5px; padding-bottom:5px;" href="recovery.php">بازیابی کلمه عبور</a>
                </form>
            </div>
        </div>
    </center>
    <?php
    $query = "SELECT * FROM files;";
    $result = $conn->query($query);
    //var_dump($result);
    ?>
    <table style="direction: rtl; margin: 0 auto">
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
        </td>
    </tr>
        <?php
    }
    ?>
</table>

 

</div>
</body>
</html>


