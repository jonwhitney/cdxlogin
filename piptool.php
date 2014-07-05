<?php


require_once('includes/database.inc');
require_once('foundation/foundation.inc');

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

$usub = $database->basicSelect('stuAcronym,userName,firstName,lastName,email,courseID,
    courseName,firstAccess,lastAccess,theRole,fName,lName,emailTeacher,phone,institution,url', all_users, 'stuAcronym = "aarl"');
//count entries in array of subdomains (1176)
$numSubs = count($usub);
echo '<br />Number found: '.$numSubs;

$template = new foundationStructure();
$template->renderHeader("CDX login data merge");
?>

<table border="1" cellpadding="10">
  <thead>
    <tr>
      <th>acronym</th>
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
      <th>Search</th>
    </tr>
<!--    
    <form action="search.php" method="post">
	Enter your zipcode:
	<input type="text" id="zipsearch" />
 
	<br />
	<input type="submit" value="Search" />
</form>-->
    
    <tr><form> 
      <td><input type="text" id="acroSearch" /></td>
      <td>userName</td>
      <td><input type="text" id="userNameSearch" /></td>
      <td><input type="text" id="firstNameSearch" /></td>
      <td><input type="text" id="lastNameSearch" /></td>
      <td>courseID</td>
      <td><input type="text" id="courseNameSearch" /></td>
      <td>First access</td>
      <td>Last access</td>
      <td><input type="text" id="roleSearch" /></td>
      <td><input type="text" id="fNameSearch" /></td>
      <td><input type="text" id="lNameSearch" /></td>
      <td><input type="text" id="teacherEmailSearch" /></td>
      <td>phone</td>
      <td><input type="text" id="instSearch" /></td>
      <td><input type="text" id="urlSearch" /></td>
      <td><input type="submit" value="Search" /></td>
    </form></tr>
  </thead>
  <tbody>
      
  </tbody>
</table>
  
<table border="1" cellpadding="10">
  <thead>
    <tr>
      <th>acronym</th>
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
  </thead>
  
  <tbody>
      <?php 
//        var_dump($usub[0]);  
        foreach ($usub as $subly){
            echo '<tr>';
            foreach ($subly as $key => $value){
                echo '<td>' . $value . '</td>';
                }
            echo '</tr>';
        }
      ?>
          </tr>
  </tbody>
</table>