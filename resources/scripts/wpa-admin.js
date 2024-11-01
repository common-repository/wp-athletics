/*
 * Javascript functions for WPA Admin.
 */


WPA.Admin = {
		
	/**
	 * Saves the admin settings
	 */
	saveSettings: function(callbackFn) {
		
		var data = {
			language: jQuery('#setting-language').val(),
			disableSqlView: jQuery('#setting-disable-sql-view').val(),
			theme: jQuery('#setting-theme').val(),
			recordsMode: jQuery('#setting-records-mode').val(),
			clubName: jQuery('#club-name').val(),
			defaultUnit: jQuery('#setting-default-unit').val(),
			submitEvents: jQuery('#setting-allow-submit-events').val(),
			enableNonWPA: jQuery('#setting-non-wpa-pages').val(),
			action: 'wpa_admin_save_settings'
		}
		
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: data,
			success: callbackFn
		});
	},
	
	/**
	 * Recalculates age grades for all users
	 */
	recalculateAgeGrades: function(callbackFn) {
		jQuery(WPA.Admin.ageGradeConsole).html('Recalculating...');
		jQuery(WPA.Admin.ageGradeConsole).attr('count', '0');
		
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_admin_all_athletes'
			},
			success: function(results) {
				var resultCount = 0;
				jQuery(results).each(function(i, result) {
					if(result.gender) {
						WPA.Admin.updateUserAgeGrade(result.id, result.dob, result.gender, result.name, function(resultsUpdated) {
							if(resultsUpdated) {
								current = parseInt(jQuery(WPA.Admin.ageGradeConsole).attr('count'));
								current+=resultsUpdated;
								jQuery(WPA.Admin.ageGradeConsole).attr('count', current);
								jQuery(WPA.Admin.ageGradeConsole).html(current + ' results updated');
							}
						});
					}
				});
			}
		});
	},
	
	/**
	 *  Operation to calculate and save the age grade value for each users result
	 */
	updateUserAgeGrade: function(userId, dob, gender, name, callbackFn) {
		jQuery.ajax({
			type: 'post',
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_admin_all_results_for_athlete',
				id: userId
			},
			success: function(results) {
				var count = 0;
				if(results) {
					var updateString = '';
					jQuery.each(results, function(i, result) {
						var timeMillis = result.time;
						var distanceMeters = result.distance_meters;

						// calculate agr grade %
						var age = WPA.calculateAthleteAgeGradeAgeForResult(result.event_date, result.age_category);
						var ageGrade = WPA.AgeGrade.calculate(gender, age, (parseInt(distanceMeters) / 1000), (parseInt(timeMillis) / 1000));
						if(ageGrade > 0) {
							updateString += result.id + '|' + ageGrade + ',';
							count++;
						}
					});
				}

				if(updateString != '') {
					jQuery.ajax({
						type: 'post',
						url: WPA.Ajax.url,
						data: {
							action: 'wpa_update_age_grades',
							data: updateString,
							id: userId
						}
					})	
				}
				callbackFn(count);
			}
		});
	},
	
	/**
	 * Forces update of tables, view and indexes
	 */
	updateDatabase: function() {
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_admin_update_db'
			},
			success: function(result) {
				alert('Finished');
			}
		});
	},
	
	/**
	 * globals for storing checked records
	 */
	selectedRecords: [],
	selectedResultCount: 0,

	/**
	 * Wrapper event for selectRecordToggle() to allow it be called explitly
	 */
	selectRecordToggleWrapper: function() {
		WPA.Admin.selectRecordToggle(this);
	},
	
	/**
	 * Show the edit athlete changes
	 */
	displayEditAthlete: function(id, dob, name, gender, email) {
		jQuery('#editAthleteName').val(name);
		jQuery('#editAthleteEmail').val(email);
		jQuery('#editAthleteGender').val(gender);
		jQuery('#editAthleteId').val(id);
		jQuery('#editAthleteDob').val(dob != 'null' ? dob : '');
		jQuery('#edit-user-dialog').dialog('open');
	},
	
	/**
	 * Listener for when an checkbox input on an admin datatable is checked/unchecked
	 */
	selectRecordToggle: function(obj) {
		var id = jQuery(obj).attr('record-id');
		var resultCount = parseInt(jQuery(obj).attr('result-count'));
	
		if(jQuery(obj).prop('checked')) {
			WPA.Admin.selectedRecords.push(id);
			WPA.Admin.selectedResultCount += resultCount;
		}
		else {
			WPA.Admin.selectedRecords.splice( jQuery.inArray(id, WPA.Admin.selectedRecords), 1 );
			WPA.Admin.selectedResultCount -= resultCount;
		}
		WPA.Admin.toggleSelectOptions();
	},

	/**
	 * For toggling all checkboxes on an admin datatable
	 */
	toggleSelectOptions: function() {
		if(WPA.Admin.selectedRecords.length) {
			jQuery('.wpa-select-options').show();
		}
		else {
			jQuery('.wpa-select-options').hide();
		}
	},
	
	/**
	 * Resets the checkbox select globals
	 */
	resetSelectValues: function() {
		WPA.Admin.selectedRecords = [];
		WPA.Admin.selectedResultCount = 0;
		WPA.Admin.toggleSelectOptions();
	},
	
	/**
	 * Sets up a listener for the 'select all' checkbox in the datatable header
	 */
	configureSelectAllCheckboxes: function() {
		jQuery('#datatable-select-all').change(function() {
			WPA.Admin.selectedRecords = [];
			WPA.Admin.selectedResultCount = 0;

			var checked = jQuery(this).prop('checked');
			jQuery('table input[type=checkbox]').each(function() {

				var recordAttr = jQuery(this).attr('record-id');

				if (typeof recordAttr !== 'undefined' && recordAttr !== false) {
					jQuery(this).prop('checked', checked);
					WPA.Admin.selectRecordToggle(this);
				}
			});

			if(!checked) {
				WPA.Admin.selectedRecords = [];
				WPA.Admin.selectedResultCount = 0;
			}
		});
	}
}