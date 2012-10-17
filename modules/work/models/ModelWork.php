<?php
//echo 'ModelWork  ok';
class ModelWork extends Model
 
{
  
 

 public  function __construct() { 
    
     self::getInstance();
  }

 public static function attributeLabels() {
	return array(
		'id'=>'id',
		'url'=>'url',
		'Location'=>'Location',
		'Budget_range'=>'Budget range',
		'Starting_Date'=>'Starting Date',
		'Length_of_job'=>'Length of job',
		'Posting_date'=>'Posting date',
		'Required_Skills'=>'Required Skills',
		'Required_tools'=> 'Required tools',
		'Description'=>'Description',
    );  	
}
    
   

}
?>