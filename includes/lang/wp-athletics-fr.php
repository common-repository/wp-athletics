<?php

$common_lang = array(
	// results/records tables
	'activity_link_text' => 'Voir activité',
	'rankings_link_text' => 'Voir classement du club pour cet événement',
	'column_event_date' => "Date de l'événement",
	'column_result_date' => 'Date entrée',
	'column_event_type' => 'Terrain',
	'column_event_name' => 'Evénement',
	'column_athlete_name' => 'Athlète',
	'column_athlete_username' => 'Username',
	'column_athlete_email' => 'Email',
	'column_athlete_registered' => 'Enregistré',
	'column_event_location' => 'Lieu',
	'column_category' => 'Distance',
	'column_time' => 'Temps',
	'column_pace' => 'Allure',
	'column_pace_miles' => 'Allure (mile)',
	'column_position' => 'Pos.',
	'column_garmin' => 'Activité',
	'column_athlete_name' => 'Nom',
	'column_members_attending' => 'Membres participants',
	'column_athlete_dob' => 'DDN',
	'column_age_category' => 'Catégorie',
	'column_rankings' => 'Classement',
	'column_club_rank' => 'Classement club',
	'column_result_count' => 'Result Count',
	'column_event_shortcode' => 'Embed Code',
	'column_age_grade' => "Catégorie d'âge",

	// my results - profile
	'my_profile_display_name_label' => "Nom de l'athète",
	'my_profile_age_class' => "Classe d'âge",
	'my_profile_select_fave_event' => 'Selectionner Evénement',
	'my_profile_fave_event' => 'Evénement préfèré',
	'my_profile_results_recorded' => 'Resultat enregistré',
	'my_profile_dob' => 'DdN',
	'my_profile_hide_dob' => 'Cacher DdN',
	'my_profile_gender' => 'Genre',
	'my_profile_select_sub_type' => 'Choisir le terrain',
	'my_profile_image_upload_text' => 'Click to télécharger une nouvelle photo de profil',
	'my_profile_select_profile_image' => 'Choisir comme nouvelle photo de profil',
	'my_profile_select_profile_image_title' => 'Choisir la phota pour le profil',
	'my_profile_upcoming_events' => 'Evénements à venir',

	// filters
	'filter_events_option_all' => 'Tous les événements',
	'filter_period_option_all' => 'Tous les temps',
	'filter_period_future_events' => 'Evénements à venir',
	'filter_month_all' => 'Tous le smois',
	'filter_period_option_this_month' => 'Ce mois',
	'filter_period_option_this_year' => 'Cette année',
	'filter_period_option_next_year' => 'Année prochaine',
	'filter_type_option_all' => 'Tous les terrains',
	'filter_age_option_all' => "Toutes les classes d'âges",
	'filter_event_name_input_text' => "Filtrer l'événement",
	'filter_event_name_cancel_text' => "Enlever le filtre sur l'événement",
	'filter_athlete_name_input_text' => "Filtrer sur le nom de l'athlète",
	'filter_athlete_name_cancel_text' => "Enlever le filtre sur le nom de l'athlète",

	// user profile dialog
	'user_profile_dialog_title' => 'Profil utilisateur',

	// event results dialog
	'event_results_dialog_title' => "Resultats de l'événement",
	'future_event_dialog_title' => "Détails des événements futures",
	'event_dialog_future_event_info' => 'Ceci est un événement futur.',
		
	// create user dialog
	'create_user_dialog_title' => 'Ajouter un nouvel athlète',

	// generic results dialog
	'generic_results_dialog_title' => 'Results Viewer',

	// rankings dialog - ** DO NOT TRANSLATE THE PROPERTIES IN [brackets] AS THESE ARE TOKENS THAT WILL BE REPLACED WHEN RENDERED **
	'rankings_dialog_title' => '[age] [gender] [category] Classement ([period], [type])',
	'rankings_display_best_athlete_result' => 'Montrer seulement les meilleurs résultats pour chaque athlète',
	'rankings_display_all_athlete_results' => 'Montrer tous les résultats pour chaque athlète',
	'rankings_column_hover_text' => 'Click pour un classement complet',

	// my results - tabs
	'my_results_main_tab' => 'Mes résultats',
	'my_results_personal_bests_tab' => 'Mes records personnels',
	'my_results_upcoming_events_tab' => 'Mes événements',

	// results - tabs
	'results_main_tab' => 'Résultats',
	'results_personal_bests_tab' => 'Records personnels',

	// wpa search
	'wpa_search_text' => 'Rechercher un athlète ou un un événement',
	'wpa_search_category_event' => 'Evénements',
	'wpa_search_category_athlete' => 'Athlètes',

	// my_results - add result
	'add_result_event_name' => "Nom de l'événement",
	'add_result_name' => 'Nom',
	'add_result_event_category' => 'Distance',
	'add_result_age_class' => "Catégorie d'âge",
	'add_result_location' => 'Lieux',
	'add_result_event_date' => 'Date',
	'add_result_event_position' => 'Position',
	'add_result_event_time_hours' => 'Heures',
	'add_result_event_time_minutes' => 'Minutes',
	'add_result_event_time_seconds' => 'Secondes',
	'add_result_event_time_milliseconds' => 'Millisecondss',
	'add_result_activity_link' => "URL de l'avtivité",
	'add_result_select_event' => "Choisir la catégorie de l'événement",
	'add_result_optional' => 'optionel',
	'add_result_event_sub_type' => 'Terrain',
	'add_result_title' => 'Ajouter les résutats',
	'add_my_result_text' => 'Ajouter mes résultats',
	'add_result_title_event_dialog' => 'Ajouter mes résultats',
	'edit_result_title' => "Editer les résultats de l'événement",
	'add_result_no_dob' => "Vous n'avez pas indiquer votre date de naissance (D.d.N.). Votre pourcentile de classe d'âge sera donc basé sur la moyenner de voter classe d'âge.<br/><br/>
		Afin d'être plus précis, prière de completer votre date de naissance (D.d.N.). Merci.",
		
	// add/edit event
	'add_event_contact_email' => 'Email de contact',
	'add_event_contact_name' => 'Nom de contact',
	'add_event_contact_number' => 'Numéro de téléphone',
	'add_event_url' => "Site web de l'événement",
	'add_event_register_url' => "Lien pour s'inscrire",
	'add_event_cost' => "Prix de l'inscription",
	'add_event_details' => "Détails de l'événement",
	'add_event_more_detail' => 'Montrer plus de détails',

	// results - other
	'my_results_add_result_button' => "Ajouter les résultats de l'événement",
	'delete_result_text' => 'Supprimer ces résultats (irréversible)',
	'edit_result_text' => 'Editer ce résultat',
	'confirm_result_delete_title' => 'Confirmer la suppression',
	'confirm_result_delete' => 'Êtes-vous certqin de vouloir effacer ce résultats. Ceci est irréversible.',
	'my_results_dob_changed' => "Votre date de naissance a été modifiée. Tous vos résultats ont été adaptés afin d'appliquer correctement le pourcentile du classmeent d'âge.",

	// help texts
	'help_add_result_activity_url' => "Si vous avez enregisté une activité sur site extérieur (e.g Garmin, Strava, RunKeeper etc), copiez le lien ici",
	'help_add_result_event_name' => "Cet événement peut déjà exister dans la base de données, tapez le début du nom de l'événement et sélectionnez cuili-ci s'il apparaît dans la liste. Autrement un nouvel événement sera créé. Dans ce cas soyez aussi précis que possible et introduisez un maximum de détails",
	'help_add_result_cancel_event' => "Enlever l'événement choisi",
	'help_column_rank' => "Représente le classement club de tous les temps pour ce résultat basé sur le sexe, le type d'épreuve et la classe d'âge",
	'help_column_age_grade' =>"La normalisation par âge est une méthode d'évaluation des résultats indifféremment de l'âge ou du genre de l'athlète.
	Les résultats normés vous permettent de comparer vos temps de course à ceux des autres coureurs, ainsi qu'au standard de votre groupe d'âge ou genre. 
		<br/><br/>Chaque valeur est calculée sur base des facteurs de normalisation 2015 du la World Masters Association (WMA)<br/><br/>
		<b>Les percentiles peuvent être interprètés comme suit</b><br/><br/>
		<br/><b>- Plus de 90%</b> Niveau mondial</li>
		<br/><b>- Plus de 80%</b> Niveau national</li>
		<br/><b>- Plus de 70%</b> Niveau régional</li>
		<br/><b>- Plus de 60%</b> Niveau club</li><br/><br/>",

	// datatables
	'table_no_results' => "Pas d'entrée à afficer",
	'table_loading_message' => 'Chargement des items...',
	'table_loading_records_message' => 'Chargement des items...',

	// errors
	'ajax_no_permission' => "Vous n'êtes autorisé à lancer cette commande",
	'my_results_not_logged_in' => "Vous devez être connecté afin de gérer vos résultats. Veuillez vous connecter",
	'error_problem_creating_event' => "Une erreure est survenue. Veuillez ré-essayer plus tard",
	'error_add_result_no_gender_dob' => "Vous n'avez pas entré votre genre; ni date de naissance. Veuillez les ntroduire dans 'Gérer les résultats'",
	'error_dialog_title' => 'Erreur',
	'alert_dialog_title' => 'Alerte',
	'error_no_age_category' => "Impossible de déterminer une catégorie d'âge. Merci de vérifier, ou d'entrer manuellement une classe d'âge",
	'error_event_already_entered' => "Vous avez déjà introduit vos résultats pour cet événement",
	'error_event_already_entered_pending' => "Vous vous êtes déjà inscrit à cet événement. N'oubliez pas d'entrer vos résultats après",
	'error_not_logged_in' => "Vous devez être connecté afin de gérer vos résultats. Veuillez vous connecter",

	// records page
	'all_age_classes' => "Toutes les classes d'âges",
	'all_age_classes_label' => 'Toutes',

	// labels for buttons etc
	'delete' => 'Effacer',
	'submit' => 'Envoyer',
	'ok' => 'OK',
	'cancel' => 'Annuler',
	'save' => 'Sauver',
	'edit' => 'Editer',
	'go' => 'Aller',
	'view' => 'Voir',

	// misc
 	'gender_M' => 'Male',
	'gender_F' => 'Femme',
	'gender_B' => 'Tous sexes',
	'loading_dialog_text' => 'Un moment...',
	
	'edit_event_dialog_title' => 'Editer un événement',
	'create_event_dialog_title' => 'Créer un événement',
	'embedded_event_results_club_records_link' => 'Voir tous les records du club',
	'embedded_event_results_add_result_link' => 'Ajouter mes résultats',
	'embedded_event_results_male_records_link' => 'Voir les records masculins',
	'embedded_event_results_female_records_link' => 'Voir les records féminins',
	'embedded_event_results_recent_results_link' => 'Résultats récents',
	'embedded_event_results_events_link' => 'Voir les événements',
	'embedded_event_results_manage_link' => 'Gérer mes résultats',
	'embeded_event_results_link_select' => 'Aller à...',
	'embedded_event_results_error_no_id' => '[WPA Error: ID for the event was not supplied]',
	'shortcode_error_required' => 'WPA Error: Shortcode attribute required',
	'time_invalid_text' => 'Temsp non valide',
	'time_no_value_text' => 'non disponible',
	'time_pending_value_text' => 'en attente',
	'time_days_label' => 'jours',
	'page_loading_text' => 'En cours de chargement...',
	'recent_results_empty_text' => 'Pas de résultats actuellement',
	'events_empty_text' => "Pas d'événement disponible",
	'recent_results_empty_add_result' => "Pourquoi n'avez-vous pas ajouter vous propres résultats?",
	'events_empty_submit_event' => 'Et pourquoi ne pqs qjouter un événement à venir?',
	'event_runners_going' => 'y va',
	'event_results_count' => 'membres ont participés',
	'event_result_count' => 'membre a participé',
	'event_youre_going_text' => "Tu y vas.",
	'event_im_going_text' => "J'y vais.",	
	'event_im_not_going_text' => "Je n'y vais pas.",
	'event_you_ran_this_text' => "Tu y as participé.",
	'event_i_ran_this_text' => "J'y ai participé.",
	'event_i_didnt_go_text' => "Je n'y ai pas été.",
	'event_you_ran_this_pending_text' => "Tu y as été. Ajoutes tes résultats.",
	'legend_future_events' => 'Futurs événements',
	'submit_event_button' => 'Soumettre un événement',
	'age_grade_bronze_text' => 'Niveau régional',
	'age_grade_silver_text' => 'Niveau national',
	'age_grade_gold_text' => 'Niveau mondial',
	'shortcode_table_no_results' => 'Pas de résultat à montrer',
	'yes' => 'Oui',
	'no' => 'Non',
	'na' => 'N/A',
	'shortcode_simple' => 'Simple',
	'shortcode_interactive' => 'Interactif',
	
	// widgets
	'results_widget_recent_results_link' => "Voir tous les événements récents",
	'events_widget_upcoming_events_link' => "Voir tous les événements",
	'widget_recent_results_no_results' => "Pas de résutlats actuellement. Inscrits-toi et ajoutes les.",
	'widget_no_upcoming_events' => "Pas d'événement à venir actuellement.",

	// stats
	'stats_tab' => 'Statistiques',
	'stats_type_label' => 'Voir',
	'stats_type_user' => "Statistique de <name>",
	'stats_type_mine' => 'Mes statistiques',
	'stats_type_club' => 'Statistiques du club',
	'stats_event_label' => 'Evénement',
	'stats_event_combo_default' => 'Choisir un événement.',
	'stats_events_default_message' => "Prière de choisir une catégorie d'événement.",
	'stats_filter_note' => '<b>Note:</b> Utiliser les filtres pour affiner les statistques.',
	'stats_heading_summary' => 'Résume',
	'stats_events_not_enough_results' => "Il n'y a pas de résultat disponible.",
	'stats_heading_events' => "Statistiques de l'événement",
	'stats_heading_runner' => "Statistiques de l'athlète",
	'stats_label_total_races' => 'Courses',
	'stats_label_total_distance' => 'Distance parcourue',
	'stats_label_total_time' => 'Temps total de course',
	'stats_label_total_wins' => 'Victoires',
	'stats_label_total_runner_up' => 'Runner Up',
	'stats_label_total_top_10' => 'Top 10 Finishes',
	'stats_label_total_athletes' => 'Athletes du club',
	'stats_label_event_name' => 'Evénement',
	'stats_label_event_best' => 'Meilleur resultat',
	'stats_label_event_worst' => 'Pire Resultat',
	'stats_label_event_avg' => 'Moyenne',
	'stats_event_chart_title' => 'Performance récente',
	'stats_runners_chart_title' => 'Top 10 des coureurs les plus actifs',

	// pace
	'pace_minute' => 'min',
	'pace_m' => 'mile',
	'pace_km' => 'km',

	// measurements
	'km' => 'km',
	'mile' => 'miles',

	// pages
	'my_results_page_title' => 'Gérer les résultats',
	'recent_results_page_title' => 'Résultats récents',
	'records_male_page_title' => 'Records du cub masculins',
	'records_female_page_title' => 'Records du club féminis',
	'records_page_title' => 'Records du club',
	'events_page_title' => 'Evénements',

	// logs
	'new_result' => '<user>{name}</user> ran a time of <time>{result}</time> at the <event>{event-name}</event>',
	'new_result_position_addon' => ' and came {position} overall',
	'update_result' => '<user>{name}</user> updated the result for <event>{event-name}</event>',
	'new_event' => '<user>{name}</user> has created a new event <event>{event-name}</event>',
	'user_login' => '<user>{name}</user> has logged in',
	'profile_update' => '<user>{name}</user> has updated their profile information',
	'log_max_note' => 'Note: A maximum of 1000 log entries will be displayed',

	'filter_log_type_option_all' => 'Tous les types de log',
	'filter_log_type_option_user_login' => 'User Logins',
	'filter_log_type_option_new_result' => 'Resultat ajouté',
	'filter_log_type_option_update_result' => 'Resultat édités',
	'filter_log_type_option_new_event' => 'Evénement créés',
	'filter_log_type_option_profile_update' => 'Profile mise à jour',
	'filter_log_type_option_SQL' => 'SQL',
		
	'filter_events_all' => 'Tous les événements',
	'filter_events_my_events' => 'Mes événements',
	'filter_events_future_events' => 'Evénements futurs',
	'filter_only_future_events' => 'Seulement les événements futurs',

	// date & time
	'month_1' => 'janvier',
	'month_2' => 'février',
	'month_3' => 'mars',
	'month_4' => 'avril',
	'month_5' => 'mai',
	'month_6' => 'juin',
	'month_7' => 'juillet',
	'month_8' => 'août',
	'month_9' => 'septembre',
	'month_10' => 'october',
	'month_11' => 'novembre',
	'month_12' => 'décembre',
);

$admin_lang = array(
	// event category table
	'admin_column_event_cat_name' => 'Nome',
	'admin_column_event_cat_distance' => 'Distance',
	'admin_column_event_cat_unit' => 'Unité',
	'admin_column_event_cat_time_format' => 'Format des temps',
	'admin_column_event_cat_show_records' => 'Montrer les records',
	'admin_column_age_cat_id' => 'ID',
	'admin_column_age_cat_name' => 'Nom',
	'admin_column_age_cat_from' => 'De (années)',
	'admin_column_age_cat_to' => 'à (années)',
		
	// settings
	'admin_settings_label_button_save' => 'Sauver les paramètres',
	'admin_settings_label_button_saving' => 'Sauvegarde en cours...',
	'admin_settings_label_button_saved' => 'Sauvé!',
	'admin_settings_tab_label_general' => 'Généraux',
	'admin_settings_tab_label_advanced' => 'Avancés',
	'admin_settings_label_theme' => 'Thème',
	'admin_settings_label_club_name' => 'Nom du club',
	'admin_settings_label_language' => 'Langage',
	'admin_settings_label_unit' => 'Unité par défaut',
	'admin_settings_label_update_db' => 'Forcer les DB Update',
	'admin_settings_label_disable_sql_view' => 'Désactiver les vues SQL',
	'admin_settings_label_records_mode' => 'Mode des records',
	'admin_settings_submit_events_label' => 'Les utilisateurs ^peuvent soumettre des événements',
	'admin_settings_record_label_separate' => 'Separés',
	'admin_settings_record_label_combined' => 'Combinés',
	'admin_settings_label_enable_non_wpa' => 'Activé sur les pages non-WPA',
	'admin_settings_help_disable_sql_view' => "Choisissez cette option si votre hoster ne permet pas la création des vues SAL.",
	'admin_settings_help_records_mode' => 'Choisir \'Separarés\' si vous désirez séparaés les records féminins des records masculins, sinon \'Combined\'.',
	'admin_settings_help_submit_events' => 'Autoriser les athlètes à soumettre des événements et passés, et futurs. Par défaut cela est autorisé.',
	'admin_settings_help_non_wpa' => 'Si mis à Oui, charge le plugin WPA sur toutes les pages du site. Ceci permet l\'interactivité avec les widgets activés. Cela peut causer des problèmes sur certains sites.',
		
	// column help
	'admin_edit_event_cat_column_unit' => 'Les unités valides sont \'m\' (mètres), \'km\' (kilomètres) and \'mile\' (miles)',
	'admin_edit_event_cat_column_time_format' => 'Entrer le format des temps pour cette catégorie d\'événement. Les valeurs doivent être séparées par des vigules et les paramètres être valides: \'h\' (heures), \'m\' (minutes) \'s\' (secondes) and \'ms\' (millisecondes). 
	CE champs détermine aussi le format des nouvelles entrées pour cette catégorie d\'événement. E.g.: \'h:m:s\'',
	'admin_edit_event_cat_column_show_records' => 'Sélectionner si vous voulez inclure cette catégorie dans les records du club.',

	// errors
	'admin_edit_event_cat_invalid_name' => 'Nom introduit non valide',
	'admin_edit_event_cat_invalid_unit' => 'Unité introduite non valide',
	'admin_edit_event_cat_invalid_distance' => 'Distance introduite non valide',
	'admin_edit_event_cat_invalid_time_format' => 'Format de temps introduit non valide',
	'admin_edit_age_cat_invalid_name' => 'Nom introduit non valide',
	'admin_edit_age_cat_invalid_from_year' => 'Année de début introduite non valide',
	'admin_edit_age_cat_invalid_to_year' => 'Année de fin non valide',
	'admin_edit_age_cat_invalid_range' => 'Ce spectre d\' années est en conflit avec la catégorie d\'âge: ',
	'admin_edit_age_cat_from_greater_than_to' => 'La valeur \'De\' doit être inférieure à la valeur \'a\'',

	// buttons
	'admin_edit_event_cat_create_button' => 'Créer une catégorie d\événement',
	'admin_edit_age_cat_create_button' => 'Créer une catégorie d\'âge',

	// page titles
	'admin_edit_event_cat_title' => 'Paramétres des catégories d\'événements',
	'admin_edit_age_cat_title' => 'Paramétres des catégories d\'âge',
	'admin_manage_results_title' => 'Gérer les résultats',
	'admin_manage_athletes_title' => 'Gérer les athlètes',
	'admin_manage_events_title' => 'Gérer les événements',
	'admin_print_rankings_title' => 'Imprimer les classements',
		
	// athlete manager
	'admin_athlete_create_button' => 'Ajouter un nouvel athlète',
	'delete_athlete_text' => 'Etes-vous sur de vouloir supprimer cet athlète, ainsi que tous ces résultats?',
	'delete_athlete_title' => 'Supprimer un athlète?',
	'delete_athlete_tooltip' => 'Supprimer cet athlète (irreversible)',
	'edit_athlete_tooltip' => 'Editer cet athlète',
	'email_details_text' => "Envoyer les détails de connection à cet athlète",

	// event manager
	'edit_event_text' => 'Editer l\'événement',
	'delete_event_text' => 'Effacer l\'événement',
	'delete_selected_events_text' => 'Effacer l\'événement sélectionné',
	'delete_events_reassign_results_text' => 'Choisir l\événement auquel réassigner les résultat',
	'delete_events_confirm_title' => 'Effacer les événements',
	'delete_events_warning_title' => 'ATTENTION',
	'delete_events_text' => 'Vous allez effacer <span id="event-count"></span> événement(s). En êtes-vous sur?',
	'delete_events_reassign_text' => 'Il y a <span id="result-count"></span> résultat(s) associé(s) à cet événement.<br/>Vous pouvez réassigner les résultats à un autre événement.<br/><b>Sinon ils seront effacer.</b>',
	'delete_events_invalid_reassign_event' => 'Vous n epouvez pas réassigner des résultats à un événement sélectioner à être effacer',
	'merge_events_text' => 'Prière de selectioner un événement principal ce)dessous. Ce sera l\'événement avec lequel tous les événements sélectionnés seront fusionnés.',
	'merge_events_invalid_selection' => 'Vous devez selectionner au moins 2 événements à fusionner.',
	'merge_events_title' => 'Fusionner des événements',
	'merge_selected_events_text' => 'Fusionner les événements selectionnés',
	'merge' => 'Fusionner',
	'events_create_button' => 'Créer un nouvel événement',
	'embed_event_results_column_help' => 'Copier/Coller ces shortcodes dans un article ou une page afin de publier les résultats',

	// result manager
	'delete_selected_results_text' => 'Effacer les résultats sélectionnés',
	'delete_results_confirm_title' => 'Effacer les résultats',
	'reassign_selected_results_text' => 'Assigner les résultats à un autre athlète',
	'delete_results_confirm_text' => 'Vous allez effacer <span id="result-count"></span> résultat(s). En êtes-ous ur?',
	'reassign_results_text' => "Prière de selectionner l'utilisateur auquel vous allez réassigner les résultats sélectionnés. Taper le début du nom et choisissez dans la liste.",
	'reassign_results_input_text' => 'Réassigner les résultats à ... ',
	'reassign_results_title' => 'Réassigner les résultats',
	'reassign_results_no_user_selected' => 'Prière de sélectionner un utilisateur auquel réassigner les résultats.',
	'reassign_results_error' => 'Il y a eu un problème lors de la réassignation des résultats.',

	// add results
	'admin_add_results_title' => 'Ajouter des résultats',
	'add_results_event_input_text' => 'Tapez le début du nom de l\'événement',
	'add_results_choose_event_title' => 'Choisir un événement',
	'add_results_choose_event_text' => 'Choisissez un événement auquel ajouter des résultats. Vérifier que cet événement existe déjà.',
	'add_results_title' => 'Ajouter des résultats',
	'add_results_text' => "Maintenant ajouter autant de résutlats que vous le souhaitez. Avant de créer un nouvel athlète, vérifiez qu'il n'a pas déjà été créé. Lorsque vous créez un nouvel athlète avec cet outil, cette personne ne peut pas gérer ses résutlats tant que vous ne lui avez pas fourni ses détails de connexion.",
	'add_results_athlete_input_text' => 'Commencez à taper le nom de l\'athlète',
	'add_result_create_athlete_button' => 'Créer un nouvel athlète',
	'add_results_view_current_event_results' => 'Voir les rèsultats de cet événement',
	'add_result_button_text' => 'Ajouter des résultats',
	'add_result_gender_text' => 'Le genre de cet athlète n\'est pas connu. Prière de spécifier le genre avec d\'introduire les résultats',
	'add_result_gender_dialog_title' => 'Genre de l\'athlète requis.',
	'add_result_age_class_help' => "Ceci devriat être la catégorie d'âge de cet athlète à la date de l'événement. Vous devez donner une classe d'âge car la date de naissance de cet athlète n'est aps connu.<br/><br/>Si vous connaissez sa date de naissance, cliquez sur le lien <b>Définir la date de naissance</b> afin d'éviter de donner la classe d'âge à l'avenir.",
	'add_result_set_dob_text' => 'Définir la date de naissance',
	'add_result_dob_dialog_title' => 'Définir la date de naissance de l\'athlète',
	'add_result_dob_text' => 'Prière de choisir la date de naissance de l\'athlète avec le calendrier ci-dessous.',
	'add_result_set_dob_error' => 'Vous n\'avez pas encore choisi de date de naissance',
	'add_result_success_message' => 'Les résultats ont été entrés correctement.',
	'add_result_create_user_dob_help' => "Une date de naissance n'est pas nécessaire, mais facilitera les classements par âge des athlètes.",
	'add_result_create_user_success_dialog_title' => 'Athlète créé',
	'add_result_create_user_success_text' => "L'athlète a été créé correctement. Les détails de connection peuvent lui être fourni afin de lui permettre de gèrer lui -même ses résultats. Prière de prendre note du nom de l'utilisateur ainsi que du mot de passe.",
	'add_result_embed_text' => 'Insérez les résultats de cet événement en utilisant ce shortcode:',

	// misc
	'select_unselect_all_tooltip' => 'Sélectionner/Désélectionner Tout',
	'create_user_dialog_title_result_' => 'Créer un nouvel athlète',
	'edit_user_dialog_title' => 'Editer un athlète',

	// print rankings
	'print_rankings_text' => 'classement',
	'print_rankings_powered_by' => 'Powered by <b>WP-Athletics</b> a plugin for Wordpress',
	'print_rankings_enter_results_text' => 'Manquant dans la liste? Enregistrez-vous et entrez vos résultats à:',
	'admin_print_rankings_description' => 'Choissisez les critères de classement et cliquez "Imprimer", une nouvelle tabulation apparaîtra avec la table de classement.',

	// log
	'log_admin_column_date' => 'Date',
	'log_admin_column_type' => 'Log Type',
	'log_admin_column_log' => 'Log',
		
	// shortcode generator,
	'shortcode_select_options_text' => 'Personaliser',
	'shortcode_select_type_text' => 'Choisir un shortcode',
	'shortcode_copy_text' => 'Copier',
	'shortcode_rankings_option_text' => 'Afficher un tableau de classement personalisée',
	'shortcode_user_results_option_text' => 'Afficher les résultats pour un seul athlète',
	'shortcode_event_results_option_text' => 'Afficher un tableau de résultats',
	'shortcode_records_option_text' => 'Afficher un tableau pour les records de tous les temps',
	'shortcode_manage_option_text' => 'Gérér les résultats de l\'athlète séléctionné',
	'shortcode_recent_results_option_text' => 'Afficher un Feed de résultats récents',
	'shortcode_events_option_text' => 'Afficher le calendrier des événements',
	'shortcode_select_option_interactive_default' => 'Shortcodes interactifs...',
	'shortcode_select_option_simple_default' => 'Shortcodes simples...',
	'filter_split_by_year' => 'Année',
	'filter_split_by_distance' => 'Catégorie d\'événement',
	'shortcode_select_split' => 'Séparer les résultats par',
	'shortcode_select_event' => 'Choisir l\événement',
	'shortcode_select_period' => 'Choisir l\'année',
	'shortcode_select_terrain' => 'Choisir le terrain',
	'shortcode_select_gender' => 'Choisir le genre',
	'shortcode_select_category' => 'Choisir la catégorie d\'âge',
	'shortcode_generate_button_text' => 'Générer le Shortcode',
	'shortcode_max_results' => 'Resultats maximum',
	'shortcode_no_options_text' => 'Il n\'y a pas d\'option disponible pour ce Shortcode',
	'view_shortcodes_button' => 'Voir les Shortcodes',
	'view_event_shortcodes_dialog_title' => 'Shortcodes pour les résultats d\'événements',
	'shortcode_help_text' => "Ces Shortcodes peuvent être copiés et collés dans un Post ou un page. Ils afficheront les tableaux de données.
	   Il y a deux sortes de Shortcodes disponibles: <strong>simple</strong> et <strong>interactif</strong>.
		Les Shortcodes simples affichent du texte dans un tableau de base; tandis que les Shortcodes interactifs sont (et oui) interactifs.
		Vous pouvez cliquer sur un athlète ou un événement pour afficher plus d\'informations."
);

return array(
	'common' => $common_lang,
	'admin' => $admin_lang
)

?>