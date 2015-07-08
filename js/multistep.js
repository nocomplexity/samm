/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//jQuery noConflict wrapper added

jQuery(document).ready(function() {
	jQuery("#next").click(function(){
                        var current = jQuery(".active");
			var next = jQuery(".active").next("li");
                        //jQuery("#finish").show();
                        
			if(next.length>0) {
				jQuery("#"+current.attr("id")+"-field").hide();
				jQuery("#"+next.attr("id")+"-field").show();
				jQuery("#back").show();
				jQuery("#finish").hide();
				jQuery(".active").removeClass("active");
				next.addClass("active");                               
                                if(jQuery(".active").attr("id") == jQuery('#signup-step li:last-child').attr('id') ) {
					jQuery("#next").hide();
					jQuery("#finish").show();				
				}
			}
		});
                
	jQuery("#back").click(function(){ 
		var current = jQuery(".active");
		var prev = jQuery(".active").prev("li");
               
		if(prev.length>0) {
			jQuery("#"+current.attr("id")+"-field").hide();
			jQuery("#"+prev.attr("id")+"-field").show();
			jQuery("#next").show();
			jQuery("#finish").hide();
			jQuery(".active").removeClass("active");
			prev.addClass("active");
			if(jQuery(".active").attr("id") == jQuery('#signup-step li:first-child').attr('id')) {
				jQuery("#back").hide();			
			}
		}
	});
});

