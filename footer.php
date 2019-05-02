<script>
function sendform(){
  //alert("Submitted");
  var email = jQuery(".email").val();
	
	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'EMAIL='+ email;
	
	//validations
	if(email=='')
	{
		//alert("Email is required.");
	}
	else
	{
	    //alert("submit");
		// AJAX Code To Submit Form.
		jQuery.ajax({
			type: "POST",
			url: "https://sweetcombchicago.com/wp-content/themes/basel-child/submit.php",
			data: dataString,
			cache: false,
			success: function(result){
				//alert(result);
			}
		});
	}
	return false;

}

</script>
