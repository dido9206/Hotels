<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="DELETE FROM `hotel` WHERE `hotel`.`id` = ".$id." LIMIT 1;";
		  
	$result = mysqli_query($con,$sql);
	
	if (!$result)
  	{
  		die('Неуспешно изтриване' . mysqli_error($con));
  	}
	echo "Успешно изтрихте хотела!";
	mysqli_close($con);

  
?> 