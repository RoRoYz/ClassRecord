<?php  include('server.php'); 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];

		$update = true;

		$rec = mysqli_query($db,"SELECT * FROM BasicInfo WHERE id=$id");
		$record = mysqli_fetch_array($rec);
		$fname=$record['FirstName'];
		$lname=$record['LastName'];
		$idnum = $record['IdNumber'];
		$image = $record['Picture'];
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Class Record</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

	<?php $results = mysqli_query($db, "SELECT * FROM BasicInfo"); ?>
<form method="post" action="index.php" >
	<input type="submit" value="Return">
</form>
<div class="form1">
		<form class="form1" method="post" action="server.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="size" value="1000000">
			<div class="input-group">
				<label>Id Number</label>
				<input type="text" name="idnum" value="<?php echo $idnum; ?>">
			</div>
			<div class="input-group">
				<label>First Name</label>
				<input type="text" name="fname" value="<?php echo $fname; ?>">
			</div>
			<div class="input-group">
				<label>Last Name</label>
				<input type="text" name="lname" value="<?php echo $lname; ?>">
			</div>
			<div class="input-group">
				<label>Picture</label>
				<img src="images/<?php echo$image;?>" width="80px" height="80px" alt="_">
				<input type="file" accept="image/*" name="image" value="images/<?php echo $image; ?>">
			</div>
			<div class="input-group">
				<?php if ($update == true): ?>
					<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
				<?php else: ?>
					<button class="btn" type="submit" name="save" >Save</button>
				<?php endif ?>
			</div>
		</form>
</div>

	<table>
		<thead>
			<tr>
				<th>Id Number</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Picture</th>
				<th>Final Grade</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		
		<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['IdNumber']; ?></td>
				<td><?php echo $row['FirstName']; ?></td>
				<td><?php echo $row['LastName']; ?></td>
				<td><img src="images/<?php echo$row['Picture'];?>" width="40px" height="40px"></td>
				<td><?php 

						$qave = mysqli_query($db,"SELECT QuizAve FROM Quiz WHERE id={$row['id']}");
						$eave = mysqli_query($db,"SELECT ExamAve FROM Exam WHERE id={$row['id']}");
						$aave = mysqli_query($db,"SELECT AssignmentAve FROM Assignment WHERE id={$row['id']}");

						$q=mysqli_fetch_array($qave);
						$e=mysqli_fetch_array($eave);
						$a=mysqli_fetch_array($aave);

						$fgrade = $q[0]*0.3 + $e[0]*0.5 + $a[0]*0.2;

						echo $fgrade;

				 ?></td>
				<td>
					<a href="Students.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
				</td>
				<td>
					<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>