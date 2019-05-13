<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'ClassRecord1');

	// initialize variables
	$idnum = "";
	$fname = "";
	$lname = "";
	$qave = 0;
	$id = 0;
	$update = false;
	$add = false;
	$delete=false;

	// retrieve records
	$results = mysqli_query($db,"SELECT * FROM Quiz");

	if (isset($_POST['add'])) {
		$qname=$_POST['qname'];
		mysqli_query($db,"ALTER TABLE Quiz ADD $qname FLOAT(6) NOT NULL");
		$_SESSION['message'] = "Quiz added"; 

		//for updating the quiz averages of each student after adding a quiz
		$sql="SELECT * FROM Quiz";
		$query=mysqli_query($db,$sql);    
		$num=mysqli_num_fields($query);
		$num=$num-3;
		

		while ($row = mysqli_fetch_array($results)) { 
			$x=0; 
			$sum=0;
			while($x<$num){
				$q[$x] = $row[$x+3];
				$sum=$sum+$q[$x];
				$x=$x+1;
			}
			$ave=$sum/$x;
			mysqli_query($db,"UPDATE Quiz SET QuizAve=$ave WHERE id={$row['id']}");
		}

		header('location: Quiz.php');
	}

	if (isset($_POST['edit'])) {
		header('location: Quiz.php');
	}

	if (isset($_POST['update'])) {
		$id=$_POST['id'];
		$sql="SELECT * FROM Quiz";
		$query=mysqli_query($db,$sql);    
		$num=mysqli_num_fields($query);
		$num=$num-3;

		$q=$_POST["q"];

		$temp=$num; 
		$sql = "SHOW COLUMNS FROM Quiz";
		$result = mysqli_query($db,$sql);
		$x=0;
		while($row = mysqli_fetch_array($result)){
			if($row['Field']!="id"){
				$qnames[$x] = $row['Field'];
				$x=$x+1;
			}
		}

		$x=0;
		$y=2;
		$sum=0;
		while($x<$num){
			mysqli_query($db,"UPDATE Quiz SET $qnames[$y]=$q[$x] WHERE id=$id");
			$sum=$sum+$q[$x];
			$x=$x+1;
			$y=$x+2;
		}
		$ave=$sum/($x);
		mysqli_query($db,"UPDATE Quiz SET QuizAve=$ave WHERE id=$id");

		$_SESSION['message'] = "Quiz Grades Updated"; 
		header('location: Quiz.php');
	}

	if (isset($_POST['del'])) {
		$qname=$_POST['qname'];
		mysqli_query($db,"ALTER TABLE Quiz DROP COLUMN $qname");
		$_SESSION['message'] = "Quiz deleted"; 

		//for updating the quiz averages of each student after deleting a quiz
		$sql="SELECT * FROM Quiz";
		$query=mysqli_query($db,$sql);    
		$num=mysqli_num_fields($query);
		$num=$num-3;
		

		while ($row = mysqli_fetch_array($results)) { 
			$x=0; 
			$sum=0;
			while($x<$num){
				$q[$x] = $row[$x+3];
				$sum=$sum+$q[$x];
				$x=$x+1;
			}
			$ave=$sum/$x;
			mysqli_query($db,"UPDATE Quiz SET QuizAve=$ave WHERE id={$row['id']}");

		}

		header('location: Quiz.php');
	}


	

// ...