<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddExamGrade.php" method="post">
			Enter Id Number: <input type="text" name="IdNumber"><br>
			Enter Exam Name: <input type="text" name="Ename"><br>
			Enter Exam Grade: <input type="number" name="ExamGrade" min="0" max="100">
			<br>
			<input type="submit" value="Add Exam Grade">
	</form>
	
</body>
</html>

<?php

	if(isset($_POST['IdNumber']) AND isset($_POST['Ename'])AND isset($_POST['ExamGrade'])){
		$idnum=$_POST["IdNumber"];
		$ename=$_POST["Ename"];
		$egrade=$_POST["ExamGrade"];

		if(!empty($idnum) AND !empty($ename) AND !empty($egrade)){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$Dname = "ClassRecord";

			$conn = new mysqli($servername, $username, $password, $Dname);

			$result = $conn->query("SHOW COLUMNS FROM `ExamGrades` LIKE '$ename'");
			$exists = (mysqli_num_rows($result))?TRUE:FALSE;

			if($exists){
				$sql = "SELECT * FROM ClassRecord.ExamGrades WHERE IdNumber = '$idnum'";
				$result = $conn->query($sql);

				if($result->num_rows > 0){
					$exam = "UPDATE ClassRecord.ExamGrades 
					SET $ename = $egrade
					WHERE IdNumber = $idnum";
					if($conn->query($exam)){
						echo "<br>Data Changed Successfully";
					}
					else{
						echo "Error: " .$exam . "<br>" . $conn->error;
					}
				}
				else{
					echo "Exam Name does not exist";
				}
			}
			else{
				echo "Exam Name does not exist";
			}

			
		}
		else{
			echo "Please Enter Complete Details";
		}


		
	}


	echo "<form action=\"index.html\">";
	echo "<input type=\"submit\" value=\"RETURN\">"

?>