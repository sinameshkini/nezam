<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}

$query = "SELECT * FROM course";
$result = $conn->query($query);
?>
<!doctype html>



<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>ثبت هزینه</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<?php
require_once ("header.php");
require_once ("menu.php")
?>
<br />
<br />

		<div id="Hozoorqiab">
			<p><b> ثبت هزینه های دوره ها</b></p>
			<br />

	</div>
		<div style="direction: rtl;">
		<table >
    <tr>
        <th>کد دوره</th>
        <th>عنوان دوره</th>
        <th>مدرس</th>
        <th></th>

    </tr>
    <?php
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['code'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['teacher'] ?></td>
            <td>
            <a href="cost.php?course=<?php echo $row['code']?>" class="updel" style="color: black;">انتخاب</a>
        </td>
        </tr>
        <?php
    }
    ?>
</table>

		</div>

</body>
</html>


