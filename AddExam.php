<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddExam.php" method="post">
			Enter Quiz Name: <input type="text" name="ExamName">
			<br>
			<input type="submit" value="Add Exam">
	</form>
	
</body>
</html>
<?php

if(isset($_POST['ExamName'])){
	$ename=$_POST['ExamName'];

	if(!empty($ename)){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$Dname = "ClassRecord";

		$conn = new mysqli($servername, $username, $password, $Dname);

		$sql = "ALTER TABLE ExamGrades
				ADD $ename int(1)";


		if($conn->query($sql) === TRUE){
			echo "</br>Exam added successfully";
		}
		else{
			echo "Error: " .$sql . "<br>" . $conn->error;
		}
	}
	else{
		echo "Please Enter Exam Name";
	}
	
}


echo "<form action=\"index.html\">";
echo "<input type=\"submit\" value=\"RETURN\">"

?>