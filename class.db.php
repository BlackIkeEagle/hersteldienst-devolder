<?php
/**
 * Database Input and Output CLASS
 * at the time the class is mysql specific, but this might be changed in the
 * future, but because we already have a class, the implementation of the top
 * site will not be interfeared with
 *
 * @author Ike Devolder <devolderike@yahoo.com>
 * @version $Id, class.db , v1.0.6 , 2007/02/19 - 2007/04/17
 */ 

class db{
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_base;

  private $db_link;

  /**
   * Constructor
   *
   * @param  string  hostname of the database server
   * @param  string  username to connect to the database server
   * @param  string  password to connect to the database server
   * @param  string  database to use on the server
   *
   * remark: if one parameter is given, all must be given, so all or nothing
   *
   * @return bool    true if ok, false if error
   */
  function __construct($host=false,$user=false,$pass=false,$base=false) {
    if($host && $user && $pass && $base){
      $this->db_host = $host;
      $this->db_user = $user;
      $this->db_pass = $pass;
      $this->db_base = $base;
    } else {
      return false;
    }
    if($this->db_connect()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * function db_connect
   * this function creates the handle to the database-server and database
   *
   * @return bool   true if ok, false if error
   */
  private function db_connect() {
    if(!$this->db_link = @mysql_connect($this->db_host,$this->db_user,$this->db_pass)){ return false; };
    if(!@mysql_select_db($this->db_base)){ return false; }
    return true;
  }

  /**
   * function db_createsql
   * this function creates the correct sql string from the input given
   *
   * @param string            
   * @param string or array   
   * @param array             
   * @param string            
   * @param string            
   *
   * if the kind is select there can be more tables, otherwise not
   * if the kind is insert or update order is not needed at all
   * 
   * @return string   a valid sql string
   */
  private function db_createsql($kind,$tables,$fields=false,$where=false,$order=false,$limit=false) {
    if(!$kind){ return false; }
    if(!$tables){ return false; }
    $sql="";
    $kind = strtolower($kind);
    switch($kind){
    case "select":
      // SELECT * FROM tbl WHERE blabla ORDER BY qsd,qsfd
      $sql .= "SELECT ";
      if($fields){
        foreach($fields as $field){
          $sql .= $field.",";
        }
        $sql = rtrim($sql,",");
        $fields = null;
      } else {
        $sql .= "*";
      }
      $sql .= " FROM ";
      if(is_array($tables)){
        foreach($tables as $table){
          $sql .= $table.",";
        }
      } else {
        $sql .= $tables;
      }
      $tables = null;
      $sql = rtrim($sql,",");
      if($where){
        $sql .= " WHERE $where";
      }
      if($order){
        $sql .= " ORDER BY $order";
        $order = null;
      }
      if($limit){
        $sql .= " LIMIT $limit";
        $limit = null;
      }
      break;
    case "insert":
      // INSERT INTO tbl (fields) VALUES (values)
      $sql .= "INSERT INTO $tables";
      $tables = null;
      if($fields){
        $flds="";
        $values="";
        foreach($fields as $field => $value){
          $flds .= "`".$field."` , ";
          $values .= "'".$value."' , ";
        }
        $flds = rtrim($flds," ,");
        $values = rtrim($values," ,");
        $sql .= " ( $flds ) VALUES ( $values )";
        $fields = null;
        $flds = null;
        $values = null;
      } else {
        return false;
      }
      break;
    case "update":
      // UPDATE tbl SET field1=value1 , field2=value2 WHERE where
      $sql .= "UPDATE $tables SET ";
      $tables = null;
      if($fields){
        foreach($fields as $field => $value){
          $sql .= "`".$field."` = '".$value."' , ";
        }
        $sql = rtrim($sql," ,");
        $fields = null;
      } else {
        return false;
      }
      if($where){
        $sql .= " WHERE ".$where;
        $where = null;
      } else {
        return false;
      }
      break;
    case "delete":
      // DELETE FROM tbl WHERE blabla
      $sql .= "DELETE FROM $tables WHERE $where";
      $tables = null;
      $where = null;
      break;
    default: 
      return false;
      break;
    }
    $kind = null;
    return $sql;
  }

  /**
   * function db_fieldinfo
   * gives information about the fields of a given table
   *
   * @param string   tablename    (required)
   *
   * @return array   fieldinformation ( name => type ) 
   */
  public function db_fieldinfo($table) {
    if(!$table) { return false; }
    $sql = $this->db_createsql("select",$table);
    $fields=array();
    $result = @mysql_query($sql,$this->db_link);
    if(!$result) { return false; }
    for($i=0;$i<mysql_num_fields($result);$i++){
      if($meta=mysql_fetch_field($result)){
        $fields[$meta->name]=$meta->type;
      }
    }
    mysql_free_result($result);
    $table = null;
    return $fields;
  }

  /**
   * function db_select
   * get information from table or tables
   *
   * @param string or array  table or tables   (required)
   * @param array  fields                      (optional)
   * @param string where statement             (optional)
   * @param string order result                (optional)
   * @param string limit result                (optional)
   *
   * @return array   data returned out of the database 
   */
  public function db_select($tables,$fields=false,$where=false,$order=false,$limit=false) {
    if(!$tables){ return false; }
    $sql = $this->db_createsql("select",$tables,$fields,$where,$order,$limit);
    $tables = null;
    $fields = null;
    $where = null;
    $order = null;
    $limit = null;
    $out=array();
    if(!$result = @mysql_query($sql,$this->db_link)) { return false; }
    if(mysql_num_rows($result) > 0) {
      while($row = mysql_fetch_assoc($result)){
        $out[] = $row;
      }
    } else { return false; }
    mysql_free_result($result);
    return $out;
  }

  /**
   * function db_insert
   * inserts a new row in a table
   *
   * @param string   only one table here        (required)
   * @param array    all the fields nescecary   (required)
   *
   * @return bool    true when succeeded
   */
  public function db_insert($tables,$fields) {
    if(!$tables || !$fields){ return false; }
    $sql = $this->db_createsql("insert",$tables,$fields);
    $tables = null;
    $fields = null;
    if(!$result = @mysql_query($sql,$this->db_link)){ return false; }
    return true;
  }

  /**
   * function db_update
   * update a specific row
   *
   * @param string   only one table                  (required)
   * @param array    fields to be updated            (required)
   * @param string   specify where to put the data   (required)
   *
   * @return bool    true when succeeded
   */
  public function db_update($tables,$fields,$where) {
    if(!$tables || !$fields || !$where){ return false; }
    $sql = $this->db_createsql("update",$tables,$fields,$where);
    $tables = null;
    $fields = null;
    $where = null;
    if(!$result = @mysql_query($sql,$this->db_link)){ return false; }
    return true;
  }

  /**
   * function db_delete
   * delete specific row from a certain table
   *
   * @param string   only one table                   (required)
   * @param string   specify the location to delete   (required)
   *
   * @return bool    true when succeeded
   */
  public function db_delete($tables,$where) {
    if(!$tables || !$where){ return false; }
    $sql = $this->db_createsql("delete",$tables,false,$where);
    $tables = null;
    $where = null;
    if(!$result = @mysql_query($sql,$this->db_link)){ return false; }
    return true;
  }

  /**
   * function db_close
   * close the connection with the database and the databaseserver
   *
   * @return bool   true when succeeded
   */
  private function db_close() {
    if(!@mysql_close($this->db_link)){ return false; }
    return true;
  }

  /**
   * DESTRUCTOR
   * just calls the close function to disconnect from database
   */
  function __destruct() {
    if($this->db_close()){
      $this->db_host = null;
      $this->db_user = null;
      $this->db_pass = null;
      $this->db_base = null;
      $this->db_link = null;
    }
  }
}

?>
