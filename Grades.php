<!DOCTYPE html>
<html>
<head>
    <title>Grades</title>
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
    		width: 33%;
    		padding: 20px 0px;
    		float: left;
    		text-align: center;
    		box-sizing:border-spacing;
    	}
    	div:hover{
    		background-color: white;
    	}
    	div input{
    		padding: 15px 10px;
    		border-radius: 20%;
    	}
    </style>
</head>
<body>
	<h1>Grades</h1>
	<hr>

     
    <form method="post" action="index.php" >
        <input type="submit" value="Return">
    </form>
	<div>
        <form action="Quiz.php">
            <input type="submit"  value="View/Edit Quizzes">
        </form>
	</div>
	<div>
        <form action="Exam.php">
            <input type="submit"  value="View/Edit Exams">
        </form>
	</div>
    <div>
        <form action="Assignment.php">
            <input type="submit"  value="View/Edit Assignments">
        </form>
    </div>

</body>
</html>