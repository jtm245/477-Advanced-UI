<html>

<?php  
   
//-----------------------------------------------------connects to my database
$con = mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ"); 
if(!$con){
	die(mysql_error());
	}
mysql_select_db("yz82",$con) ;
//--------------------------------------------------------checks cookies to make sure they are logged in 
$sql = "SELECT * FROM uesers";
$myData = mysql_query($sql, $con);
//----------------------------------------------------------------------------------




if(isset($_COOKIE['ID_my_site'])) {
	$username = $_COOKIE['ID_my_site']; 
	$pass = $_COOKIE['Key_my_site'];
	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
	
	echo"<table border =1>
	<tr>
	<th>Username</th>
	<th>Password</th>
	<th>Email</th>
	</tr>";
	while($info = mysql_fetch_array( $check )) {
		if ($pass != $info['password']) { //if the cookie has the wrong password, they are taken to the login page 
			header("Location: login.php");
		}
		else{	//otherwise they are shown the admin area	
		 echo  "<a href=update.php>Update or delete your information</a>";
		 echo  "</p>";  
		 echo "<a href=message.php>Send Message</a>";
		 echo  "</p>"; 
		 echo  "<a href=logout.php>Logout</a>"; 
		 echo  "</p>"; 
		 echo "<tr>";
		 echo "<td>" . $info['username'] . "</td>";
		 echo "<td>" . $info['password'] . "</td>"; 
		 echo "<td>" . $info['email'] . "</td>";
		 echo "</tr>";
			
		
			}
			}

   mysql_query("INSERT INTO `log`(`date`, `description`) VALUES (NOW(),'${username} login')");
	$log =  mysql_query("SELECT * FROM log ")or die(mysql_error());
	while($result = mysql_fetch_array( $log )){
	echo "</table>";
			echo"<table border =1>
	<tr>
	<th>Discription</th>
	<th>date</th>
	</tr>";
	echo "<td>" . $result['description'] . "</td>";
	echo "<td>" . $result['date'] . "</td>";
	echo "</table>";}
	
		mysql_close($con);
			}
	else{             //if the cookie does not exist, they are taken to the login screen 
			header("Location: login.php"); 
		}
?>
</html>