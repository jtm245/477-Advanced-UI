<?php 
  #f
  $hostname = "tund.cefns.nau.edu";
  $username = "yz82";
  $password = "Qm2C4beRDCr89QYJ";

  $database = "orders";
  $tableName = "orders";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  mysql_connect($host,$user,$pass);
  $con = mysql_connect($host,$user,$pass);
  mysql_select_db($databaseName);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT * FROM $tableName");          //query
  $array = mysql_fetch_row($result);                          //fetch result    

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);

?>