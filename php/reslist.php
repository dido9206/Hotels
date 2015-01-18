<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM reservation WHERE room_id=$id";
		  
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<option value=\"".$row['id']."\">".$row['name']." Име, ".$row['from']." от, ".$row['to']."до.</option>";		
  	}

	mysqli_close($con);

  
?> 