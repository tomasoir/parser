<?php 
class Model extends MySQL {

 protected static $_instance; //protected with Singlton
 
 //Creat once obj class
 public static function getInstance(){  
    if (!is_object(self::$_instance)) 
	     self::$_instance = new self;
	return self::$_instance;	 
 }
 
 //Connect once to database
 private  function __construct() { 
 try {  
    
	 if (!mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD)) { throw new Exception(DATABASE_CONNECT_ERROR); }
      $this->_dbconnect=mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD); 
	 if (!mysql_select_db(DB_DATABASE)) { throw new Exception(DATABASE_SELECT_ERROR);  }
 
 
    } catch (Exception $e) {
        echo 'Error :'.$e->getMessage() . '<br />';
     
        exit();
  }
   
 }
   //We forbid object cloning 
   private function __clone() { 
   }
        
   //We forbid object cloning 
   private function __wakeup() {
   }

}
?>