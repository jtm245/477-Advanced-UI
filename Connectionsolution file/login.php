<html>

<?php         

//-----------------------------------------------------connects to my database
$con = mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ"); 
if(!$con){
	die(mysql_error());
	}
mysql_select_db("yz82",$con) ;

if(isset($_COOKIE['ID_my_site'])) {  // check if there is a login cookie
	$username = $_COOKIE['ID_my_site'];
	$pass = $_COOKIE['kEY_my_site'];
	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
	
	while($info = mysql_fetch_array( $check )){
		if ($pass != $info['password']) {
		}
		else{
			header("Location: members.php");
			}
	}
}
if(isset($_POST['submit'])){
if(!$_POST['username'] | !$_POST['pass']){    // make sure they filled ot in
	die('You did not fill in a required field.');
	}
	
if (!get_magic_quotes_gpc()){
	$_POST['email'] = addslashes($_POST['email']);
	}
	
	$check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."' AND users.Delete != '1'")or die(mysql_error());
	
	$check2 = mysql_num_rows($check);
	if($check2 == 0){
		die('That user does not exist in our database. <a href=registration.php>Click Here to Register</a>');
		}
		
	while($info = mysql_fetch_array( $check )) {
		$_POST['pass'] = stripslashes($_POST['pass']);  
		$info['password'] = stripslashes($info['password']);  
		$_POST['pass'] = md5($_POST['pass']);
		
		if ($_POST['pass'] != $info['password']){         //gives error if the password is wrong
			die('Incorrect password, please try again. <a href=login.php>Click Here to Login again</a>');
		}
		
		else{                 // if login is ok then we add a cookie 
			$_POST['username'] = stripslashes($_POST['username']);
			$hour = time() + 3600;
			setcookie(ID_my_site, $_POST['username'], $hour);
			setcookie(Key_my_site, $_POST['pass'], $hour);	
			header("Location: members.php");// then redirect them to the members area
			}
		}
	}
	
	else
		{
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post"> 
	<table border="0">
	<tr><td colspan=2><h1>Login</h1></td></tr> 
	<tr><td>Username:</td><td> 
	<input type="text" name="username" >
	</td></tr>
	<tr><td>Password:</td><td>
	<input type="password" name="pass" >
	</td></tr>
	<tr><td colspan="2" align="right"> 
	<input type="submit" name="submit" value="Login">
	</td></tr>
	</table>
	</form>
	<?php
	}

	?>

<html>
