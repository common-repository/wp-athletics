<?php
if ( $this->has_permission_to_manage() ) {
	global $current_user;
	$nonce = wp_create_nonce( $this->nonce );

?>
	<script type="text/javascript">

	WPA.Admin.viewLeaguePage = function() {
		window.open('<?= site_url() ?>?p=' + WPA.Admin.leaguePageId);
	}

	WPA.Admin.editEvent = function(id) {
		WPA.Admin.editEventMode = true;
		WPA.editEvent(id);
	}

	WPA.Admin.createEvent = function() {
		WPA.Admin.createEventMode = true;
		WPA.showCreateEventDialog();
	}
	
	WPA.Admin.loadLeagues = function(callbackFn) {
		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_get_leagues'
			},
			success: function(leagues) {
				WPA.toggleLoading(false);
				if(leagues) {
					jQuery('.wpa-league-select select').children().remove();
					jQuery('.wpa-league-select select').append('<option value="">' + WPA.getProperty('leagues_default_option') + '</option>');
					jQuery(leagues).each(function(i, league) {
						jQuery('.wpa-league-select select').append('<option value="' + league.id + '">' + league.name + '</option>');
					});
					if(callbackFn) callbackFn(leagues);
				}
				else {
					jQuery('.wpa-league-select select').append('<option value="">' + WPA.getProperty('leagues_empty_option') + '</option>');
				}
			}
		});
	}

	WPA.Admin.displayCreateLeague = function() {
		jQuery('input,select').removeClass('field-error');
		jQuery('#leagueId').val('');
		jQuery('#leagueName').val('');
		jQuery('#leagueDetails').val('');
		jQuery('#leagueRankBy').val('AGE_GRADE');
		jQuery('#leagueGender').val('');
		jQuery('#leagueAgeCategory').val('');
		jQuery('#leagueRule').val('ALL');
		
		jQuery('.league-item').hide();
		jQuery('.create-league').show();
		jQuery('.wpa-edit-league').show();
	}

	WPA.Admin.leagueSelected = function(id, callbackFn) {
		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_get_league_details',
				id: id
			},
			success: function(result) {
				WPA.toggleLoading(false);
				if(result && result.league) {
					WPA.Admin.displayEditLeague(result.league);
					if(callbackFn) callbackFn(league);
				}
			}
		});
	}

	WPA.Admin.displayEditLeague = function(league) {
		jQuery('input,select').removeClass('field-error');
		jQuery('.league-item').hide();
		jQuery('.edit-league').show();
		jQuery('.wpa-edit-league').show();

		if(league) {
			WPA.Admin.selectedLeagueId = league.id;
			jQuery('#leagueId').val(league.id);
			jQuery('#leagueName').val(league.name);
			jQuery('#leagueDetails').val(league.details);
			jQuery('#leagueRankBy').val(league.rank_by);
			jQuery('#leagueGender').val(league.gender);
			jQuery('#leagueAgeCategory').val(league.age_category);

			if(league.page_id) {
				jQuery('#leagueGeneratePageButton').hide();
				WPA.Admin.leaguePageId = league.page_id;
			}
			else {
				jQuery('#leagueViewPageButton').hide();
			}

			if(league.rule.indexOf('PARTIAL') === 0) {
				var pieces = league.rule.split(',');
				if(pieces.length == 2) {
					jQuery('#leagueRule').val(pieces[0]);
					WPA.Admin.selectedMinEvents = pieces[1];
				}
			}
			else {
				jQuery('#leagueRule').val(league.rule);
			}
			
			WPA.Admin.loadLeagueEvents();
			jQuery('#leagueRule').trigger('change');
		}
	}

	WPA.Admin.getLeagueRule = function() {
		var rule = jQuery('#leagueRule').val();

		if(rule == 'PARTIAL') {
			var num = jQuery('#leagueMinEvents').val();
			if(!num) {
				WPA.alertError(WPA.getProperty('leagues_error_invalid_participation_rule_no_events'));
				return false;
			}
			return (rule + ',' + num);
		}

		return rule;
	}

	WPA.Admin.saveLeague = function() {

		var rule = WPA.Admin.getLeagueRule();
		if(!rule) return;

		var id = jQuery('#leagueId').val();

		var params = {
			leagueName: jQuery('#leagueName').val(),
			leagueDetails: jQuery('#leagueDetails').val(),
			leagueRankBy: jQuery('#leagueRankBy').val(),
			leagueGender: jQuery('#leagueGender').val(),
			leagueAgeCategory: jQuery('#leagueAgeCategory').val(),
			leagueRule: rule,
			action: 'wpa_update_league'
		};

		if(id) {
			params['leagueId'] = id;
		}

		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: params,
			success: function(result) {
				WPA.toggleLoading(false);
				if(result && result.success) {
					if(result.leagueId && result.leagueId > 0) {
						WPA.Admin.loadLeagues(function() {
							jQuery('.wpa-league-select select option[value="' + result.leagueId + '"]').attr('selected', 'selected');
							WPA.Admin.leagueSelected(result.leagueId);
						});
					}
				}
			}
		});
	}

	WPA.Admin.deleteLeague = function(id) {
		jQuery("#delete-league-confirm-dialog").dialog({
	      resizable: false,
	      height:160,
	      title: WPA.getProperty('delete_league_title'),
	      modal: true,
	      buttons: {
	        "Delete": function() {
	          	jQuery( this ).dialog("close");
	          	WPA.toggleLoading(true);
	    		jQuery.ajax({
	    			type: "post",
	    			url: WPA.Ajax.url,
	    			data: {
		    			action: 'wpa_delete_league',
			    		id: id
	    			},
	    			success: function(result) {
	    				WPA.toggleLoading(false);
	    				if(result && result.success) {
	    					WPA.Admin.loadLeagues();
	    					jQuery('.wpa-edit-league').hide();
	    				}
	    				else {
		    				alert('There was a problem deleting the league');
	    				}
	    			}
	    		});
	        },
	        "Cancel": function() {
	          jQuery( this ).dialog( "close" );
	        }
	      }
		});
	}

	WPA.Admin.leagueFormValid = function() {
		var valid = true;
		jQuery('input,select').removeClass('field-error');
		
		if(jQuery('#leagueName').val() == '') {
			jQuery('#leagueName').addClass('field-error');
			valid = false;
		}
		return valid;
	}

	WPA.Admin.displayLeagueEvents = function(events, defaultValue) {
		// remove existing
		jQuery('#wpa-league-events-table tbody').children().remove();
		jQuery('#leagueMinEvents').children().remove();
		if(events) {
			jQuery(events).each(function(i, event) {
				jQuery('#wpa-league-events-table tbody').append(
					'<tr>' + 
						'<td><div class="datatable-icon delete" onclick="WPA.Admin.leagueModifyEvent(' + WPA.Admin.selectedLeagueId + ',' + event.id + ',\'remove\')"></div></td>' + 
						'<td>' + event.date + '</td>' + 
						'<td><a href="javascript:WPA.displayEventResultsDialog(' + event.id + ', ' + (event.is_future == '1' ? 'true' : 'false') + ')">' + event.name + '</td>' + 
						//'<td>' + WPA.getEventCategoryDescription(event.event_cat_id) + '</td>' + 
						'<td><a href="javascript:WPA.Admin.editEvent(' + event.id + ')">Edit Event</a></td>' + 
					'</tr>'
				);
				jQuery('#leagueMinEvents').append('<option value="' + (i+1) + '">' + (i+1) + '</option>');
			});

			if(WPA.Admin.selectedMinEvents) {
				jQuery('#leagueMinEvents').val(WPA.Admin.selectedMinEvents);
			}
		}
	}

	WPA.Admin.generateLeaguePage = function() {
		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
				action: 'wpa_generate_league_page',
	    		id: WPA.Admin.selectedLeagueId,
	    		name: jQuery('#leagueName').val()
			},
			success: function(result) {
				WPA.toggleLoading(false);
				if(result.success) {
					WPA.Admin.leaguePageId = result.pageId;
					jQuery('#leagueGeneratePageButton').hide();
					jQuery('#leagueViewPageButton').show();
				}
			}
		});	
	}

	WPA.Admin.loadLeagueEvents = function() {
		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
    			action: 'wpa_get_league_events',
	    		id: WPA.Admin.selectedLeagueId
			},
			success: function(events) {
				WPA.toggleLoading(false);
				if(events) {
					WPA.Admin.displayLeagueEvents(events);
				}
				else {
    				alert('There was a problem loading the league events');
				}
			}
		});
	}

	WPA.Admin.leagueModifyEvent = function(leagueId, eventId, action) {
		WPA.toggleLoading(true);
		jQuery.ajax({
			type: "post",
			url: WPA.Ajax.url,
			data: {
    			action: 'wpa_modify_league_events',
    			modify: action,
	    		leagueId: leagueId,
	    		eventId: eventId
			},
			success: function(result) {
				WPA.toggleLoading(false);
				if(result && result.success) {
					WPA.Admin.loadLeagueEvents();
				}
				else {
    				alert(result.error ? result.error : 'Oops! There was a problem');
				}
			}
		});
	}

	jQuery(document).ready(function() {
		WPA.isAdminScreen = true;

		// set up ajax
		WPA.Ajax.setup('<?php echo admin_url( 'admin-ajax.php' ); ?>', '<?php echo $nonce; ?>', '<?php echo WPA_PLUGIN_URL; ?>', '<?php echo $current_user->ID; ?>',  function() {

			// common setup function
			WPA.setupCommon();

			// load leagues into select
			WPA.Admin.loadLeagues();

			// setup the edit event screen
			WPA.setupEditEventDialog(function(eventId) {
				if(WPA.Admin.createEventMode) {
					WPA.Admin.leagueModifyEvent(WPA.Admin.selectedLeagueId, eventId, 'add');
					WPA.Admin.createEventMode = false;
				}
				if(WPA.Admin.editEventMode) {
					WPA.Admin.loadLeagueEvents();
					WPA.Admin.editEventMode = false;
				}
			});

			// autocomplete for choosing event
			jQuery("#leagueSelectEvent").autocomplete({
				source: WPA.Ajax.url + '?action=wpa_event_autocomplete',
				minLength: 2,
				select: function(event, ui) {
					WPA.Admin.leagueModifyEvent(WPA.Admin.selectedLeagueId, ui.item.value, 'add');
					setTimeout("jQuery('#leagueSelectEvent').val('')", 50);
				}
		    }).focus(function(){
		        this.select();
		    })

			jQuery('.wpa-league-select button').button({
				icons: {
		        	primary: 'ui-icon-circle-plus'
		        }
			}).click(function(e) {
				e.preventDefault();
				WPA.Admin.displayCreateLeague();
			});

			jQuery('#leagueSaveButton').button().click(function() {
				if(WPA.Admin.leagueFormValid()) {
					WPA.Admin.saveLeague();
				}
			});

			jQuery('#leagueGeneratePageButton').button().click(function() {
				if(WPA.Admin.leagueFormValid()) {
					WPA.Admin.generateLeaguePage();
				}
			});

			jQuery('#leagueViewPageButton').button().click(function() {
				WPA.Admin.viewLeaguePage();
			});

			jQuery('.wpa-league-select select').change(function() {
				var val = jQuery(this).val();
				if(val) {
					WPA.Admin.leagueSelected(val);
				}
			});

			jQuery('#leagueDeleteButton').button().click(function() {
				var id = jQuery('#leagueId').val();
				WPA.Admin.deleteLeague(id);
			});

			jQuery('#create-event-button').button({
				icons: {
		        	primary: 'ui-icon-circle-plus'
		        }
			}).click(function(e) {
				e.preventDefault();
				WPA.Admin.createEvent();
			});
			
			jQuery.each(WPA.globals.ageCategories, function(cat, item) {
				jQuery("#leagueAgeCategory").append('<option value="' + cat + '">' + item.name + '</option>');
			});

			jQuery('#leagueRule').change(function() {
				jQuery('#partialRuleNumberEvents').hide();
				if(jQuery(this).val() == 'PARTIAL') jQuery('#partialRuleNumberEvents').show();
			});

			jQuery('#leagueMinEvents').change(function() {
				WPA.Admin.selectedMinEvents = jQuery(this).val();
			});

			jQuery('.league-item').hide();
		});
	});

	</script>
	
	<style>
	
	#wpa-league-events-table {
		margin-top: 10px;
		border-collapse: collapse;
	}
	
	#wpa-league-events-table td {
		padding: 2px 5px;
	}
	
	#wpa-league-events-table tr:hover {
		background-color: #eee;
	}
	
	#league-buttons {
		margin-top: 10px;
	}
	
	.field-error {
	  border: 1px solid #cd0a0a !important;
	  background: #fef1ec !important;
	}
	
	.wpa-edit-league {
		display: none;
		border: 1px solid #C5C5C5;
		background: #fff;
		padding: 10px;
		border-radius: 10px;
		margin: 10px 20px 0px 0px;
	}

	.wpa-league-select p {
		display: inline-block;
		margin-left: 10px;
	}
	
	.wpa-league-select button {
		display: inline-block;
		margin-left: 10px;
		font-size: 11px;
	}
	
	textarea#leagueDetails {
		width: 337px;
		height: 75px;
	}
	
	label#leagueDetailsLabel {
		position: relative;
		top: -60px;
	}
	
	.wpa-league-field {
		padding-top: 5px;
	}
	
	label {
		width: 150px !important;
		display: inline-block;
		text-align: right;
	}
	
	label.required {
		font-weight: bold;
	}
	
	#edit-league-events {
		float: left;
	}
	
	#edit-league-details {
		float: left;
		margin-right: 50px;
	}
	
	.wpa-edit-league h3 {
		border-bottom: 1px solid #BEBEBE;
		margin-top: 5px;
		padding-bottom: 1px;
	}
	
	.edit-league-events-action {
		float: left;
	}
	
	.edit-league-events-action span {
		
	}
	
	#create-event-button {
		margin-top: 2px;
	}
	
	#wpa-league-rules {
		margin: 20px 0px;
	}
	
	</style>

	<div>
		<div class="wpa-admin-title">
			<h2><?php echo $this->get_property('admin_leagues_title'); ?></h2>
		</div>
		<br style="clear:both;"/>
	</div>

	<div class="wpa">

		<div class="wpa-league-select">
			<select></select>
			<p><?= $this->get_property('or') ?></p>
			<button><?= $this->get_property('leagues_create_button')?></button>
		</div>
		
		<div class="wpa-edit-league">
			<!-- LEAGUE DETAILS -->
			<div id="edit-league-details">
				<h3 class="league-item create-league"><?= $this->get_property('leagues_create_title')?></h3>
				<h3 class="league-item edit-league"><?= $this->get_property('leagues_edit_title')?></h3>
				<div>
					<input type="hidden" id="leagueId"/>
					<div class="wpa-league-field">
						<label class="required"><?= $this->get_property('leagues_form_name'); ?>:</label>
						<input class="ui-widget ui-widget-content ui-state-default ui-corner-all" size="40" maxlength=100 type="text" id="leagueName" />
					</div>
					<div class="wpa-league-field add-result-no-bg">
						<label id="leagueDetailsLabel"><?= $this->get_property('leagues_form_details'); ?>:</label>
						<textarea id="leagueDetails" class="ui-widget ui-widget-content ui-state-default ui-corner-all"></textarea>
					</div>
					<div class="wpa-league-field add-result-no-bg">
						<label class="required"><?= $this->get_property('leagues_form_rank_by'); ?>:</label>
						<select id="leagueRankBy">
							<option selected="selected" value="AGE_GRADE"><?= $this->get_property('leagues_rank_by_age_grade') ?></option>
							<option value="POSITION"><?= $this->get_property('leagues_rank_by_position') ?></option>
							<option value="TIME"><?= $this->get_property('leagues_rank_by_time') ?></option>
						</select>
					</div>
					<div class="wpa-league-field add-result-no-bg">
						<label><?= $this->get_property('leagues_form_gender'); ?>:</label>
						<select id="leagueGender">
							<option selected="selected" value=""><?= $this->get_property('leagues_select_all') ?></option>
							<option value="M"><?= $this->get_property('gender_M') ?></option>
							<option value="F"><?= $this->get_property('gender_F') ?></option>
						</select>
					</div>
					<div class="wpa-league-field add-result-no-bg">
						<label><?= $this->get_property('leagues_form_age_cat'); ?>:</label>
						<select id="leagueAgeCategory">
							<option selected="selected" value=""><?= $this->get_property('leagues_select_all') ?></option>
						</select>
					</div>
				</div>
				<!-- LEAGUE RULES -->
				<div id="wpa-league-rules" class="league-item edit-league">
					<h3><?= $this->get_property('leagues_rules_title')?></h3>
					<div class="wpa-league-field add-result-no-bg">
						<label class="required"><?= $this->get_property('league_participation'); ?>:</label>
						<select id="leagueRule">
							<option selected="selected" value="ALL"><?= $this->get_property('league_participation_all') ?></option>
							<option value="PARTIAL"><?= $this->get_property('league_participation_partial') ?></option>
						</select>
					</div>
					<div id="partialRuleNumberEvents">
						<label></label>
						<select id="leagueMinEvents"></select>
						<span><?= $this->get_property('league_participation_events')?></span>
					</div>
				</div>
				<div id="league-buttons">
					<button id="leagueSaveButton"><?= $this->get_property('leagues_save_button')?></button>
					<button class="league-item edit-league" id="leagueDeleteButton"><?= $this->get_property('leagues_delete_button')?></button>
					<button class="league-item edit-league" id="leagueGeneratePageButton"><?= $this->get_property('leagues_generate_page_button')?></button>
					<button class="league-item edit-league" id="leagueViewPageButton"><?= $this->get_property('leagues_view_page_button')?></button>
				</div>
			</div>
			
			<!-- LEAGUE EVENTS -->
			<div class="league-item edit-league" id="edit-league-events">
				<h3><?= $this->get_property('leagues_edit_events_title')?></h3>
				
				<div>
					<div class="edit-league-events-action">
						<span><?= $this->get_property('leagues_add_existing_event')?></span><br/>
						<div>
							<input style="background:#fff" size="30" id="leagueSelectEvent" default-text="<?php echo $this->get_property('add_results_event_input_text'); ?>" class="ui-corner-all ui-widget ui-widget-content ui-state-default wpa-search wpa-search-disabled"></input>
							<span style="display:none;" id="add-event-cancel" class="input-cancel"></span>
						</div>
					</div>
					<div style="margin-left:20px" class="edit-league-events-action">
						<span><?= $this->get_property('leagues_create_new_event')?></span><br/>
						<button id="create-event-button"><?php echo $this->get_property('events_create_button'); ?></button>
					</div>
					<br style="clear:both">
				</div>
				
				<table id="wpa-league-events-table">
					<tbody></tbody>
				</table>
				
			</div>
			
			<br style="clear:both"/>

		</div>

		<!-- DELETE LEAGUE CONFIRM DIALOG -->
		<div id="delete-league-confirm-dialog" style="display:none">
			<p>
				<?php echo $this->get_property('delete_league_text') ?>
			</p>
		</div>
		
		<!-- ADD/EDIT EVENT DIALOG -->
		<?php $this->create_edit_event_dialog(); ?>

		<!-- COMMON DIALOGS -->
		<?php $this->create_common_dialogs(); ?>
		
	</div>

<?php
}
?>