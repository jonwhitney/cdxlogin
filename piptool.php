<?php
require_once('includes/database.inc');

// Establish database settings
$db_settings = array(
  'server' => 'localhost:8888',
  'username' => 'root',
  'password' => 'root',
  'database' => 'cdxlogin',
);
// instantiate database object
$database = new database($db_settings);
// If sort isn't set, set it to a null value
if(!isset($sort)){
  $sort = NULL;
}

if (isset($_POST['firstName'])) {
    $var=$_POST['firstName'];
}
elseif (isset($_POST['lastName'])) {
    $var=$_POST['lastName'];
}
elseif (isset($_POST['institution'])) {
    $var=$_POST['institution'];
}
elseif (isset($_POST['courseName'])) {
    $var=$_POST['courseName'];
}
elseif (isset($_POST['theRole'])) {
    $var=$_POST['theRole'];
}
elseif (isset($_POST['fName'])) {
    $var=$_POST['fName'];
}
elseif (isset($_POST['lName'])) {
    $var=$_POST['lName'];
}
elseif (isset($_POST['emailTeacher'])) {
    $var=$_POST['emailTeacher'];
}


$theKey = key($_POST);


//$firstName="jed";
//echo "Entry is: " . $var . "<br />Key is: ".$theKey ."<br />";

$usub = $database->basicSelect('userName,firstName,lastName,email,courseID,courseName,
    firstAccess,lastAccess,theRole,fName,lName,emailTeacher,phone,institution,url', 
        all_users, $theKey .' LIKE "%'. $var .'%"');
//var_dump($usub);
$numSubs = count($usub);


?>
<html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
    <head>
        <link rel="stylesheet" type="text/css" href="foundation/foundation1.css">
        <link rel="stylesheet" type="text/css" href="foundation/foundation2.css">
        
    </head>
    <body>
    <table>
    <thead>
    <tr>
      <th bgcolor="aqua">First name</th>
      <th bgcolor="aqua">Last name</th>
      <th>Course name</th>
      <th>Role id</th>
      <th bgcolor="silver">fName</th>
      <th bgcolor="silver">lName</th>
      <th bgcolor="silver">cmEmail</th>
      <th bgcolor="silver">Institution</th>
    </tr>
    </thead> 
    <tr>
      <td><form name="input" action="" method="post">
        <input type="text" name="firstName" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="lastName" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="courseName" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="theRole" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="fName" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="lName" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="emailTeacher" size="20">
        <input type="submit" value="Submit">
        </form></td>
      <td><form name="input" action="" method="post">
        <input type="text" name="institution" size="40">
        <input type="submit" value="Submit">
        </form></td>
    </tr>
    </tbody>
</table>
<?php echo 'Records found: '.$numSubs . " ";?>
<table border="1">
<!--  <thead>
    <tr>
      <th>userName</th>
      <th>First name</th>
      <th>Last name</th>
      <th>eMail</th>
      <th>courseID</th>
      <th>Course name</th>
      <th>First access</th>
      <th>Last access</th>
      <th>Role id</th>
      <th>fName</th>
      <th>lName</th>
      <th>cmEmail</th>
      <th>phone</th>
      <th>Institution</th>
      <th>URL</th>
    </tr>
  </thead>-->
  
  <tbody>
<!--    <tr>
        <td colspan="8" align="center" bgcolor="aqua"><h3>Student</h3></td>
        <td colspan="7" align="center" bgcolor="silver"><h3>Instructor</h3></td>
    </tr>-->

      <?php 
//        var_dump($usub[0]);  
        $color="aqua";
        $cnt=0;
        foreach ($usub as $subly){
            echo '<tr>';
            foreach ($subly as $key => $value){
                echo '<td bgcolor='.$color.'>' . $value . '</td>';
                $cnt=$cnt+1;
                if ($cnt>7) {
                    $color="silver";
                    echo '</tr>';
                }
                if ($cnt==15) {
                    $cnt=0;
                    $color="aqua";
                    echo '</tr>';
                }
                }
            
//            echo '</tr>';
        }
        
      ?>
          </tr>
      </tbody>
    </table>
    </body>
</html>