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
			}else{ 
				if(!validate(jQuery(this).val())){
					jQuery(jQuery(this)).addClass("error");
					jQuery(this).attr("placeholder",jQuery(this).attr('valid_message'));
					jQuery(this).val("");
					cValids = 1;
				}
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

	function validate(s) {
		var rgx = /^[0-9]*\.?[0-9]*$/;
		return s.match(rgx);
	}

jQuery(document).ready(function() {

	jQuery(".validate").blur(function(){
		
		if(trim(jQuery(this).val())!=""){
			
			jQuery(this).removeClass("error");

			if(!validate(jQuery(this).val())){
				jQuery(jQuery(this)).addClass("error");
				jQuery(this).attr("placeholder",jQuery(this).attr('valid_message'));
				jQuery(this).val("");
				cValids = 1;
			}
		}else{
			jQuery(this).addClass("error");
			jQuery(this).attr("placeholder",jQuery(this).attr('mendatory_message'));
			jQuery(this).val("");
		}
	})

	jQuery(".validate").keyup(function(){
		
		if(trim(jQuery(this))!=""){
			jQuery(this).removeClass("error");
		}else{
			jQuery(this).addClass("error");
		}
	})

	jQuery(".successMessage").delay(9000).hide(500);
});