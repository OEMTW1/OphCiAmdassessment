
/* Module-specific javascript can be placed here */
var examination_print_url, module_css_path;

$(document).ready(function() {
	$('#et_save').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {

			disableButtons();
			return true;
		}
		return false;
	});



	$('#et_cancel').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/update\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/update/','/view/');
			} else {
				window.location.href = '/patient/episodes/'+et_patient_id;
			}
		}
		return false;
	});



	handleButton($('#et_print'),function(e) {
		OphCiAmdassessment_do_print();
		e.preventDefault();
	});

/*
	$('#et_print').unbind('click').click(function() {

		window.print_iframe.print();
		return false;

	});
*/

	$('#et_deleteevent').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});

	$('#et_canceldelete').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/delete/','/view/');
			} else {
				window.location.href = '/patient/episodes/'+et_patient_id;
			}
		} 
		return false;
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class');
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});



	// EJM (10/08/2015) show/hide the treatment drug fields
	$(this).delegate('#Element_OphCiAmdassessment_TreatmentPlan_tp_left', 'change', function(e) {

		var count_as_treatment = false;
		var thePK = $('#Element_OphCiAmdassessment_TreatmentPlan_tp_left').val();
		$('#Element_OphCiAmdassessment_TreatmentPlan_tp_left').find('option').each(function() {
			if ($(this).attr('value') == thePK) {
				if ($(this).attr('count_as_treatment') == "1") {
					count_as_treatment = true;
				}
			}
		});

		if ($('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_left').is(':visible')) {
			if (! count_as_treatment){
				$('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_left').slideUp().find('select').each(function(e) {
					$(this).val('');
				});
			}
		} else {
			if (count_as_treatment){
				$('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_left').slideDown().find('select').each(function(e) {
					$(this).val('');
				});
			}
		}
	});

	$(this).delegate('#Element_OphCiAmdassessment_TreatmentPlan_tp_right', 'change', function(e) {

		var count_as_treatment = false;
		var thePK = $('#Element_OphCiAmdassessment_TreatmentPlan_tp_right').val();
		$('#Element_OphCiAmdassessment_TreatmentPlan_tp_right').find('option').each(function() {
			if ($(this).attr('value') == thePK) {
				if ($(this).attr('count_as_treatment') == "1") {
					count_as_treatment = true;
				}
			}
		});

		if ($('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_right').is(':visible')) {
			if (! count_as_treatment){
				$('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_right').slideUp().find('select').each(function(e) {
					$(this).val('');
				});
			}
		} else {
			if (count_as_treatment){
				$('#div_Element_OphCiAmdassessment_TreatmentPlan_tp_drug_right').slideDown().find('select').each(function(e) {
					$(this).val('');
				});
			}
		}
	});








	/**
	 * Populate description from eyedraw
	 */
	$('#event_display').delegate('.ed_report', 'click', function(e) {
		var element = $(this).closest('.element');

		// Get side (if set)
		var side = null;
		if ($(this).closest('[data-side]').length) {
			side = $(this).closest('[data-side]').attr('data-side');
		}

		// Get eyedraw js object
		var eyedraw = element.attr('data-element-type-id');
		if (side) {
			eyedraw = side + '_' + eyedraw;
		}
		eyedraw = window['ed_drawing_edit_' + eyedraw];

		// Get report text and strip trailing comma
		var text = eyedraw.report();
		text = text.replace(/, +$/, '');

		// Update description
		var description = 'description';
		if (side) {
			description = side + '_' + description;
		}
		description = $('textarea[name$="[' + description + ']"]', element).first();
		if (description.val()) {
			text = description.val() + ", " + text.toLowerCase();
		}
		description.val(text);
		description.trigger('autosize');

		// Update diagnosis
		var code = eyedraw.diagnosis();
		var diagnosis_id = 'diagnosis_id';
		if (side) {
			diagnosis_id = side + '_' + diagnosis_id;
		}
		diagnosis_id = $('input[name$="[' + diagnosis_id + ']"]', element).first();
		diagnosis_id.val(code);

		e.preventDefault();
	});

	/**
	 * Clear eyedraw
	 */
	$('#event_display').delegate('.ed_clear', 'click', function(e) {
		var element = $(this).closest('.element');

		// Get side (if set)
		var side = null;
		if ($(this).closest('[data-side]').length) {
			side = $(this).closest('[data-side]').attr('data-side');
		}

		// Get eyedraw js object
		var eyedraw = element.attr('data-element-type-id');
		if (side) {
			eyedraw = side + '_' + eyedraw;
		}
		eyedraw = window['ed_drawing_edit_' + eyedraw];

		// Reset eyedraw
		eyedraw.deleteAllDoodles();
		eyedraw.deselectDoodles();
		eyedraw.drawAllDoodles();

		e.preventDefault();
	});


});

/**
 * partner function to unmaskFields, will empty the input fields in the given element, ignoring
 * fields that match the given selector in ignore
 *
 * @param element
 * @param ignore
 */
function maskFields(element, ignore) {
	if (element.is(':visible')) {
		var els = element.find('input, select, textarea');
		if (ignore != null) {
//			els = els.filter(':not('+ignore+')');
		}
		els.each( function() {
			if ($(this).attr('type') == 'radio') {
				$(this).data('stored-checked', $(this).prop('checked'));
			}

			$(this).data('stored-val', $(this).val());
			$(this).val('');
			$(this).prop('disabled', true);

		});
		element.hide();
	}
}

/**
 * partner function maskFields, will set values back into input fields in the given element that have been masked,
 * ignoring fields that match the given selector in ignore
 *
 * @param element
 * @param ignore
 */
function unmaskFields(element, ignore) {
	if (!element.is(':visible')) {
		var els = element.find('input, select, textarea');
		if (ignore != null && ignore.length > 0) {
			els = els.filter(':not('+ignore+')');
		}
		els.each( function() {
			if ($(this).attr('type') == 'radio') {
				$(this).prop('checked', $(this).data('stored-checked'));
			}
			else {
				$(this).val($(this).data('stored-val'));
			}
			$(this).prop('disabled', false);
		});
		element.show();
	}
}


function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

// Global function to route eyedraw event to the correct element handler
function eDparameterListener(drawing) {
	var doodle = null;
	if (drawing.selectedDoodle) {
		doodle = drawing.selectedDoodle;
	}
	var element_type = $(drawing.canvasParent).closest('.element').attr('data-element-type-class');
	if (typeof window['update' + element_type] === 'function') {
		window['update' + element_type](drawing, doodle);
	}
}

function OphCiAmdassessment_do_print() {
	printIFrameUrl(OE_print_url, null);
}

