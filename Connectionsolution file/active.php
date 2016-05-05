<?php         
//-----------------------------------------------------connects to my database
mysql_connect("tund.cefns.nau.edu", "yz82", "Qm2C4beRDCr89QYJ") or die(mysql_error());
mysql_select_db("yz82") or die (mysql_error());
//--------------------------------------------------------------
mysql_query("mysqldump-u yz82 -p users > yz82.sql");
?>