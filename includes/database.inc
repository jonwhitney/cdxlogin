<?php

/**
 * Class database -- An object for connecting to a database, and working with a database
 */

class database{

  /**
   * Construct function for establishing the database connection
   *
   * @param $settings
   */

  public function __construct($settings){
    if(isset($settings) && is_array($settings)){
      if(!mysql_connect($settings['server'],$settings['username'],$settings['password'])){ // Connect to MySQL
        throw new Exception('Settings did not result in a proper connect, error was: ' . mysql_error());
      }else{ // proceed if connected properly
        if(!mysql_select_db($settings['database'])){ // select the database
          throw new Exception('DB Connect worked. Unable to select specific database: ' . mysql_error());
        }else{
          return TRUE;
        }
      }
    }
  }

  /**
   * Destruct function for object. Closes MySQL connection.
   */
  public function __destruct(){
    mysql_close();
  }

  /**
   * Public method for performing basic selects on the DB
   *
   * @param $what array|string -- Field(s) to select from
   * @param $from string -- Table to select from
   * @param $where array|string -- Requirement(s) to add to statement
   * @param $intoOutFile file path -- path to file
   * @param $termBy -- fields terminated by
   */

  public function basicSelect($what, $from, $where = NULL, $orderBy = NULL, $intoOutFile = NULL, $termBy = NULL){
    $query = 'SELECT ';

    // Build the select line. Do multiple fields if array
    if(is_array($what)){
      foreach($what as $key => $field){
        $query .= '"'. $field . '"';
        // IF it's not the end, add a comma and a space
        if(end($what) !== $key){
          $query .= ', ';
        }
      }
    }else{ // Single item, only one field to get
      $query .= $what;
    }

    $query .= "\n"; //add a line ending
    // Build the from line
    $query .= 'FROM ';
    $query .= $from;
//    $query .= "\nLIMIT 1000";

    // Build the where functionality, possibly an array so foreach or do single
    if($where != null){
      $query .= ' WHERE ';
      if(is_array($where)){
        foreach($where as $key => $requirement){
          $query .= '"'. $requirement . '"';
          // IF it's not the end, add a comma and a space
          if(end($what) !== $key){
            $query .= ' AND ';
          }
        }
      }else{
        $query .= $where;
      }
    }

    // Build the orderby BY functionality
    if($orderBy != NULL){
      if(is_array($orderBy)){
              $query .= "\n";
        $query .= "ORDER BY " . $orderBy['field'] . " " . $orderBy['direction'];
      }else{ // Not an array, won't work
        return FALSE;
      }
    }
    
//    $query .= $intoOutFile;
//    $query .= $termBy;
//
    var_dump($query);
//    exit;

    // With built query, Execute and return results as an array.
    if($queryResults = mysql_query($query)){
      $output = array();
      while($row = mysql_fetch_array($queryResults, TRUE)){
//        $rowID = $row['id'];
//        var_dump($row);
//        exit;
//        unset($row['id']);
//        $output[$rowID] = $row;
        $output[] = $row;
      }

      return $output;
    }else{
      return FALSE;
    }
  }

  /**
   * Basic Delete function
   *
   * @param: String for table to delete from
   * @param: INT for ID to delete
   */
  public function basicDelete($table,$id){
    if(is_int($id)){ // Make sure ID is INT
      $query = 'DELETE FROM ';
      $query .= $table;
      $query .= "\n";
      $query .= 'WHERE id = ';
      $query .= $id;

      if($queryResults = mysql_query($query)){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }

  /**
   * A function for doing a basic insert
   *
   * @param $table -- String for what table to insert into
   * @param $data -- Array, matched values for Field => Value
   * @return bool -- Returns true or false for success
   */

  public function basicInsert($table, $data){
    if(is_array($data)){
      // Create field value par
      $fields = array();
      $values = array();
      // populate field and value
      foreach($data as $key => $value){
        $fields[] = $key;
        $values[] = $value;
      }

      //build query
      $query = 'INSERT INTO '. $table . "\n";
      $query .= '(';
      foreach($fields as $key => $field){
        $query .= $field;
        // IF it's not the end, add a comma and a space
        if(end($fields) !== $field){
          $query .= ', ';
        }
      }
      $query .= ')' . "\n";
      $query .= 'VALUES' . "\n" . '(';

      foreach($values as $key => $value){
        if($value != NULL){
          $query .= '"'. $value.'"';
        }else{
          $query .= 'NULL';
        }

        // IF it's not the end, add a comma and a space
        if(end($values) !== $value){
          $query .= ', ';
        }
      }
      $query .= ')';
      if($queryResults = mysql_query($query)){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }
}

