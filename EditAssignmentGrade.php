<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddAssignmentGrade.php" method="post">
			Enter Id Number: <input type="text" name="IdNumber"><br>
			Enter Assignment Name: <input type="text" name="Aname"><br>
			Enter Assignment Grade: <input type="number" name="AssGrade" min="0" max="100">
			<br>
			<input type="submit" value="Add Assignment Grade">
	</form>
	
</body>
</html>

<?php

	if(isset($_POST['IdNumber']) AND isset($_POST['Aname'])AND isset($_POST['AssGrade'])){
		$idnum=$_POST["IdNumber"];
		$aname=$_POST["Aname"];
		$agrade=$_POST["AssGrade"];

		if(!empty($idnum) AND !empty($aname) AND !empty($agrade)){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$Dname = "ClassRecord";

			$conn = new mysqli($servername, $username, $password, $Dname);

			$result = $conn->query("SHOW COLUMNS FROM `AssignmentGrades` LIKE '$aname'");
			$exists = (mysqli_num_rows($result))?TRUE:FALSE;

			if($exists){
				$sql = "SELECT * FROM ClassRecord.AssignmentGrades WHERE IdNumber = '$idnum'";
				$result = $conn->query($sql);

				if($result->num_rows > 0){
					$ass = "UPDATE ClassRecord.AssignmentGrades 
					SET $aname = $agrade
					WHERE IdNumber = $idnum";
					if($conn->query($ass)){
						echo "<br>Data Changed Successfully";
					}
					else{
						echo "Error: " .$ass . "<br>" . $conn->error;
					}
				}
				else{
					echo "Id Number does not exist";
				}
			}
			else{
				echo "Assignment Name does not exist";
			}

			
		}
		else{
			echo "Please Enter Complete Details";
		}


		
	}


	echo "<form action=\"index.html\">";
	echo "<input type=\"submit\" value=\"RETURN\">"

?>