<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","123","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel WHERE id= ".$id;
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<li>
  				<a class='more' onclick='hotelList("."\"news\"".");'>Назад</a><br/><hr/>
				<div class='bigpic'>
					<p><a class='single_image' href='uploads/".$row['picture']."'><img src='uploads/".$row['picture']."'  width='100%' height='100%'/></a></p>
				</div>

				<h2>".$row['name']."<span>***</span></h2><br/>
				<span><b>Адрес:</b> </span>".$row['address']."<br/>
				<span><b>Град:</b> </span>".$row['city']."<br/>
				<span><b>Email:</b> </span>".$row['email']."<br/>
				<span><b>Описание:</b> </span>".$row['rooms_info']."<br/><hr/>
				<h3>Стаи:</h3><br/>
			  </li>";
  	}
	
	$sql="SELECT * FROM room WHERE hotel_id= ".$id;
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result))
  	{
  		echo "	<div class='bigpic'>
					<p><a class='single_image' href='uploads/".$row['picture']."'><img src='uploads/".$row['picture']."'  width='100%' height='100%'/></a></p>
				

				".$row['numbeds']." легла, ".$row['view']." гледка, баня: ".$row['havebathroom'].", цена: ".$row['price']." лв./нощувка<br/>
				<a id='inline' href='#tak'>Резервирай</a>
				<div id='tak' style='display:none'>
					<form id='addReservation' method='post'>
					<span id='rinfo_av'></span><br/>
					Име*: <input type='text' name='rname' id='rname' placeholder='Вашите имена'/><span id='rname_av'></span><br/><hr />
					<label>От*:</label><input type='text' id='from' name='from' /><label> До*:</label><input type='text' id='to' name='to' /><br/><hr />
					<span style='float: left'>Коментар:</span> <textarea name='comment' id='comment' rows='4' cols='50' placeholder='Коментар по резервацията'></textarea><span id='comment_av'></span><br/>
					<span style='font-size: 12px'>* - задължително поле</span>
					<button type='button' class='buttonadd' onclick='Add(".$row['id'].");'>Въведи</button>
					<button type='button' class='buttonchange' onclick='updateRoom();'>Промени</button>
	
					</form>
				</div>
				</div>";
  	}

	mysqli_close($con);

  
?> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script>
	var disabledDaysRange=getBookedDays(3);
	
	
	function getBookedDays(id2){
		var room2_id=id2;
		var temp=new Array();
		$.ajaxSetup({async: false});
		$.post(
				"php/getdays.php",
				{room2_id: room2_id},
				function (data)
				{
					for(var i=0;i<data.length;i++)
						temp.push(data[i]);
					
				},"json"
			);
		$.ajaxSetup({async: true});
		return temp;
	};
	
	function Add(id){
		var room_id=id;
		var rname = $('#rname').val();
		var from = $('#from').val();
		var to = $('#to').val();
		var comment = $('#comment').val();
		var status = "no";
		$.ajaxSetup({async: false});
		$.post(
				"php/add_reservation.php",
				{room_id: room_id,
				 rname: rname,
				 from: from,
				 to: to,
				 comment: comment,
				 status: status},
				function (data)
				{
					$('#rinfo_av').html(data);
				}
			);
		disabledDaysRange=getBookedDays(id);
		$( "#from" ).datepicker("refresh");
		$( "#to" ).datepicker("refresh");
		$.ajaxSetup({async: true});
		return false;
	};
	
	function disableRangeOfDays(d) {
    	for(var i = 0; i < disabledDaysRange.length; i++) {
      		  if($.isArray(disabledDaysRange[i])) {
            	for(var j = 0; j < disabledDaysRange[i].length; j++) {
               		var r = disabledDaysRange[i][j].split(" to ");
                	r[0] = r[0].split("-");
                	r[1] = r[1].split("-");
                	if(new Date(r[0][2], (r[0][0]-1), r[0][1]) <= d && d <= new Date(r[1][2], (r[1][0]-1), r[1][1])) {
                    	return [false];
                	}
            	}
        	}else{
            	if(((d.getMonth()+1) + '-' + d.getDate() + '-' + d.getFullYear()) == disabledDaysRange[i]) {
                	return [false];
            	}
        	}
    	}
    return [true];
};
	
	$( "#from" ).datepicker({
      		dateFormat: 'yy-dd-mm',
      		minDate: '0d',
     		beforeShowDay: disableRangeOfDays,
     		defaultDate: "+1w",
      		changeMonth: true,
      		numberOfMonths: 3,
      		onClose: function( selectedDate ) {
        		$( "#to" ).datepicker( "option", "minDate", selectedDate );
      		}
    	});
    	$( "#to" ).datepicker({
     		dateFormat: 'yy-dd-mm',
      		minDate: '0d',
      		beforeShowDay: disableRangeOfDays,
      		defaultDate: "+1w",
      		changeMonth: true,
      		numberOfMonths: 3,
      		onClose: function( selectedDate ) {
        		$( "#from" ).datepicker( "option", "maxDate", selectedDate );
      		}
    	});
</script>