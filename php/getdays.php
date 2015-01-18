<?php  
 $id = $_POST['room2_id'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	$curr = array();
	//var_dump($_POST);
	$sql="SELECT * FROM reservation WHERE room_id= ".$id;
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
  	{
  		$arr = explode('-', $row['from']);
		$from = $arr[2].'-'.$arr[1].'-'.$arr[0];
  		$arr = explode('-', $row['to']);
		$to = $arr[2].'-'.$arr[1].'-'.$arr[0];
		if($from==$to)
		array_push($curr,$from);
		else
		array_push($curr,array($from." to ".$to));
  	}
	
	echo json_encode($curr);

	mysqli_close($con);

  
?> 
