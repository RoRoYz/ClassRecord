<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'ClassRecord1');

	// initialize variables
	$idnum = "";
	$fname = "";
	$lname = "";
	$image = "";
	$id = 0;
	$update = false;
	$msg="";



	if (isset($_POST['save'])) {
		$idnum = $_POST['idnum'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$image = $_FILES['image']['name'];
		$target = "images/".basename($_FILES['image']['name']);

		mysqli_query($db, "INSERT INTO BasicInfo (FirstName, LastName, IdNumber,Picture) VALUES ('$fname', '$lname', '$idnum','$image')"); 
		mysqli_query($db, "INSERT INTO Quiz (IdNumber) VALUES ('$idnum')");
		mysqli_query($db, "INSERT INTO Exam (IdNumber) VALUES ('$idnum')");
		mysqli_query($db, "INSERT INTO Assignment (IdNumber) VALUES ('$idnum')");

		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$msg="Image Uploaded Successfully";
		}
		else{
			$msg="Image Unsuccessful Upload";
		}

		$_SESSION['message'] = "Student added"; 
		header('location: Students.php');
	}

	if (isset($_POST['edit'])) {
		$fname = mysqli_real_escape_string($db,$_POST['fname']);
		$lname = mysqli_real_escape_string($db,$_POST['lname']);
		$idnum = mysqli_real_escape_string($db,$_POST['idnum']);
		$image = mysqli_real_escape_string($db,$_FILES['image']['name']);
		$id = mysqli_real_escape_string($db,$_POST['id']);
	}

	if (isset($_POST['update'])) {
		$fname = mysqli_real_escape_string($db,$_POST['fname']);
		$lname = mysqli_real_escape_string($db,$_POST['lname']);
		$idnum = mysqli_real_escape_string($db,$_POST['idnum']);
		$image = mysqli_real_escape_string($db,$_FILES['image']['name']);
		$target = "images/".basename($_FILES['image']['name']);
		$id = mysqli_real_escape_string($db,$_POST['id']);

		mysqli_query($db, "UPDATE BasicInfo SET FirstName = '$fname' , LastName = '$lname', IdNumber = '$idnum', Picture='$image' WHERE id=$id");
		mysqli_query($db, "UPDATE Quiz SET IdNumber = '$idnum' WHERE id=$id");
		mysqli_query($db, "UPDATE Exam SET IdNumber = '$idnum' WHERE id=$id");
		mysqli_query($db, "UPDATE Assignment SET IdNumber = '$idnum' WHERE id=$id");
		
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$_SESSION['message'] = "Student updated"; 
		header('location: Students.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM BasicInfo WHERE id=$id");
		$_SESSION['message'] = "Student deleted!"; 
		mysqli_query($db, "DELETE FROM Quiz WHERE id=$id");
		mysqli_query($db, "DELETE FROM Exam WHERE id=$id");
		mysqli_query($db, "DELETE FROM Assignment WHERE id=$id");
		header('location: Students.php');
	}


	// retrieve records
	$results = mysqli_query($db,"SELECT * FROM BasicInfo");

// ...