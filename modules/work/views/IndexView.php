  <?php echo Html::beginForm(); ?>
  <?php $AllVacancy=Html::getOption2(); 
		
		$Labels=ModelWork::attributeLabels();
		//print_r($Labels);
  ?>
  
  <h1>Vacancy Add, View and Delete</h1> 
  <table class="tableview">  
    <tr>
		<td><?php echo Html::linkField('Parsing',"/Work/Parsing/");?></td>
    </tr>
    <tr>
	
	<?  $searchcol=''; 
	    foreach ($Labels as $colums=>$value): 	
	       echo '<th>'.$value.'</th>';
		   $searchcol.='<td>'.Html::textField($colums,'',array('id'=>$colums)).'</td>';
	    endforeach;
	?>
	<th></th>
    </tr>	
	<tr>
	        <?php echo $searchcol;?>
		<td><?php echo Html::submitButton('Searchsubmit','Search',array('id'=>'Searchbutton',)); ?>       </td>
	 </tr>	 
		  <?php  
	
	if ($AllVacancy!='') {
		foreach ($AllVacancy as $All):  
		echo "<tr>";
		  foreach ($All as $colums=>$value): 
	     		echo "<td>$value</td>"; 
         endforeach;	
		 echo "<td>".Html::linkField('Delete',"/Work/Delete/".$All['id'],array('id'=>$id,'rel'=>'del',))."</td>
				</tr>"; 
        endforeach;			 	
	} 
		 ?>
       </table>
	   
  <?php echo Html::endForm();?>