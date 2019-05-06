<?php
require_once ("include.php");
if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    require_once ("index.php");
    exit;
}
?>
<!doctype html>

<link rel="stylesheet" href="style.css" type="text/css">

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



<html>
<link rel="icon" href="Golestan.png">
<head>
<meta charset="utf-8">
<title>محاسبه درآمد</title>
</head>


<body>


    <?php
        require_once ('header.php');
        require_once ('menu.php');
    ?>
		<br />
		<br />

		<div id="daramad">
			<p><b>محاسبه درآمد</b></p>
			<br />
	</div>
	<div>
		<center>
			<table style="direction: rtl;">
	  <tr>
          <th><input name="select_all" value="1" type="checkbox"></th>
          <th>کد دوره</th>
          <th>نام دوره</th>
          <th>مدرس</th>
          <th>مجموع هزینه ها</th>
          <th>مجموع شهریه ها</th>
	  <th>مجموع کل</th>
	  </tr>
	<?php
		$query = "SELECT * FROM course";
		$result = $conn->query($query);
		$total_cost = 0;
		$total_earn = 0;
	
		while($row = $result->fetch_assoc()){
			$course_id = $row['code'];
			$cost_query = "SELECT * FROM cost WHERE course_id='$course_id'";
			$cost_result = $conn->query($cost_query);
			$cost_row = $cost_result->fetch_assoc();
			$cost_sum = $cost_row['greetings']+$cost_row['lunch']+$cost_row['personnel']+$cost_row['other'];
			$total_cost += $cost_sum;
			$earn_query = "SELECT * FROM register WHERE course_id='$course_id' AND pay=2";
			$earn_result = $conn->query($earn_query);
			$student_num = $earn_result->num_rows;
			$earn_sum = $student_num * $row['coast'];
			$total_earn += $earn_sum;
	?>
	  <tr>
          <td><input type="checkbox" name="name1" /></td>
          <td><?php echo $row['code'] ?></td>
          <td><?php echo $row['name'] ?></td>
          <td><?php echo $row['teacher'] ?></td>
          <td><?php echo $cost_sum ?></td>
	  <td><?php echo $earn_sum ?></td>
	  <td style="direction:ltr;"><?php echo $earn_sum - $cost_sum ?></td>
	  </tr>
	<?php
		}
		?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>مجموع کل</td>
			<td><?php echo $total_cost ?></td>
			<td><?php echo $total_earn ?></td>
			<td><?php echo $total_earn-$total_cost?></td>
		</tr>
	</table>
	</center>
	<br />
	<br />
	<br />

	</div>
	<div>
		<!-- <center><button id="btn"><b>محاسبه درآمد</b></button></center> -->
		</div>
</body>
</html>



