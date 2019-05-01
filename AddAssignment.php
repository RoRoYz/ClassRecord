<html>
<head>
	<title> </title>
</head>
<body>
	<form action="AddAssignment.php" method="post">
			Enter Assignment Name: <input type="text" name="AName">
			<br>
			<input type="submit" value="Add Assignment">
	</form>
	
</body>
</html>
<?php

if(isset($_POST['AName'])){
	$Aname=$_POST['AName'];

	if(!empty($Aname)){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$Dname = "ClassRecord";

		$conn = new mysqli($servername, $username, $password, $Dname);

		$sql = "ALTER TABLE AssignmentGrades
				ADD $Aname int(1)";


		if($conn->query($sql) === TRUE){
			echo "</br>Assignment added successfully";
		}
		else{
			echo "Error: " .$sql . "<br>" . $conn->error;
		}
	}
	else{
		echo "Please Enter Assignment Name";
	}
	
}


echo "<form action=\"index.html\">";
echo "<input type=\"submit\" value=\"RETURN\">"

?>