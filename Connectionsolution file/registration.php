<html>

<?php         
//-----------------------------------------------------connects to my database
mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ") or die(mysql_error());
mysql_select_db("yz82") or die (mysql_error());

//This code runs if the form has been submitted 
if (isset($_POST['submit'])) {       //This makes sure they did not leave any fields blank
	if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
		die('You did not complete all of the required fields,<br><a href=registration.php>Click Here to Register again');
	}
	if (!get_magic_quotes_gpc()) {// checks if the username is in use
		$_POST['username'] = addslashes($_POST['username']);
	}
	
	$usercheck = $_POST['username'];
	$check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'")or die(mysql_error());
	$check2 = mysql_num_rows($check);
	
	if ($check2 != 0) {//if the name exists it gives an error
		die('Sorry, the username '.$_POST['username'].' is already in use. <br><a href=registration.php>Click Here to Register again');
		}
	
	if ($_POST['pass'] != $_POST['pass2']) {  //this makes sure both passwords entered match 
		die('Your passwords did not match. <br><a href=registration.php>Click Here to Register again');
		
	}
	
	$_POST['pass'] = md5($_POST['pass']);     // here we encrypt the password and add slashes if needed
	if (!get_magic_quotes_gpc()) {
		$_POST['pass'] = addslashes($_POST['pass']);
		$_POST['username'] = addslashes($_POST['username']);
	}
	
	$insert = "INSERT INTO users (username, password, email) VALUES ('".$_POST['username']."', '".$_POST['pass']."','".$_POST['email']."' )"; // we insert it into the database
	$add_member = mysql_query($insert);
?>

<h1>Registered</h1>
<p>Thank you, you have registered - you may now login</a>.</p>
<p><a href=login.php>Click Here to login</a></p>

<?php
} 
else 
{
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table border="0">
<tr><td>Username:</td><td>
<input type="text" name="username">	
</td></tr>
<tr><td>Password:</td><td>
<input type="password" name="pass" >
</td></tr>
<tr><td>Confirm Password:</td><td>
<input type="password" name="pass2">
</td></tr>
<tr><td>E-mail:</td><td>
<input type="text" name="email">
</td></tr>
<tr><th colspan=2><input type="submit" name="submit"  value="Register"></th></tr> </table>
</form>
<?php
}
?>
<html>