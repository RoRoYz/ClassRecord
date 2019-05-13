<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'ClassRecord1');

	// initialize variables
	$idnum = "";
	$fname = "";
	$lname = "";
	$Aave = 0;
	$id = 0;
	$update = false;
	$add = false;
	$delete=false;


	if (isset($_POST['add'])) {
		$Aname=$_POST['Aname'];
		mysqli_query($db,"ALTER TABLE Assignment ADD $Aname FLOAT(6) NOT NULL");
		$_SESSION['message'] = "Assignment added"; 
		header('location: Assignment.php');
	}

	if (isset($_POST['edit'])) {
		header('location: Assignment.php');
	}

	if (isset($_POST['update'])) {
		$id=$_POST['id'];
		$sql="SELECT * FROM Assignment";
		$query=mysqli_query($db,$sql);    
		$num=mysqli_num_fields($query);
		$num=$num-3;

		$A=$_POST["A"];

		$temp=$num; 
		$sql = "SHOW COLUMNS FROM Assignment";
		$result = mysqli_query($db,$sql);
		$x=0;
		while($row = mysqli_fetch_array($result)){
			if($row['Field']!="id"){
				$Anames[$x] = $row['Field'];
				$x=$x+1;
			}
		}

		$x=0;
		$y=2;
		$sum=0;
		while($x<$num){
			mysqli_query($db,"UPDATE Assignment SET $Anames[$y]=$A[$x] WHERE id=$id");
			$sum=$sum+$A[$x];
			$x=$x+1;
			$y=$x+2;
		}
		$ave=$sum/($x);
		mysqli_query($db,"UPDATE Assignment SET AssignmentAve=$ave WHERE id=$id");

		$_SESSION['message'] = "Assignment Grades Updated"; 
		header('location: Assignment.php');
	}

	if (isset($_POST['del'])) {
		$Aname=$_POST['Aname'];
		mysqli_query($db,"ALTER TABLE Assignment DROP COLUMN $Aname");
		$_SESSION['message'] = "Assignment deleted"; 
		header('location: Assignment.php');
	}


	// retrieve records
	$results = mysqli_query($db,"SELECT * FROM Assignment");

// ...