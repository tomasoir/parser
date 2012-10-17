<?php

class ControllerWork extends Controller
{
    //////////////////////////
    public function actionIndex(){	
       	$ModelWork= new ModelWork;
	   if ($ModelWork->getPost('Searchsubmit')=='Search') {
	       $array=$_POST;
		   
		   $key = array_search('Search', $array);
		  if ($key !== false)
			{
				unset($array[$key]);
			}
			$ModelWork->setWhere($array);
			
		} 
			    
		$column=$ModelWork->setTable('work')
					      ->findAll();	
		$this->view->generate('IndexView.php',$column);
	}
	///////////////////////////////////
	public function actionParsing()	{	
       	$ModelWork= new ModelWork;
		$urlspider="http://www.freelance.com/en/search/mission";
		$url2="\/en\/mission\/view\/";

	    $html=$this->setVacancy($urlspider,true);
		preg_match_all("!<a[^>]+href=\"?'?({$url2}.*?\/.*?[^\"]*)\"?'?[^>]*>!is",$html,$linkUrl);

		for ($i=0; $i<count($linkUrl[1]); $i++) 
			$linkUrl[1][$i];
		$result = array_unique($linkUrl[1]);

		foreach ($result as $i=>$value) {
			$urlsite='http://www.freelance.com'.$value;
       		$spiderdate=$this->setVacancy($urlsite);
    		$ModelWork->setSaveValue($spiderdate)
					  ->setTable('work')
					  ->save();
		}
		Html::rendirect('/work/index/');	
	}
		

  
	////////////////////////////////////////
	private function setVacancy($url,$html2=false){
   	  
	   
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf8"));
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		

	   
	   $content=curl_exec($ch);
	   
	   if ($html2==true) return $content;
			
		
		
    preg_match_all("![^>]li>Location.*?<strong>(.*?)</strong>.*?<li>.*?Budget range.*?<strong>(.*?)</strong>.*?<li>.*?Starting Date.*?<strong>(.*?)</strong>.*?<li>.*?Length of job.*?<strong>(.*?)</strong>.*?<li>.*?Posting date.*?<strong>(.*?)</strong>.*?<li><span[^>]*>.*?Required Skills.*?</span>.*?<ul[^>]*>(.*?)</ul>.*?<li><span[^>]*>.*?Required tools.*?</span>.*?<ul[^>]*>(.*?)</ul>!is",$content,$linkUrl1, PREG_SET_ORDER); 
        

      $data=array();
	  $data[url]=$url;
	  foreach ($linkUrl1 as $val) {
		$data[Location]=Html::setClear($val[1]);
		$data[Budget_range]=Html::setClear($val[2]);
		$data[Starting_Date]=Html::setClear($val[3]);
		$data[Length_of_job]=Html::setClear($val[4]);
		$data[Posting_date]=Html::setClear($val[5]);
		$data[Required_Skills]=strip_tags(Html::setClear($val[6]));
		$data[Required_tools]=strip_tags(Html::setClear($val[7]));
		$data[Description]=strip_tags(Html::setClear($val[8]));
		//strip_tags
	}
    return $data;	
	}	

	///////////////////////////
	public function actionDelete(){
		  
		$id= Application::getId();
		$ModelWork= new ModelWork;
		if ($ModelWork->getPost('Del')) {
		    if ($ModelWork->getPost('Del')=='Yes'){
				$where=array('id'=>$id,);
				$ModelWork->setTable('work')
						  ->setWhere($where)
						  ->delete();
			}
			Html::rendirect('/work/index/');		
		}
	    

        $this->view->generate('DeleteView.php',$id);
	}
	////////////////////////////////////////
}
?>