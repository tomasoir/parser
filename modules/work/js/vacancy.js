  //var  post_id=$("#post_id").val();
//  
//  var commentusername=$("#commentusername").val();
//  var username_pattern=/^[a-zA-Z0-9]+$/;
//  if  (username_pattern.test(commentusername)==false) { error='User name is specified in the wrong format.<br>'; }
//  
//  var commentemail=$("#commentemail").val();
//  var email_pattern=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,4}$/;
//  if  (email_pattern.test(commentemail)==false) { error+='Email is set in the incorrect format.<br>'; }
//
//
//  var commenwebsite=$("#commenwebsite").val();
//    var website_pattern=/^((https?|ftp)\:\/\/)?([a-z0-9]{1})((\.[a-z0-9-])|([a-z0-9-]))*\.([a-z]{2,4})$/;
//  if  (website_pattern.test(commenwebsite)==false) { error+='URL is set in the incorrect format.<br>'; }
//  
//  var commenttext=$("#commenttext").val();
//  if  (commenttext=='') { error+='Content is empty.<br>'; }
//  
//  
//  if (error!='') { 
//       $('#commenterror').empty().append(error);
//  } else {
//	   $('#commenterror').empty();

//comment validate
function SearchVacancy() {
  var error='';	
  

  var searchid=$("#id").val();
  var searchurl=$("#url").val();

		$.ajax({
		  type: 'POST',
		  url: 'classes/addcomment.php',
		  data: 'id='+searchid+'&url='+searchurl,
		  success: function(data){
			if (data=='') {
				new_comment="<div class='comments' ><p>"+$('#commenttext').val()+"</p></div>";
				$('#postoutput').append(new_comment);
				$("#commentusername").val('');
				$("#commentemail").val('');
				$("#commenwebsite").val('');
				$("#commenttext").val('');	
			}
            $('#commentoutput').html(data);			
		  }
		});

 
 }
	$(document).ready(function(){
		$("#Searchbutton").click(SearchVacancy);
	});										   