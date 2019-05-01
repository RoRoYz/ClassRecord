<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddStudent.php" method="post">
			Enter Name: <input type="text" name="Name">
			Enter Id Number: <input type="text" name="IdNumber">
			<br>
			<input type="submit" value="Add Student">
	</form>
	
</body>
</html>
<?php

	if(isset($_POST['Name']) AND isset($_POST['IdNumber'])){
		$idnum=$_POST["IdNumber"];
		$name=$_POST["Name"];

		if(!empty($idnum) AND !empty($name)){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$Dname = "ClassRecord";

			$conn = new mysqli($servername, $username, $password, $Dname);

			$basicinfo = "INSERT INTO ClassRecord.BasicInfo(IdNumber,Name)
							VALUES ('$idnum','$name')";

			$assignment = "INSERT INTO ClassRecord.AssignmentGrades(IdNumber)
							VALUES ('$idnum')";

			$quiz = "INSERT INTO ClassRecord.QuizGrades(IdNumber)
							VALUES ('$idnum')";

			$exam = "INSERT INTO ClassRecord.ExamGrades(IdNumber)
							VALUES ('$idnum')";

			if($conn->query($basicinfo) === TRUE AND $conn->query($assignment) === TRUE AND $conn->query($quiz) === TRUE AND $conn->query($exam) === TRUE){
				echo "</br> New Student added successfully";
			}
			else{
				echo "Error: " .$basicinfo . "<br>" . $conn->error;
			}

			
		}
		else{
			echo "Please Enter Complete Details";
		}
		
	}


	echo "<form action=\"index.html\">";
	echo "<input type=\"submit\" value=\"RETURN\">"

?>