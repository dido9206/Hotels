<?php  
 $searchHotel = $_POST['searchHotel'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel WHERE name LIKE('%".$searchHotel."%')";
		  
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<option value=\"".$row['id']."\">".$row['name'].", ".$row['city'].", ".$row['address']."</option>";		
  	}

	mysqli_close($con);

  
?> 