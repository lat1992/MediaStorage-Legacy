$( document ).ready(function() {

	    // CONTENT DIV CHANGE

	    $('.video_content').click(function(){

	    	$('#content_display_div').html($(this).children().html());

	    })

	    // OVERLAY

	    $('.add_action').click(function(){
	    	$(this).jOverlay();
	    })

	    // OVERLAY OPTION CHANGES

	    $(document).on('change', '#usage_select', function(e) {

    		$("#dynamic_form").empty();

	    	// WATCHING_FILE
	    	if (this.options[e.target.selectedIndex].value == 2) {

	    		$("#dynamic_form").html(
	    			'<label>Langage : </label> ' +
	    			'<select name="language">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>GRB</option>' +
	    			'</select><br />'
	    		);
	    	}

	    	// CUT_FILE
	    	if (this.options[e.target.selectedIndex].value == 3) {

	    		$("#dynamic_form").html(
	    			'<label>Codec : </label> ' +
	    			'<select name="codec">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>MPEG2</option>' +
	    				'<option>DV</option>' +
	    			'</select><br />' +

	    			'<label>Profil : </label> ' +
	    			'<select name="codec">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>720x576 | 15 Mbits/s</option>' +
	    				'<option>720x576 | 50 Mbits/s</option>' +
	    			'</select><br />' +

	    			'<label>Langage : </label> ' +
	    			'<select name="langage">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>GRB</option>' +
	    			'</select><br />' +

	    			'<label>TC in : </label> ' +
	    			'<input type="text" name="tc_in" /><br />' +

	    			'<label>TC out : </label> ' +
	    			'<input type="text" name="tc_out" /><br />'
	    		);
	    	}

	    	// CUT_FILE
	    	if (this.options[e.target.selectedIndex].value == 4) {

	    		$("#dynamic_form").html(
	    			'<label>Codec : </label> ' +
	    			'<select name="codec">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>MPEG2</option>' +
	    				'<option>DV</option>' +
	    			'</select><br />' +

	    			'<label>Profil : </label> ' +
	    			'<select name="codec">' +
	    				'<option>- Choisissez -</option>' +
	    			'</select><br />' +

	    			'<label>Langage : </label> ' +
	    			'<select name="langage">' +
	    				'<option>- Choisissez -</option>' +
	    				'<option>GRB</option>' +
	    			'</select><br />'
	    		);
	    	}
	    })
});