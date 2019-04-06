<?php
$servername = "localhost";
$username = "root";
$password = "";
$Dname = "ClassRecord";

$conn = new mysqli($servername, $username, $password, $Dname);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$idnum=$_POST["IdNumber"];
$lastname=$_POST["LastName"];
$firstname=$_POST["FirstName"];

$sql = "INSERT INTO Phonebook1.contacts(IdNumber,
										LastName,
										FirstName)
								
								VALUES ('$idnum',
										'$lastname',
										'$firstname')";


if($conn->query($sql) === TRUE){
	echo "</br> New record created successfully";
}
else{
	echo "Error: " .$sql . "<br>" . $conn->error;
}

echo "<form action=\"index.html\">";
echo "<input type=\"submit\" value=\"RETURN\">"

?>