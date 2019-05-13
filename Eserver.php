<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'ClassRecord1');

	// initialize variables
	$idnum = "";
	$fname = "";
	$lname = "";
	$Eave = 0;
	$id = 0;
	$update = false;
	$add = false;
	$delete=false;


	if (isset($_POST['add'])) {
		$Ename=$_POST['Ename'];
		mysqli_query($db,"ALTER TABLE Exam ADD $Ename FLOAT(6) NOT NULL");
		$_SESSION['message'] = "Exam added"; 
		header('location: Exam.php');
	}

	if (isset($_POST['edit'])) {
		header('location: Exam.php');
	}

	if (isset($_POST['update'])) {
		$id=$_POST['id'];
		$sql="SELECT * FROM Exam";
		$query=mysqli_query($db,$sql);    
		$num=mysqli_num_fields($query);
		$num=$num-3;

		$E=$_POST["E"];

		$temp=$num; 
		$sql = "SHOW COLUMNS FROM Exam";
		$result = mysqli_query($db,$sql);
		$x=0;
		while($row = mysqli_fetch_array($result)){
			if($row['Field']!="id"){
				$Enames[$x] = $row['Field'];
				$x=$x+1;
			}
		}

		$x=0;
		$y=2;
		$sum=0;
		while($x<$num){
			mysqli_query($db,"UPDATE Exam SET $Enames[$y]=$E[$x] WHERE id=$id");
			$sum=$sum+$E[$x];
			$x=$x+1;
			$y=$x+2;
		}
		$ave=$sum/($x);
		mysqli_query($db,"UPDATE Exam SET ExamAve=$ave WHERE id=$id");

		$_SESSION['message'] = "Exam Grades Updated"; 
		header('location: Exam.php');
	}

	if (isset($_POST['del'])) {
		$Ename=$_POST['Ename'];
		mysqli_query($db,"ALTER TABLE Exam DROP COLUMN $Ename");
		$_SESSION['message'] = "Exam deleted"; 
		header('location: Exam.php');
	}


	// retrieve records
	$results = mysqli_query($db,"SELECT * FROM Exam");

// ...