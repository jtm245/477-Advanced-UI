<html>

<?php         
//-----------------------------------------------------connects to my database
$con = mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ"); 
if(!$con){
	die(mysql_error());
	}
mysql_select_db("yz82",$con) ;



//--------------------------------------------------------checks cookies to make sure they are logged in 
if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM message  WHERE `to`='$_POST[hidden]' ";
mysql_query($DeleteQuery, $con);
}

$sql = "SELECT * FROM message";
$myData = mysql_query($sql, $con);
//----------------------------------------------------------------------------------
	echo"<table border =1>
	<tr>
	<th>To</th>
	<th>From</th>
	<th>Subject</th>
	<th>Message</th>
	</tr>";
	while($info = mysql_fetch_array( $myData )) {
		 echo"<form action = delete.php method = post>";	
		 echo "<tr>";
		 echo "<td>"  . "<input type=text name=to value=" . $info['to'] . "></td>";
		 echo "<td>"  . "<input type=text name=from value=" . $info['from'] . "></td>"; 
		 echo "<td>"  . "<input type=text name=subject value=" . $info['subject'] . "></td>";
		 echo "<td>"  . "<input type=text name=message value=" . $info['content'] . "></td>";
		 echo "<td>"  . "<input type=hidden name=hidden value=" . $info['to'] . "></td>";
		 echo "<td>"  . "<input type=submit name=delete value=delete" ." ></td>";
		 echo "</tr>";
		 echo"</form>";
	}
		echo "</table>";
		mysql_close($con);
?>
</html>