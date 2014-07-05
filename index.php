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


/*
 * Get the subdomain names stored in clientMgr, place in array $earl
 * Get list of URLs from clientMgr
 *  http://ttba.cdxsite.com
 * Explode them on '.'
 * Strip 'http://' -- first seven characters
 * Then use the first element of the array, the sub-domain identifier to match 
 * the 'school' field from 'trans' against the sub-domain to create the relationship between the two schools
 */
$earl = $database->basicSelect('url', 'clientMgr', 1);

//foreach($earl as $early=>$earls){
//    foreach($earls as $theUrl){
//        if ($theUrl){
//            echo "<br /><br /> value: " .$theUrl."<br />";
//            $theSub = explode(".",$theUrl, 4);
//            echo " zero: ".substr($theSub[0], 7)."<br />";
//            echo " one: ".$theSub[1]."<br />";
//            echo " two: ".$theSub[2];
//        }
//    }
//}
$n=0;
foreach($earl as $early=>$earls){
    foreach($earls as $theUrl){
        if ($theUrl){
            $theSub = explode(".",$theUrl, 4);
            $actualSub = substr($theSub[0], 7);
            echo $actualSub."<br />";
            $n += 1;
        }
    }
}
echo 'Number of sub-domains in clientMgr: '. $n . '<br />';

/*
 * Now get the list of unique subdomains from trans and store in an array
 * then
 * For each $theSub value (re: subdomain), 
 * Select all records for a subdomain
 * insert the clientMgr values into the records for the subdomains
 * export that subdomain set into a csv file on the local filesystem
 */
$usub = $database->basicSelect('DISTINCT school', trans);
//count entries in array of subdomains (1176)
$numSubs = count($usub);
echo '<br />Number of subs: '.$numSubs;
// Loop through the subdomains adding the clientMgr data to each record
// Then export the grouped records to the output file
foreach($usub as $subby=>$subs){
    foreach($subs as $theSub){
            echo " value: " .$theSub."<br />";

            for ($i=0; $i<=$numSubs; $i++){
                // select the distinct school based on $theSub
            }
    }
}
//    var_dump($earl);
//    exit;

//$idSchools = $database->basicSelect('*', 'trans', 'school="aatc"', $sort);
//$ofile="INTO OUTFILE '/Users/jonw/Desktop/ofile/'"; 
//$termBy="FIELDS TERMINATED BY ','";
$template = new foundationStructure();
$template->renderHeader("CDX login data merge");
?>
<table border="1" cellpadding="10">
  <thead>
    <tr>
      <th>DB ID #</th>
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
    
//    foreach($idSchools as $schoolID => $idSchool){
//      print '<tr>';
//      foreach ($idSchool as $field){
//        print '<td>' . $field . '</td>';
//      }
//      print '</tr>';
//    }
    ?>
  </tbody>
</table>