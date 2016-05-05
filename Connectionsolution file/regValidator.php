<!DOCTYPE html>
<?php
/* Validate Email Form 
 * This is the PHP file that validates entry from a simple email form.  If any
 * field fails validation, then the form is redisplayed with an error.
 */

/* define some variables */
$userid = $email = $fname = $lname = $password = $password2 = "";
?>

<html>
    <head>
        <title>CS 212 - Project 7 - Registration Form</title>
        <style type ="text/css">
            
            form {margin: 10px;
                    padding: 0;}
            .field {padding-top: 5px;}
            label {font-weight: bold; float: left; width: 20%;
                   margin-right: 1em; text-align: right;}
            #submit {margin-left: 35%; padding-top: 1em;}
            
        </style>
    </head>
    
    <body>
        <?php
        /* set a flag for the form's validity. Assume True */
        $validFlag = TRUE;
        
        /* scan the POST array and validate the fields */
        foreach ($_POST as $field => $value) {
            /* handle free-form text fields */
            if ($field === "fname") {
                if(empty($value)){
                    echo"You must fill in the First Name field.<br>\n";
                    $validFlag = FALSE;
                }
                /* if not empty, then save the data */
                else 
                {
                    $fname = $value;
                }
            }
            
            if ($field === "lname") {
                if(empty($value)){
                    echo"You must fill in the Last Name field.<br>\n";
                    $validFlag = FALSE;
                }
                /* if not empty, then save the data */
                else 
                {
                    $lname = $value;
                }
            }
            
            if ($field === "userid") {
                if(empty($value)){
                    echo"You must fill in the UserID field.<br>\n";
                    $validFlag = FALSE;
                }
                /* if not empty, then save the data */
                else 
                {
                    $userid = $value;
                }
            }
            
            /* handle email address format */
            if ($field === "email") {
                // echo preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9\_\.\-]*@[a-zA-Z0-9]+[a-zA-Z0-9\_\.\-]*\.(com|org|net|edu|gov)$#",$value)."!!";
                if(empty($value)){
                    echo"You must fill in the Email field.<br>\n";
                    $validFlag = FALSE;
                }
                //elseif (!ereg("^.+@.+\.(com|gov|org|edu)$",$value)) {
                elseif (1 != preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9\_\.\-]*@[a-zA-Z0-9]+[a-zA-Z0-9\_\.\-]*\.(com|org|net|edu|gov)$#",$value)) {
                    echo "Email address must be in the form 
                        <i>username@hostname.(com|org|edu|gov)</i>.<br>\n";
                    $validFlag = FALSE;
                }
                else 
                {
                    $email = $value;
                }
            }
            
            /* special handling for the password fields */
            if ($field === "password")
            {
                if(empty($value)){
                    echo"You must fill in the Password field.<br>\n";
                    $validFlag = FALSE;
                }
                else
                {
                    /* save the value */
                    $password = $value;
                }
                    
                /* might as well check the other field while we're at it */
                if(empty($_POST["password2"])){
                    echo"You must fill in the Password Verification field.<br>\n";
                    $validFlag = FALSE;
                }
                else
                {
                    /* save the value */
                    $password2 = $_POST["password2"];
                }
                
                /* Ok, now lets see if they match */
                if($password != $password2) {
                    // no match; tell user and clear the attempt
                    echo"The passwords must match. <br>\n";
                    $validFlag = FALSE;
                    $password = "";
                    $password2 = "";
                }
            }
        } /* end of the $_POST checking loop */
        
        /* If the validation flag is still TRUE, try to process the registration */
        if ($validFlag == TRUE)
        {
            /* first, connect to the database */
            $host = "tund.cefns.nau.edu";
            $user = "yz82";               
            $sqlpswd = "Zy921124";       
            $dbase = "root";              

            echo "<h2>Trying to connect server.</h2>";
            $cxn = mysql_connect($host,$user,$sqlpswd) or die ("No connection possible");
            if ($cxn == NULL)
            {
                echo "<h6>DB Connection Error</h6>";
                $validFlag = FALSE;
            }
            else echo "<h6>Connected. Trying to select database.</h6>";
            
            $dbr = mysql_select_db($dbase,$cxn)or die(mysql_error());
            if ($dbr == FALSE)
            {
                echo "<h6>DB Error: ".mysql_error($cxn)."</h6>";
                $validFlag = FALSE;
            }
            else echo "<h6>Database selected. Trying to register user.</h6>";

            // Now we see if the userid already exists.
            $sql="SELECT * FROM userinfo WHERE UserID ='$userid'";
            $result = mysql_query($sql,$cxn);
            if($result == FALSE)
            {
                echo "<h4>Query Error: ".mysql_error($cxn)."</h4>";
                $validFlag = FALSE;
            }
            else
            {
                // if the query succeeded and returned something
                // then print an error
                if(mysql_num_rows($result) > 0)
                {
                    echo "<p>That UserID ('$userid') is already in use.  Please select another userID.</p>";
                    $userid = "";  // Clear the old attempt and passwords
                    $password = "";
                    $password2 = "";
                    $validFlag = FALSE;
                }
                else /* we can at last attempt to enter the user into the table */
                {
                    $sql = "INSERT INTO userinfo (UserID, Password, FName, LName, Email) VALUES ('$userid', '$password', '$fname', '$lname', '$email')";
                    $result = mysql_query($sql,$cxn);

                    /* what happened? */
                    if($result == FALSE)
                    {
                        echo "<h4>Query Error: ".mysql_error($cxn)."</h4>";
                        echo "<p>Something went really wrong and your registration failed.<p>";
                        $validFlag = FALSE;
                    }
                    else
                    {
                        /* if I were doing a thorough job, I'd first check to see if this userid is alread logged in.
                         * But it's a new user, so how would that be possible?  Anway, to be sure, I'd first
                         * SELECT * FROM activity WHERE UserID == '$userid' AND LoggedIn == NULL and, just like
                         * checking for the UserID a couple of steps ago, if the result is FALSE or the number of
                         * rows returned is greater than 0, I'd report an error.  Otherwise, I'd continue to the
                         * following code.
                         */
                        echo "<p>User successfully registered.  Now attempting login.<p>";
                        $sql = "INSERT INTO activity (UserID, LoggedIn) VALUES ('$userid', SYSDATE())";
                        $result = mysql_query($sql,$cxn);

                        /* what happened? */
                        if($result == FALSE)
                        {
                            echo "<h4>Query Error: ".mysql_error($cxn)."</h4>";
                            echo "<p>Something went really wrong and we couldn't log you in.<p>";
                            echo "Please go to our <a href='login.html'>Login Form</a> and try again.<p>";
                            echo "Sorry for the inconvenience.";
                        }
                        else
                        {
                            /* it succeeded but we need to do a couple of other things
                             * before we report success. */
                            
                            /* start a session and save some useful stuff so
                             * we don't have to bug the database all the time */
                            session_start();
                            $_SESSION['userid'] = $userid;
                            $_SESSION['permission'] = 'User'; /* default */
                            $_SESSION['fname'] = $fname;
                            /* ^ useful for personalization */
                            /* Never, ever store a password in $_SESSION!!! */
                            
                            /* Ok, NOW they are logged in, let them know */
                            echo "<p>User successfully logged in.<p>";
                            echo "Click the link to return to our <a href='index.html'>Home Page</a> and browse from there.<p>";
                        }
                    }  /* end of login attempt */
                } /* end of insert attempt */
            } /* end of the whole transaction attempt */
        } /* end of what to do if simple PHP validation is good */
        
        /* if anything went wrong, redisplay the form */
        if ($validFlag == FALSE)
        {
            /* redisplay form */
            echo "<form method='POST' action='regValidator.php'>
                    <h3> Register </h3><br>
                    <div class='fname'>
                        <label for='fname'>Your First Name</label>
                        <input type='text' name='fname' id='fname'
                                    size='40' maxlength='15' value = '$fname' />
                    </div>
                    <div class='lname'>
                        <label for='lname'>Your Last Name</label>
                        <input type='text' name='lname' id='lname'
                                    size='40' maxlength='20' value = '$lname' />
                    </div>
                    <div class='email'>
                        <label for='email'>Your Email Address</label>
                        <input type='text' name='email' id='email'
                                    size='60' maxlength='40' value = '$email' />
                    </div>
                    <div class='userid'>
                        <label for='userid'>What UserID would you like?</label>
                        <input type='text' name='userid' id='userid'
                                    size='20' maxlength='8' value = '$userid' />
                    </div>
            
                    <div class='password'>
                        <label for='password'>Enter a password</label>
                        <input type='password' name='password' id='password'
                                    size='20' maxlength='12' value = '$password' />
                    </div>
            
                    <div class='password2'>
                        <label for='password2'>Reenter password for verification</label>
                        <input type='password' name='password2' id='password2'
                                    size='20' maxlength='12' value = '$password2' />
                    </div>
            
                    <div id='submit'>
                        <input type='submit' value='Register'>
                    </div>            
                </form>";
        }
        ?>
    </body>
</html>