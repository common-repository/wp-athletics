<?php

/**
 * Class for displaying league tables (simple and interactive)
 */

if(!class_exists('WP_Athletics_Leagues')) {

	class WP_Athletics_Leagues extends WPA_Base {
		
		const RANK_BY_TIME = "TIME";
		const RANK_BY_POSITION = "POSITION";
		const RANK_BY_AGE_GRADE = "AGE_GRADE";

		const PARTICIPATION_RULE_ALL = "ALL";
		const PARTICIPATION_RULE_PARTIAL = "PARTIAL";
		
		/**
		 * default constructor
		 */
		public function __construct( $db ) {
			parent::__construct( $db );
		}
		
		/**
		 * Generates a league table for a given league ID
		 */
		public function calculate_league_table($league_id) {
			$league_details = $this->wpa_db->get_league_details($league_id);
			if($league_details && $league_details['league']) {
				$results = $this->wpa_db->get_league_results($league_id, $league_details);

				$grouped_results = array();
				$scored_results = array();
				$invalid_athletes = array();

				// sort results into 2d array where user ID is the key
				foreach($results as $result) {
					$user_id = $result->user_id;
					if(!array_key_exists($user_id, $grouped_results)) {
						$grouped_results[$user_id] = array();
					}
					$grouped_results[$user_id][] = $result;
				}
				
				// get the league rules and rank by 
				$event_count = intval($league_details['count']);
				$rank_by = $league_details['league']->rank_by;
				$min_events = $event_count;
				
				$league_rule = $league_details['league']->rule;
				if($league_rule != WP_Athletics_Leagues::PARTICIPATION_RULE_ALL) {
					$split = explode(',', $league_rule);
					if($split[0] == WP_Athletics_Leagues::PARTICIPATION_RULE_PARTIAL) $min_events = intval($split[1]);
				}

				// loop the grouped results and calculate overall score for each athlete
				foreach($grouped_results as $user_id => $results) {
					// class to store each athletes entry in the league table
					$entry = new stdClass();
					$entry->count = count($results);
					$entry->results = $results;
					$entry->name =  $results[0]->athlete_name;
					$entry->user_id =  $results[0]->user_id;
					$entry->valid_score = false;
					$entry->all_results_count = (count($results) != $min_events);
					
					// ensure athlete has participated in the required number of events
					if(count($results) >= $min_events) {
						$score = $this->calculate_score($results, $rank_by, $min_events);
						if($score > 0) {
							$entry->score = $score;
							$scored_results[] = $entry;
						}
						// invalid score - probably position not entered
						else {
							$entry->valid_score = false;
							$invalid_athletes[$user_id] = $entry;
						}
					}
					// not enough results
					else {
						$invalid_athletes[$user_id] = $entry;
					}
				}
				
				// rank the results
				if($rank_by == WP_Athletics_Leagues::RANK_BY_AGE_GRADE) {
					usort($scored_results, function($a, $b) {
						return $b->score > $a->score;
					});
				}
				else {
					usort($scored_results, function($a, $b) {
						return $a->score > $b->score;
					});
				}
				
				foreach($invalid_athletes as $user_id => $athlete) {
					//echo "INVALID: " . $athlete['name'] . "<br/>";
				}

				$count = 1;
				foreach($scored_results as $res) {
					//echo $count++ . ". $res->name $res->score <br/>";
					foreach($res->results as $result) {
						if($result->used) {
							//echo "used $result->event_name $result->event_date $result->position <br/>";
						}
					}
				}
				
				return array(
					'league' => $league_details['league'],
					'table' => $scored_results,
					'invalid_athletes' => $invalid_athletes
				);
			}
		}
		
		public function display_league_table($league_id) {
			$table = $this->calculate_league_table($league_id);
			$events = $this->wpa_db->get_league_events($league_id);
			$results = $table['table'];
			$league = $table['league'];
			$invalid = $table['invalid_athletes'];
			$league_complete = true;
		?>
				<style>
				
					.wpa-league-expand {
						width: 14px;
						height: 14px;
						background-position: 2px 5px;
						background-repeat: no-repeat;
						cursor: pointer;
					}
					
					.wpa-league-table {
						width: 100%;
						border-collapse: collapse;
					}
					
					.wpa-league-table td {
						padding: 2px;
						border: 1px solid #eee;
					}
					
					.used {
						background-color: #FAF0C6;
					}
					
					.wpa-league-table thead tr {
						background-color: #eee;
					}
					
					.wpa-league-results-table {
						padding: 5px;
					}
					
					td.center {
						text-align: center;
					}
					
					.wpa-league-results-table thead tr {
						background-color: #F5F5F5 !important;
					}
					
					.table-container {
						padding: 5px !important;
					}
					
					#league-complete {
					  background-color: #F7FFF2;
					  display: inline-block;
					  width: 100%;
					  margin: 5px 0px;
					  border-radius: 5px;
					  text-align: center;
					  padding: 5px 0px;
					  font-weight: bold;
					  border: 1px solid #0CB800;
					}
					
				</style>
				
			<div id="tabs">
				<ul>
					<li><a href="#tabs-league-table"><?php echo $this->get_property('league_tab_table') ?></a></li>
					<li><a href="#tabs-league-events"><?php echo $this->get_property('league_tab_events') ?></a></li>
				</ul>
				
				<!-- LEAGUE EVENTS -->
				<div id="tabs-league-events">
					<table class="wpa-league-table wpa-league-events">
						<thead>
							<tr>
								<th><?= $this->get_property('column_event_date') ?></th>
								<th><?= $this->get_property('column_event_name') ?></th>
								<th><?= $this->get_property('column_category') ?></th>
								<th><?= $this->get_property('column_status') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($events as $event) {
								if($event->is_future == '1') $league_complete = false;
							?>
								<tr class="<?= $event->is_future ? 'future' : 'complete' ?>">
									<td><?= $event->date ?></td>
									<td><div class="wpa-link" onclick="WPA.displayEventResultsDialog('<?= $event->id ?>', <?= $event->is_future == '1' ? "true" : "false" ?>)"><?= $event->name ?></div></td>
									<td><?= $event->event_cat ?></td>
									<td><?= $this->get_property($event->is_future ? 'league_status_future' : 'league_status_complete') ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				
				<!-- LEAGUE TABLE -->
				<div id="tabs-league-table">
					<?php 
					if($league_complete) {
						echo "<div id='league-complete'>" . $this->get_property('league_complete_message') . "</div>";
					}
					?>
					<table style="display:none" class="wpa-league-table">
						<thead>
							<tr>
								<th></th>
								<th><?= $this->get_property('column_position')?></th>
								<th><?= $this->get_property('column_athlete_name')?></th>
								<th><?= $this->get_property('column_score')?></th>
							</tr>
						</thead>
						<tbody>
			<?php
				$pos = 1;
				foreach($results as $result) {
			?>
						<tr>
							<td class="wpa-league-expand wpa-expand" user-id="<?= $result->user_id ?>">
							<td class="center"><?= $pos++ ?></td>
							<td><div class="wpa-link" onclick="WPA.displayUserProfileDialog('<?= $result->user_id ?>')"><?= $result->name ?></div></td>
							<td><?= $result->score ?></td>
						</tr>
						<tr style="display:none" class="user-results" user-id="<?= $result->user_id ?>">
							<td class="table-container" colspan="4">
								<?php 
								if($result->all_results_count) {
								?>
									<span><?= $this->get_property('leagues_table_of_results_help')?></span>
								<?php 
								}
								?>
								<table class="wpa-league-table wpa-league-results-table">
									<thead>
										<tr>
											<th><?= $this->get_property('column_event_date')?></th>
											<th><?= $this->get_property('column_event_name')?></th>
											<th><?= $this->get_property('column_event_location')?></th>
											<th><?= $this->get_property('column_category')?></th>
											<th><?= $this->get_property('column_age_grade')?></th>
											<th><?= $this->get_property('column_pace')?></th>
											<th><?= $this->get_property('column_time')?></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									foreach($result->results as $res) {
									?>
										<tr class="<?= $res->used ? "used" : "unused" ?>">
											
											<td><?= $res->event_date ?></td>
											<td><div class="wpa-link" onclick="WPA.displayEventResultsDialog('<?= $res->event_id ?>')"><?= $res->event_name ?></div></td>
											<td><?= $res->event_location ?></td>
											<td><?= $res->event_cat ?></td>
											<td class="center"><?= $res->age_grade ?>%</td>
											<td class="center wpa-pace" millis="<?= $res->time ?>" meters="<?= $res->distance_meters ?>"></td>
											<td class="center wpa-time" millis="<?= $res->time ?>" time-format="<?= $res->time_format ?>"></td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</td>
						</tr>
			<?php
				}
			?>
						</tbody>
					</table>
					<div class="wpa-league-rules">
						<h5>League Rules</h5>
						<ul>
							<li><?= $this->get_property('league_rank_by_' . strtolower($league->rank_by)) ?></li>
							<?php 
							$rule = $league->rule;
							if($rule == WP_Athletics_Leagues::PARTICIPATION_RULE_ALL) {
								echo "<li>" . $this->get_property('league_rule_all') . "</li>";
							}
							else {
								$split = explode(",", $league->rule);
								if($split[0] == WP_Athletics_Leagues::PARTICIPATION_RULE_PARTIAL) {
									$text = str_replace('<number>', $split[1], $this->get_property('league_rule_partial'));
									echo "<li>" . $text . "</li>";
								}
							}
							if($league->gender) {
								$gender = strtolower($this->get_property('gender_' . $league->gender));
								$text = str_replace('<gender>', $gender, $this->get_property('league_rule_gender'));
								echo "<li>" . $text . "</li>";
							}
							?>
						</ul>
					</div>
				</div}
		<?php
		
		}
		
		private function calculate_score(&$results, $method, $min_events) {
			$score = 0;

			if($method == WP_Athletics_Leagues::RANK_BY_TIME) {
				usort($results, function($a, $b) {
    				return $a->time > $b->time;
				});
			}
			
			if($method == WP_Athletics_Leagues::RANK_BY_AGE_GRADE) {
				usort($results, function($a, $b) {
					return $b->age_grade > $a->age_grade;
				});
			}
			
			if($method == WP_Athletics_Leagues::RANK_BY_POSITION) {
				usort($results, function($a, $b) {
					return $a->position > $b->position;
				});
			}
			
			foreach($results as &$result) {
				$result_score = 0;
				if($method == WP_Athletics_Leagues::RANK_BY_TIME) $result_score = intval($result->time);
				if($method == WP_Athletics_Leagues::RANK_BY_AGE_GRADE) $result_score = floatval($result->age_grade);
				if($method == WP_Athletics_Leagues::RANK_BY_POSITION && $result->position) $result_score = intval($result->position);
				
				if($result_score && $min_events > 0) {
					$score += $result_score;
					$min_events--;
					$result->used = true;
				}
				else if($min_events == 0) {
					break;
				}
			}
			
			return $min_events == 0 ? $score : -1;
		}

		/**
		 * Creates an "Events" page
		 */
		public function create_page($league_id) {
			$the_page_id = $this->generate_page('title');
		}

		/**
		 * Enqueues scripts and styles
		 */
		public function enqueue_scripts_and_styles() {
			// common scripts and styles
			$this->enqueue_common_scripts_and_styles();
			wp_enqueue_script( 'wpa-events' );
		}

		/**
		 * For content filtering, ensures the content is only displayed in the WP loop
		 */
		public function league_content_filter( $content ) {
			if( !in_the_loop() ) return $content;
			$this->league();
		}

		/**
		 * Generates a 'events' page when the shortcode [wpa-events] is used
		 */
		public function league_table( $atts = null ) {
			
			if(isset( $atts ) && isset( $atts['id'] ) ) {
	
				global $current_user;
				global $wpa_settings;
	
				$this->enqueue_scripts_and_styles();
			?>
				<script type='text/javascript'>
					jQuery(document).ready(function() {
						// set up ajax and retrieve my results
						WPA.Ajax.setup('<?php echo admin_url( 'admin-ajax.php' ); ?>', '<?php echo wp_create_nonce( $this->nonce ); ?>', '<?php echo WPA_PLUGIN_URL; ?>', '<?php echo $current_user->ID; ?>',  function() {
	
							jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ '<?php echo strtolower(get_option( 'wp-athletics_language', 'en') ); ?>' ] );
	
							// common setup function
							WPA.setupCommon();

							jQuery('#tabs').tabs();

							jQuery('td.wpa-time').each(function() {
								var millis = jQuery(this).attr('millis');
								var format = jQuery(this).attr('time-format');
								jQuery(this).html(WPA.displayEventTime(millis, format));
							});

							jQuery('td.wpa-pace').each(function() {
								var millis = jQuery(this).attr('millis');
								var meters = jQuery(this).attr('meters');
								jQuery(this).html(WPA.timeToPace(millis, meters, WPA.defaultUnit, false) + ' ' + (WPA.getProperty('pace_minute') + '/' + WPA.getProperty('pace_' + WPA.defaultUnit)));
							});

							jQuery('.wpa-league-table').fadeIn();

							jQuery('.wpa-league-expand').click(function() {
								var isCollapsed = jQuery(this).hasClass('wpa-expand');
								var userId = jQuery(this).attr('user-id');
								var trEl = jQuery('tr.user-results[user-id="' + userId + '"]');
								if(isCollapsed) {
									jQuery(trEl).show();
									jQuery(this).removeClass('wpa-expand').addClass('wpa-collapse');
								}
								else {
									jQuery(trEl).hide();
									jQuery(this).removeClass('wpa-collapse').addClass('wpa-expand');
								}
							});
						});
					});
				</script>
				
				<style>
				
				</style>
				
				<?php $this->display_page_loading(); ?>
	
				<div class="wpa hide">
	
					<div class="wpa-league">
					<?php $this->display_league_table($atts['id']); ?>
					</div>
	
					<!-- COMMON DIALOGS -->
					<?php $this->create_common_dialogs(); ?>
				</div>
			<?php
			}
			else {
			?>
				<div><?php echo $this->get_property('shortcode_error_required')?></div>
			<?php
			}
		}
	}
}
?>