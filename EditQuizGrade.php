<html>
<head>
	<title> </title>
</head>
<body>
	<form action="EditQuizGrade.php" method="post">
			Enter Id Number: <input type="text" name="IdNumber"><br>
			Enter Quiz Name: <input type="text" name="Qname"><br>
			Enter Quiz Grade: <input type="number" name="QuizGrade" min="0" max="100">
			<br>
			<input type="submit" value="Add Quiz Grade">
	</form>
	
</body>
</html>

<?php

	if(isset($_POST['IdNumber']) AND isset($_POST['Qname'])AND isset($_POST['Qname'])){
		$idnum=$_POST["IdNumber"];
		$qname=$_POST["Qname"];
		$qgrade=$_POST["QuizGrade"];

		if(!empty($idnum) AND !empty($qname) AND !empty($qgrade)){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$Dname = "ClassRecord";

			$conn = new mysqli($servername, $username, $password, $Dname);

			$result = $conn->query("SHOW COLUMNS FROM `QuizGrades` LIKE '$qname'");
			$exists = (mysqli_num_rows($result))?TRUE:FALSE;

			if($exists){
				$sql = "SELECT * FROM ClassRecord.QuizGrades WHERE IdNumber = '$idnum'";
				$result = $conn->query($sql);

				if($result->num_rows > 0){
					$quiz = "UPDATE ClassRecord.QuizGrades 
					SET $qname = $qgrade
					WHERE IdNumber = $idnum";
					if($conn->query($quiz)){
						echo "<br>Data Changed Successfully";
						$Columns=$conn->query("SELECT COUNT(*)
											  FROM INFORMATION_SCHEMA.COLUMNS
											  WHERE table_catalog = '$Dname' -- the database
											  AND table_name = 'QuizGrades'");
						$numColumns = sizeof($Columns);
						echo "Number of Columns : $numColumns";

						#$conn->query("UPDATE ClassRecord.QuizGrades SET QuizAve = '$ave' WHERE IdNumber='$idnum'");
					}
					else{
						echo "Error: " .$quiz . "<br>" . $conn->error;
					}
				}
				else{
					echo "Quiz Name does not exist";
				}
			}
			else{
				echo "Quiz Name does not exist";
			}

			
		}
		else{
			echo "Please Enter Complete Details";
		}


		
	}


	echo "<form action=\"index.html\">";
	echo "<input type=\"submit\" value=\"RETURN\">"

?>