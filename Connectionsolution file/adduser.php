<?php
$username = $email = $subject = $content = "";
if (isset($_POST['username']))
	$username = fix_string($_POST['username']);
if (isset($_POST['email']))
	$email = fix_string($_POST['email']);
if (isset($_POST['subject']))
	$username = fix_string($_POST['subject']);
if (isset($_POST['content']))
	$username = fix_string($_POST['content']);
	
$fail  =  validate_username($username);
$fail .=  validate_email($email);
$fail .=  validate_subject($subject);
$fail .=  validate_email($content);

echo "<html><head><title>An Example Form</title>";

if ($fail == "") {
	echo "</head><body>Form data successfully validated: 
	$username,$email, $subject, $content.</body></html>";
	
	// This is where you would enter the posted fields into a database
	
	exit; 
}

// Now output the HTML and JavaScript code

?>

<!-- The HTML section -->

<style>.signup { border: 1px solid #999999;
font: normal 14px helvetica; color:#444444; }</style>

<script type="text/javascript">

function validate(form)
{
	fail = validateUsername(form.username.value)
	fail += validateEmail(form.email.value)
	fail += validateSubject(form.subject.value)
	fail += validateContent(form.content.value)
	
	if (fail == ""){
		return true
	}
	else { alert(fail); return false }
}
function validateUsername(field)
{
	return (field == "") ? "No Username entered.\n" : "
}

function validationEmail(field)
{
	return (field == "") ? "No Email entered.\n" : "
}

function validationSubject(field)
{
	return (field == "") ? "No Subject entered.\n" : "
}

function validationContent(field)
{
	return (field == "") ? "No Content entered.\n" : "
}
 </script>
 </head>
 
 <body>
<table class="signup" border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
<th colspan="2" align="center">Form</th> 
<form method="post" action="adduser.php"onSubmit="return validate(this)">
  <tr><td>Username</td>
 	<td><input type="text" name="username" /></td> </tr>
  <tr><td>Email</td>
 	<td><input type="text" name="email" /></td></tr>
 <tr><td>Subject</td>
 	<td><input type="text" name="subject" /></td> </tr>
 <tr><td>Content</td>
 	<td><input type="text" name="content" /></td></tr>
 <tr><td colspan="2" align="center"><input type="submit" value="Submit" /></td> </tr>
 </form>
 </table>
 </body>
 </html>
 
<?php
	function validate_username($field) {
		if ($field == ""){
			return "No Username was entered<br />";}
	return ""; 
	}
	
	function validate_email($field) {
		if ($field == ""){
			return "No Email was entered<br />";}
	return ""; 
	}
	
	function validate_subject($field) {
		if ($field == ""){
			return "No Subject was entered<br />";}
	return ""; 
	}
	
	function validate_content($field) {
		if ($field == ""){
			return "No Content was entered<br />";}
	return ""; 
	}
?>