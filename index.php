<!DOCTYPE html>
<html>
<head>
    <title>Class Record</title>
    <style type="text/css">
    	*{
    		margin: 0px;
    	}
    	h1{
    		text-align: center;
    		background-color: #ccebff;
    		padding: 15px;
    	}
    	body{
    		background-color: azure;
    	}
    	div{
    		width: 50%;
    		padding: 20px 0px;
    		float: left;
    		text-align: center;
    		box-sizing:border-spacing;
    	}
    	div:hover{
    		background-color: white;
    	}
    	input{
    		padding: 15px 10px;
    		border-radius: 20%;
    	}
    </style>
</head>
<body>
	<h1>Class Record</h1>
	<hr>

	<div>
        <form action="Students.php">
            <input type="submit"  value="View/Edit Students">
        </form>
	</div>
	<div>
        <form action="Grades.php">
            <input type="submit"  value="View/Edit Grades">
        </form>
	</div>
</body>
</html>