<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel WHERE id = ".$id." LIMIT 1;";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
 		echo json_encode(array("name"=>$row['name'],"city"=>$row['city'],"address" =>$row['address'],"stars"=>$row['stars'],"roomsinfo"=>$row['rooms_info'],"email"=>$row['email']));
  	}
	mysqli_close($con);

  
?> 