<?php 
class MySQL {

 private $_table;
 private $_where;
 
 private $_savecolumns;
 private $_savevalue;

 private $_selectColums;

 
 //set table
	public function setTable($table){
	    $this->_table=$table;
		return $this;
	}

    // set where  update values sql request
	public function setWhere($where){  
		if (is_null($where) || empty($where)) {
            return $this;
        }
		$columns="";

		foreach ($where as $column => $value) {
		  if (!empty($value)) {
			if ($columns=="") {
			  $columns.= $column." = '".$value."'"; 
			}
			else
			{
			  $columns.= "  and ".$column." = '".$value."'";
			}
		  }	  
		}
		$this->_where=$columns;
		return $this;
    }

    //find all records in database 
	public function findAll($num_rows=false) {
    		if (empty($this->_selectColums)){
				$this->_selectColums=' * ';
			} 	
			$sql = 'SELECT '.$this->_selectColums.' FROM '. $this->_table;
			
			if (!is_null($this->_where) && !empty($this->_where))
                $sql .= ' WHERE '.$this->_where;
	
		$data=array();
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			 $data[]=$row; 	
			}
		
	    unset($this->_table,$this->_where, $this->_selectColums);
		return  $data;	    
    }
	
	
    
	 //find  records in database 
	public function find() {
       
	    $sql = 'SELECT * FROM '.$this->_table;
		
		if (!is_null($this->_where) && !empty($this->_where))
		    $sql.= ' WHERE '.$this->_where; 
		
 
	    $result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		unset($this->_table,$this->_where);
		return  $row;	    
    }
	
	 //find all  num rows
	public function findNumRows() {
			$sql = 'SELECT * FROM '. $this->_table;
			
			if (!is_null($this->_where) && !empty($this->_where))
                $sql .= ' WHERE '.$this->_where;
	
		$data=array();
		$result = mysql_query($sql);
		$data= mysql_num_rows($result);      
		
	    unset($this->_table,$this->_where, $this->_selectColums);
		return  $data;	    
    }


   
	//deleted records in database  
	public function delete() {
		if ($this->_where!='') {
			$sql = 'DELETE FROM '.$this->_table.' WHERE '.$this->_where;
			
			mysql_query($sql) or die(DATABASE_DELETED_ERROR);
		    return true;
		}
		else{
		    die(DATABASE_DELETED_ERROR);
			return false;
		}
		unset($this->_table,$this->_where);
		 
	}



  //Set save value
 public function setSaveValue($data){
   
    $values='';
	$columns='';
	foreach ($data as $column => $value) {
		if ($columns=="") {
		  $columns.=$column; 
  		  $values.="'".$value."'"; 
		}
		else
		{
		  $columns.=", ".$column; 
		  $values.=", '".$value."'"; 
		}
			  
	} 
	$this->_savevalue=$values;
	$this->_savecolumns=$columns;
	return $this;
 }
   //Save records in database
   public function save() {

		$sql = 'INSERT INTO '.$this->_table.'('.$this->_savecolumns.')  VALUES ('.$this->_savevalue.')';
		//echo  $sql;
		if (!mysql_query($sql)) { throw new Exception(DATABASE_UPDATE_ERROR);}
		
		unset($this->_table,$this->_savecolumns,$this->_savevalue);
		return true;
	}


      
	//set select columns in data base
	public function setSelect($columns){
	    $this->_selectColums=$columns;
		return $this;
	}

		//check POST request for XSS SQL injection
	public function getPost($name='')
	{
	    
		$name=$this->check_XSS_SQL_injection($_POST[$name]);
		return empty($name) ? false : $name;
	}
	
		//check POST request for XSS SQL injection
	public function getGet($name)
	{
	    $name=$this->check_XSS_SQL_injection($_GET[$name]);
		return empty($name) ? false : $name;
	}
	
	// protected XSS and SQL injection  attacks
   public function check_XSS_SQL_injection($value) {
    if (get_magic_quotes_gpc()) 
        $value = stripslashes($value);
    
    if (!is_numeric($value)) 
        $value = mysql_real_escape_string($value);
	   
    return $value;
}

}      