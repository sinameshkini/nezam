<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

if(isset($_GET['insert'])){
    $greetings = $_POST['greetings'];
    $lunch = $_POST['lunch'];
    $personnel = $_POST['personnel'];
    $othet = $_POST['other'];
    $query = "SELECT * FROM cost WHERE course_id = '{$_GET['course']}'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $Ngreetings = $greetings + $row['greetings'];
    $Nlunch = $lunch + $row['lunch'];
    $Npersonnel = $personnel + $row['personnel'];
    $Nother = $othet + $row['other'];


    $query = "UPDATE cost SET greetings = $Ngreetings , lunch = $Nlunch ,
     personnel = $Npersonnel , other = $Nother WHERE course_id = {$_GET['course']}";
    $conn->query($query) or die("ezafe nashod");

}
?>

<!doctype html>

<style>


    input[type=text]
    {
        width: 350px;
        padding:12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid powderblue;
        box-sizing: border-box;

    }



</style>
<?php
//require_once ("dbconnect.php");
//$course = $_GET['course'];
//echo $course;
//echo $_GET['course'];

$query = "SELECT * FROM cost WHERE course_id = '{$_GET['course']}'";
$result = $conn->query($query);
$row = $result->fetch_assoc()
?>

<html>
<link rel="icon" href="Golestan.png">
<head>
    <meta charset="utf-8">
    <title>ثبت هزینه ها</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<?php
require_once ("header.php");
require_once ('menu.php');
?>

    <br />
    <br />
    <center>
        <h2 id="list"><b>لیست هزینه های ثبت شده</b></h2>
    </center>
    <center>
        <table>
            <tr>
                <th>هزینه پذیرایی میان وعده</th>
                <th>مجموع هزینه ناهار</th>
                <th>هزینه پرسنلی</th>
                <th>سایر هزینه ها</th>
            </tr>
            <?php
            //while(){
            ?>
            <tr>
                <td><?php echo $row['greetings'] ?></td>
                <td><?php echo $row['lunch'] ?></td>
                <td><?php echo $row['personnel'] ?></td>
                <td><?php echo $row['other'] ?></td>
            </tr>
            <?php
            //}
            ?>
        </table>
    </center>
    <br />
    <br />
    <br />
<form action="cost.php?insert=1&course=<?php echo $_GET['course'] ?>" method="post">
    <div id="hazine">
        <center>
            <p><b>ثبت هزینه ها</b></p>
            <br />
            <center>
                <label for="uname"><b style="padding-left: 100px;">هزینه پذیرایی میان وعده:</b></label>
                <input class="" type="text" name="greetings" value="0" required>
                <br />
                <label for="uname"><b style="padding-left: 140px;">مجموع هزینه ناهار:</b></label>

                <input type="text" name="lunch" value="0" required>
                <br />
                <label for="uname"><b style="padding-left: 168px;">هزینه پرسنلی:</b></label>

                <input type="text" name="personnel" value="0" required>
                <br />
                <label for="uname"><b style="padding-left: 165px;">سایر هزینه ها:</b></label>
                <input type="text" name="other" value="0" required>
            </center>
            <button type="submit" class="button" style="width:70px; margin-top:20px;"><b>ثبت</b></button>
        </center>
    </div>
</form>
</body>
</html>



