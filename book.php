<html>
<head>
<link rel="stylesheet" href="main.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "dbconfig.php"; ?>
<script>
function getTown(val) {
	$.ajax({
	type: "POST",
	url: "get_town.php",
	data:'countryid='+val,
	success: function(data){
		$("#town-list").html(data);
	}
	});
}
function getClinic(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'townid='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getDoctorday(val) {
	$.ajax({
	type: "POST",
	url: "getdoctordaybooking.php",
	data:'cid='+val,
	success: function(data){
		$("#doctor-list").html(data);
	}
	});
}

function getDay(val) {
	var cidval=document.getElementById("clinic-list").value;
	var didval=document.getElementById("doctor-list").value;
	$.ajax({
	type: "POST",
	url: "getDay.php",
	data:'date='+val+'&cidval='+cidval+'&didval='+didval,
	success: function(data){
		$("#datestatus").html(data);
	}
	});
}

</script>
<body style="background-image:url(images/bookback.jpg)">
	<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a href="patient.php" class="logo">PERSONAL HEALTHCARE ASSISTANT</li>
			<li><a href="book.php">Book Now</a></li>
			<li><a href="patient.php">Home</a></li>
		</ul>
	</div>
	<form action="book.php" method="post">
	<div class="sucontainer" style="background-image:url(images/bookback.jpg)">
		<label><b>Name:</b></label><br>
		<input type="text" placeholder="Enter Full name of patient" name="fname" required><br>
		
		<label><b>Gender</b></label><br>
		<input type="radio" name="gender" value="female">Female
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="other">Other<br><br>
	
		<label style="font-size:20px" >City:</label><br>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getTown(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select City</option>
		<?php
		$sql1="SELECT distinct(city) FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
		<?php
		}
		?>
		</select>
        <br>
	
		<label style="font-size:20px" >Town:</label><br>
		<select id="town-list" name="Town" onChange="getClinic(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select Town</option>
		</select><br>
		
		<label style="font-size:20px" >Clinic:</label><br>
		<select id="clinic-list" name="Clinic" onChange="getDoctorday(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select Clinic</option>
		</select><br>
		
		<label style="font-size:20px" >Doctor:</label><br>
		<select id="doctor-list" name="Doctor" onChange="getDate(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">Select Doctor</option>
		</select><br>
		
		
		<label><b>Date of Visit:</b></label><br>
		<input type="date" name="dov" onChange="getDay(this.value);" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" required><br><br>
		<div id="datestatus"> </div>
		<label><b>Phone Number:</b></label><br>
		<input type="number" name="phone" required><br><br>
		
		<div class="container">
			<button type="submit" style="position:center" name="submit" value="Submit">Submit</button>
		</div>
<?php
session_start();
if(isset($_POST['submit']))
{
		
		include 'dbconfig.php';
		$fname=$_POST['fname'];
		$gender=$_POST['gender'];
		$username=$_SESSION['username'];
		$cid=$_POST['Clinic'];
		$did=$_POST['Doctor'];
		$dov=$_POST['dov'];
		$status="Booking Registered.Wait for the update";
		$timestamp=date('Y-m-d H:i:s');
		$sql = "INSERT INTO book (Username,Fname,Gender,CID,DID,DOV,Timestamp,Status) VALUES ('$username','$fname','$gender','$cid','$did','$dov','$timestamp','$status') ";
		if(!empty($_POST['fname'])&&!empty($_POST['gender'])&&!empty($_SESSION['username'])&&!empty($_POST['Clinic'])&&!empty($_POST['Doctor']) && !empty($_POST['dov']))
		{
			$checkday = strtotime($dov);
			$compareday = date("l", $checkday);
			$flag=0;
			require_once("dbconfig.php");
			$query ="SELECT * FROM doctor_availability WHERE DID = '" .$did. "' AND CID='".$cid."'";
			$results = $conn->query($query);
			while($rs=$results->fetch_assoc())
			{
				if($rs["day"]==$compareday)
				{
					$flag++;
					break;
				}
			}
			if($flag==0)
			{
				echo "<h2>Select another date as Doctor Unavailable on ".$compareday."</h2>";
			}
			else
			{
				if (mysqli_query($conn, $sql)) 
				{
						echo "<h2>Booking successful!! Confirmation message sent to the entered phone numberRedirecting to home page....</h2>";
						$phone=$_POST['phone'];
                        $message="Booking successful!! on".$dov." </h2>";

 // Be sure to include the file you've just downloaded
    require_once('AfricasTalkingGateway.php');
    // Specify your login credentials
    $username   = "sandbox";
    $apikey     = "81b6b95b0e975b38acf49ab03ba9576724179f25c3b47750d46a2a859ea7ba43";
    $recipients = $phone;
    $message    = $message;
    $gateway    = new AfricasTalkingGateway($username, $apikey,"sandbox");
    try 
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);
                
      foreach($results as $result) {
        // status is either "Success" or "error message" 
      }
    }
    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while sending: ".$e->getMessage();
    }

                


						header( "Refresh:4; url=patient.php");

				} 
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
		else
		{
			echo "Enter data properly!!!!";
		}
}
?>
	</form>
</body>
</html>