<?php  
 $room_id = $_POST['room_id'];
 $rname = $_POST['rname'];
 $from = $_POST['from'];
 $to = $_POST['to'];
 $comment = $_POST['comment'];
 $status = $_POST['status'];
 if(!$rname||!$from||!$to) die('<span style="color:red;font-size:14px">Моля въведете задължителните полета</span>');
 if(strlen($rname)>50) die('<span style="color:red;fodnt-size:14px">Моля въведете име до 50 символа</span>');
 if(strlen($comment)>200) die('<span style="color:red;font-size:14px">Моля въведете коментар до 50 символа</span>');
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	$sql="INSERT INTO  `hotels`.`reservation`(`id` ,`room_id` ,`name` ,`from` ,`to` ,`comment` ,`status`) VALUES (NULL,$room_id,'$rname','$from','$to','$comment','$status')";
		  
	$result = mysqli_query($con,$sql);
	
	if (!$result)
  	{
  		die('Неуспешно въвеждане ' . mysqli_error($con));
  	}
	echo "<span style='color:green;font-size:14px'>Успешно добавихте резервацията. Очаквайте обаждане за потвърждение:</span>";
	mail('dido.bball@gmail.com', 'Резервация ОХотели', "Име: ".$rname.", От: ".$from.", До: ".$to.", Коментар: ".$comment);
		
	mysqli_close($con);
?>