
<html>

<?php         
//-----------------------------------------------------connects to my database
$con = mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ"); 
if(!$con){
	die(mysql_error());
	}
mysql_select_db("yz82",$con) ;



//--------------------------------------------------------checks cookies to make sure they are logged in 
if(isset($_POST['update'])){
$UpdateQuery = "UPDATE users SET Username='$_POST[username]', Password='$_POST[password]',Email='$_POST[email]' WHERE Username='$_POST[hidden]' ";
mysql_query($UpdateQuery, $con);
}
if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM users  WHERE Username='$_POST[hidden]' ";
mysql_query($DeleteQuery, $con);
}

$sql = "SELECT * FROM users";
$myData = mysql_query($sql, $con);
//----------------------------------------------------------------------------------
	echo"<table border =1>
	<tr>
	<th>Username</th>
	<th>Password</th>
	<th>Email</th>
	</tr>";
	while($info = mysql_fetch_array( $myData )) {
		 echo"<form action = update.php method = post>";	
		 echo "<tr>";
		 echo "<td>"  . "<input type=text name=username value=" . $info['username'] . "></td>";
		 echo "<td>"  . "<input type=text name=password value=" . $info['password'] . "></td>"; 
		 echo "<td>"  . "<input type=text name=email value=" . $info['email'] . "></td>";
		 echo "<td>"  . "<input type=hidden name=hidden value=" . $info['username'] . "></td>";
		 echo "<td>"  . "<input type=submit name=update value=update" ." ></td>";
		 echo "<td>"  . "<input type=submit name=delete value=delete" ." ></td>";
		 echo "</tr>";
		 echo"</form>";
	}
		echo "</table>";
		mysql_close($con);
?>
</html>