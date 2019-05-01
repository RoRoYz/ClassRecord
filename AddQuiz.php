<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddQuiz.php" method="post">
			Enter Quiz Name: <input type="text" name="QuizName">
			<br>
			<input type="submit" value="Add Quiz">
	</form>
	
</body>
</html>
<?php

if(isset($_POST['QuizName'])){
	$qname=$_POST['QuizName'];

	if(!empty($qname)){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$Dname = "ClassRecord";

		$conn = new mysqli($servername, $username, $password, $Dname);

		$sql = "ALTER TABLE QuizGrades
				ADD $qname int(1)";


		if($conn->query($sql) === TRUE){
			echo "</br>Quiz added successfully";
		}
		else{
			echo "Error: " .$sql . "<br>" . $conn->error;
		}
	}
	else{
		echo "Please Enter Quiz Name";
	}
	
}


echo "<form action=\"index.html\">";
echo "<input type=\"submit\" value=\"RETURN\">"

?>