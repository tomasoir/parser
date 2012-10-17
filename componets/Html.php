<?php
class Html
{
    private static $_optionarray;
    private static $_optionarray2;	
	
 public static function setOption($option,$option2=null) {
    self::$_optionarray=$option;
	if ($option!=null) self::$_optionarray2=$option2;
 } 
 public static function getOption() {
    return self::$_optionarray;
 } 
  public static function getOption2() {
    return self::$_optionarray2;
 } 
    //output html tags
	public static function htmltag($tag,$htmlOptions=array(),$content=false,$closeTag=true)	{
	
		foreach($htmlOptions as $name=>$value)
				$htmlOption .= ' ' . $name . '="' . $value . '"';
			
		
		$html='<' . $tag . $htmlOption;
		if($content===false)
			return $closeTag ? $html.' />' : $html.'>';
		else
			return $closeTag ? $html.'>'.$content.'</'.$tag.'>' : $html.'>'.$content;
	}

    //output html begin form tag
	public static function beginForm($action='',$method='post',$htmlOptions=array()){
		$htmlOptions['action']=$action;
		$htmlOptions['method']=$method;
		$form=self::htmltag('form',$htmlOptions,false,false);
		return $form;
	}
    //output html end form tag
	public static function endForm(){
		return '</form>';
	}
	// Loading files
	public static function rendered($url,$option=array(),$option2=array()){
	            self::$_optionarray=$option;
				self::$_optionarray2=$option2;
				$loadfile=DIR_CATALOG.$url;
		        if (file_exists($loadfile)) include($loadfile);
				
	}
    //redirect url for loading new page
	public static function rendirect($url){
	     
		       header("Location: {$url}");
               exit;
	}
	//output html text field tag
	public static function textField($name,$value='',$option=array()) {
		$option['name']=$name;
		$option['type']='text';
		$option['value']=$value;
		return self::htmltag('input',$option);
	}
	
	//output html hidden field tag
	public static function hiddenField($name,$value='',$option=array()) {
		$option['name']=$name;
		$option['type']='hidden';
		$option['value']=$value;
	    return self::htmltag('input',$option);
	}
	//output html submmit button tag
	public static function submitButton($name,$value='',$option=array()) {
        $option['name']=$name;
		$option['type']='submit';
		$option['value']=$value;
	    return self::htmltag('input',$option);
   }
   	//output html button tag
	public static function Button($name,$value='',$option=array()) {
        $option['name']=$name;
		$option['type']='button';
		$option['value']=$value;
	    return self::htmltag('input',$option);
   }
   	
	//output html link field tag
   public static function linkField($text,$url='#',$option=array()) {
        $option['href']=$url;
   		return self::htmltag('a',$option,$text);
	}
	// Remove line feeds, carriage returns, spaces and tabs
	public static function setClear($data) {
	   $dataClear=preg_replace("~[\s\n\r\t]+~", " ",$data);
	   return trim($dataClear);
	}
}