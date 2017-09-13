/** 
JS SETTINGS
1) HAVE FUN
2) KEEP IT ORGANIZED
3) USE CONCISE COMMENTS
**/

// Controls the show/hide of the specialty forms on index.php
//$('#specialty_form').on('change', function () {
//	var currentTab = '#' + this.value;
//	//alert(currentTab);
//	$('.tab-pane').hide();
//	$(currentTab).show();
//});

// -------------------------------------------------------- DEPARTMENT: OMFS //
// OMFS conditional inputs for "Extractions"
// User selects tooth checkbox --> reveals followup radio button inputs
// User DEselects tooth --> unchecks relevant inputs and questions
$('[id^=conditional_inputs]').hide();      
$('[id^=checkbox]').click(function() {
	//var checkboxId = this.id
	var followupId = '#conditional_inputs' + $(this).val();
	var checkboxValue = $(this).val()
	
	if($(this).is(":checked")) {
		$('#conditional_inputs' + checkboxValue).show(300);
		//alert(checkboxValue + " and " + followupId);
	} else {
		$('#conditional_inputs' + checkboxValue).hide(300);
		// can customize the following for other fieldsets like this
		$(':input[name=graft'+checkboxValue+']').attr('checked', false);
		$(':input[name=closure'+checkboxValue+']').attr('checked', false);
	}
});

$('[id^=ortho_conditional_inputs]').hide();      
$('[id^=ortho_checkbox]').click(function() {
	//var checkboxId = this.id
	var followupId = '#ortho_conditional_inputs' + $(this).val();
	var checkboxValue = $(this).val();
	
	if($(this).is(":checked")) {
		$('#ortho_conditional_inputs' + checkboxValue).show(300);
		//alert(checkboxValue + " and " + followupId);
	} else {
		$('#ortho_conditional_inputs' + checkboxValue).hide(300);
		// can customize the following for other fieldsets like this
		//$(':input[name=ortho_bondchain'+checkboxValue+']').attr('checked', false);
	}
});

$('[id^=implants_conditional_inputs]').hide();      
$('[id^=implants_checkbox]').click(function() {

	var followupId = '#implants_conditional_inputs' + $(this).val();
	var checkboxValue = $(this).val();
	
	if($(this).is(":checked")) {
		$('#implants_conditional_inputs' + checkboxValue).show(300);
	} else {
		$('#implants_conditional_inputs' + checkboxValue).hide(300);
	} 
});


// Show/hide the Medicaid or Healthy MI insurance approval uploader
$('#approval_upload').hide();
$('input[name="insurance_check"]').on('change', function () {
	currentVal = this.value;
	if(currentVal == 'yes') {
		$('#approval_upload').show(200);
	} else {
		$('#approval_upload').hide(200);
	}
});

$('#general_dentist_restore_yes').hide();
$('#general_dentist_restore_no').hide();
$('input[name="general_dentist_restore"]').on('change', function () {
	currentVal = this.value;
	if(currentVal == 'yes') {
		$('#general_dentist_restore_yes').show(300);
		$('#general_dentist_restore_no').hide(300);
	} else {
		$('#general_dentist_restore_yes').hide(300);
		$('#general_dentist_restore_no').show(300);
	}
	
	//if(currentVal == 'yes') {
	//	$('#general_dentist_restore_yes').show(200);
	//	$('#general_dentist_restore_no').hide(200);
	//} else {
	//	$('#general_dentist_restore_no').show(200);
	//	$('#general_dentist_restore_yes').hide(200);
	//}
});


//$('input#insurance_yes').click(function() {
//	if($(this).is(":checked")) {
//		$("#approval_upload").show(300);
//	} else {
//		$("#approval_upload").hide(300);
//	}
//});
//$('input#insurance_no').click(function() {
//	alert('worked');
//});
// --- END DEPARTMENT: OMFS //



/** --------------------------------------------------------------- INDEX.PHP **/

// Stop Dept tab inputs from being in $_POST if they aren't the selected tab
// This helps eliminate clutter in the $_POST array

//  All dept tab inputs disabled by default
$('.tab-pane :input').attr("disabled", true);
// If dept tab selected
if ($('.nav-pills li').click(function() {
	// First disable all again to catch any previously selected dept
	$('.tab-pane :input').attr("disabled", true);
	var tabId = $(this).find('a').attr("href");
	// Then enable the inputs of the currently selected tab
	$(tabId + ' :input').attr("disabled",false);
	
}));


