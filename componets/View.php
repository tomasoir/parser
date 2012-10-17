<?php
class View extends Html
{
	function generate($template, $data = null)
	{
		
        
		if ($data!=null) { 
		    self::setOption($template,$data);  
		}else {
			self::setOption($template);  
		}		
		
		include 'modules/'.DEFAULT_CONTROLER.'/views/template.php';
	}
}
?>