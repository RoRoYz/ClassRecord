<?php  include('Eserver.php'); 

	$sql="SELECT * FROM Exam";
	$query=mysqli_query($db,$sql);    
	$num=mysqli_num_fields($query);
	$num=$num-3;				//num is the number of exams in the table

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$x=0;

		$update = true;
		$delete = false;
		$add = false;


		$rec = mysqli_query($db,"SELECT * FROM BasicInfo WHERE id=$id");
		$record = mysqli_fetch_array($rec);
		$fname=$record['FirstName'];
		$lname=$record['LastName'];
		$idnum = $record['IdNumber'];

		$rec = mysqli_query($db,"SELECT * FROM Exam WHERE id=$id");
		$record = mysqli_fetch_array($rec);
		$Eave = $record['ExamAve'];

		$temp=$num; 
		$sql = "SHOW COLUMNS FROM Exam";
		$result = mysqli_query($db,$sql);
		while($row = mysqli_fetch_array($result)){
			if($row['Field']!="id"){
				$ExamNames[$x] = $row['Field'];
				$x=$x+1;
			}
		}

	}
	if (isset($_GET['add'])){
		$add = true;
		$update = false;
		$delete = false;
	}
	if (isset($_GET['del'])){
		$delete = true;
		$add = false;
		$update = false;
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Exam</title>
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

	<?php $results = mysqli_query($db, "SELECT * FROM Exam"); ?>
<form method="post" action="Grades.php" >
	<input type="submit" value="Return">
</form>

<?php if($update==true){ ?>
<div class="form1">
		<form class="form1" method="post" action="Eserver.php" >
			
			Id Number:    <?php echo $idnum;?> <br>
			Name:         <?php echo "$fname $lname";?> <br>
			Exam Average: <?php echo round($Eave,2); ?>
		
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<?php 

				while ($row = mysqli_fetch_array($results)) { 
					$x=0; 
					if($row['id']===$id){
						while($x<$num){
							$E[$x] = $row[$x+3];
							$x=$x+1;
						}
					}
					
				}

				$x=0;
				while($x<$num){ 
			?>
					<div class="input-group">
						<label><?php echo $ExamNames[$x+2];?></label>
						<input type="number" name="E[<?php echo $x; ?>]" value="<?php echo $E[$x];?>" min="0" max="100" step=".01">
					</div> 
			<?php 
					$x=$x+1;
				} 
			?>
				

			<div class="input-group">
					<button class="btn" type="submit" name="update" style="background: #2E8B57;" >update</button>
			</div>
		</form>
</div>
<?php } ?>

<?php if($add==true){ ?>
<div class="form1">
		<form class="form1" method="post" action="Eserver.php" >
			<div class="input-group">
				<label>Exam Name:</label>
				<input type="text" name="Ename" value="Exam">
			</div> 
			<div class="input-group">
				<button class="btn" type="submit" name="add" >Add Exam</button>
			</div>
		</form>
</div>
<?php } ?>

<?php if($delete==true){ ?>
<div class="form1">
		<form class="form1" method="post" action="Eserver.php" >
			<div class="input-group">
				<label>Exam Name:</label>
				<input type="text" name="Ename" value="Exam">
			</div> 
			<div class="input-group">
				<button class="btn" type="submit" name="del" >Delete Exam</button>
			</div>
		</form>
</div>
<?php } ?>

	<table>
		<thead>
			<tr>
				<?php $temp=$num; 
					$sql = "SHOW COLUMNS FROM Exam";
					$result = mysqli_query($db,$sql);
					while($row = mysqli_fetch_array($result)){
						if($row['Field']!="id"){
							echo "<th>".$row['Field']."<br>"."</th>";
						}
					} ?>
						
				<th><a href="Exam.php?add" class="add_btn" name="add">Add</a></th>
				<th><a href="Exam.php?del" class="del_btn" name="delete">Delete</a></th>
				<th></th>
			</tr>
		</thead>
		
		<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['IdNumber']; ?></td>
				<td><?php echo round($row['ExamAve'],2); ?></td>
				<?php $x=0;
					  while($x<$num){ ?>
					<td><?php echo $row[$x+3]?></td>
				<?php $x=$x+1;} ?>
				<td>-</td>
				<td></td>
				<td></td>
				<td>
					<a href="Exam.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
				</td>
				<td></td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>