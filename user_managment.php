<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
if(isset($_GET['login'])){
    $codemeli = $_GET['login'];
    $result = $conn->query("SELECT * FROM user WHERE codemeli=$codemeli");
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['membernum'] = $row['membernum'];
    require_once ("user.php");
    exit;
}
if(isset($_GET['delete'])){
    $codemeli = $_GET['delete'];
    unlink("images/".$codemeli.".jpg");
    $result = $conn->query("DELETE FROM user WHERE codemeli = '{$_GET['delete']}'") or die ($_GET['delete']); 
    $query = "SELECT * FROM user WHERE codemeli!='admin'";
    $result = $conn->query($query);
}
// else if(isset($_GET['insert'])){
//     $membernum = $_POST['membernum'];
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $codemeli = $_POST['codemeli'];
//     $parvanenum = $_POST['parvanenum'];
//     $phone = $_POST['phone'];
//     $mobile = $_POST['mobile'];
//     $email = $_POST['email'];
//     $address = $_POST['address'];
//     $password = $_POST['password'];

//     $query = "INSERT INTO user (membernum,firstname,lastname,codemeli,parvanenum,phone,mobile,email,address,password)
//      VALUES('$membernum','$firstname','$lastname','$codemeli','$parvanenum','$phone','$mobile','$email','$address','$password')";
//     $conn->query($query);
//     $query = "SELECT * FROM user";
//     $result = $conn->query($query);
// }
else if(isset($_GET['update'])){
    $membernum = $_POST['membernum'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $codemeli = $_POST['codemeli'];
    $parvanenum = $_POST['parvanenum'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
////////////////////////////////////////
if($_FILES['photo']['size']>10){
    $codemeli = $_GET['delete'];
    unlink("images/".$codemeli.".jpg");
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

        if (!$didUpload) {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
    
    $query = "UPDATE user SET membernum = '$membernum' , firstname = '$firstname' , lastname = '$lastname' , codemeli = '$codemeli'
    , parvanenum = '$parvanenum' , phone = '$phone' , mobile = '$mobile' , email = '$email'
    , `address` = '$address' ,`image` = '$uploadPath ' WHERE codemeli = '{$_GET['update']}'";
    $conn->query($query);
}else{
    $query = "UPDATE user SET membernum = '$membernum' , firstname = '$firstname' , lastname = '$lastname' , codemeli = '$codemeli'
        , parvanenum = '$parvanenum' , phone = '$phone' , mobile = '$mobile' , email = '$email'
        , `address` = '$address' WHERE codemeli = '{$_GET['update']}'";

    $conn->query($query);
}


    //////////////////////////////////////////
    $query = "SELECT * FROM user WHERE codemeli!='admin'" or die("error");
    $result = $conn->query($query);
}else if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM user WHERE lastname LIKE '%$search%' OR codemeli LIKE '%$search%'";
    $result = $conn->query($query);
}else{
    $query = "SELECT * FROM user WHERE codemeli!='admin'";
    $result = $conn->query($query);
}
?>

<!doctype html>

<style>
	


	input[type=text], input[type=password]
	{
   
    border-radius:5px;
	background-position: 10px 10px;
	background-repeat: no-repeat;
	width:15%;
	font-size: 16px;
	padding: 12px 20px 12px 40px;
	border: 1px solid #ddd;
	direction:rtl;
	font-family:"B Mitra";     	
	}

	</style>



<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>مدیریت کاربران</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
	

<body>
	
<?php
require_once ("header.php");
require_once ("menu.php");
?>
	
		
		<br />
		
		<div id="karbaran">
			<p><b>مدیریت کاربران</b></p>
		
			
			 <form action="user_managment.php" method="get">
				 
                
				  
                <input type="text" name="search" class="code" placeholder="کدملی،نام خانوادگی"/>
				
    			<input style="margin-top:15px;"  type="submit" class="button" value="جستجو" />
			
				<a style="margin-left: 200px; color: black;" href="signup.php" class="insert">
    			ثبت کاربر جدید
				</a></form>
                <div class="error"><span></span></div>
				 <div style="width: 100%; overflow-x: auto; display: block;">
					
		
		<table align="right" style="margin-top:25px;">
    <tr>
        <th>ردیف</th>
        <th>شماره نظام مهندسی</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>کدملی</th>
        <!-- <th>شماره پروانه</th> -->
		<!-- <th>تلفن</th> -->
		<th>شماره همراه</th>
		<th>ایمیل</th>
		<!-- <th>آدرس</th> -->
		<th >عکس</th>
        <th>ویرایش</th>
		
    </tr>
    <?php
    $counter = 1;
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $counter++ ?></td>
            <td style="text-align:center;"><?php echo $row['membernum'] ?></td>
            <td style="text-align:center;"><?php echo $row['firstname'] ?></td>
            <td style="text-align:center;"><?php echo $row['lastname'] ?></td>
            <td style="text-align:center;"><?php echo $row['codemeli'] ?></td>
            <!-- <td style="text-align:center;"><?php echo $row['parvanenum'] ?></td> -->
			<!-- <td style="text-align:center;"><?php echo $row['phone'] ?></td> -->
			<td style="text-align:center;"><?php echo $row['mobile'] ?></td>
			<td><?php echo $row['email'] ?></td>
			<!-- <td style="width:10px;"><?php echo $row['address'] ?></td> -->
			<td  class="photo"><img src="<?php echo $row['image']?>"></td>

			<td>
            <!-- <a onclick="javascript:confirm('آیا مطمئن هستید؟')" href="user_managment.php?delete=<?php echo $row['codemeli']; ?>" class="updeld">حذف</a> -->
            <script>
            function delete()
            {
                if(confirm('Sure To Remove This Record ?'))
                    {
                        href="user_managment.php?delete=<?php echo $row['codemeli']; ?>";
                    }
            }

            </script>
            <a href="userupdate.php?update=<?php echo $row['codemeli']; ?>" class="updel" style="color: black;">اصلاح</a>
            <a href="ad-register.php?memnum=<?php echo $row['membernum']; ?>" class="updel" style="color: black;">پنل کاربری</a> 
        </td>
            
        </tr>
        <?php
    }
    echo $row['image'];
    ?>
			

</table>

		

		
		</div>
				 
            
	
	</div>
		
	
</body>
</html>


