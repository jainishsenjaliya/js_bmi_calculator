/*
 *  (c) 2015 Jainish Senjaliya <jainishsenjaliya@gmail.com>
 *  All rights reserved 
*/

	function BmiValidate(id) {

		var cValids = 0;

		jQuery("#"+id+" .validate").removeClass("error");
		
		jQuery("#"+id+" .validate").each(function(){

			if(trim(jQuery(this).val())==''){
				jQuery(jQuery(this)).addClass("error");
				jQuery(this).attr("placeholder",jQuery(this).attr('mendatory_message'));
				cValids = 1;
			}
		});

		if(cValids == 0) { 
			jQuery(".formLoading").css("display","block");
			return true;
		}else {
			return false;
		}
	}

	function trim(val){
		return jQuery.trim(val);	
	}

jQuery(document).ready(function() {

});