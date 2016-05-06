<!DOCTYPE html>
<head>
	<title>CS212 Project #8 E-mail</title>                      
	

	
	<div id="mainContent">
	<h3>Please fill out the form below and click sumbit to send an email</h3>
	<h3><a href=delete.php>After your send your message, please click here to see your information.</a></h3>
	<h4>
	
	<form action="message.php" method="post">  
	
	<?php
	$con = mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ"); 
	if(!$con){
		die(mysql_error());
		}
	mysql_select_db("yz82",$con) ;
	
	
	$labels = array('to'=>'To: ',                                        //display the form
		            'from'=>'From:',
		            'subject'=>'Subject',                                // such as our project 6
		            'content'=>'Your Message:',
		            'submit'=>'When complete, press submit.');
		                
		foreach ($labels as $field => $label){
		    if($field === 'to' ||$field === 'from'||$field === 'subject'){
			echo "<div class='field'>";
			echo "<label for='$field'>$label</label>";
			echo "<input type='text' id='$field' name='$field'>";
			echo "</div>";}
			if($field ==='content'){
			echo"<div class = 'field'>";
			echo "<label for='$field'>$label</label>";
			echo "<textarea rows='8'  cols='50' id='$field' name='$field'></textarea>";
			echo "</div>";}
			if($field ==='submit'){
			echo"<div class = 'field'>";
			echo "<label for='$field'>$label</label>";
			echo "<input type='submit' >";
			echo "</div>";}
		
		}	
		$data = array('to'=> $_POST['to'],
		              'from'=> $_POST['from'],
		              'subject'=> $_POST['subject'],
		              'content'=> $_POST['content'],
		             								);
		             								
    // now, we will insert our information to our database
	mysql_query("INSERT INTO `yz82`.`message` (`to`, `from`, `subject`, `content`) VALUES ('${data['to']}', '${data['from']}', '${data['subject']}', '${data['content']}')") or die(mysql_error());
	?>
	
	</form>
	
	</div>
	
	<div id="footer">
	<div id="button">
	<p><a href="#top">Return to top</a></p>
	</div>
	</div>

</body>
</html>