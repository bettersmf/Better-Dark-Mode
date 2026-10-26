<?php

if (!defined('SMF'))
	die('No direct access...');

global $sourcedir, $modSettings;

require_once($sourcedir . '/Subs-Admin.php');

$hooks = array(
	'integrate_admin_areas' => 'BetterDarkMode_AdminAreas',
	'integrate_load_theme' => 'BetterDarkMode_LoadTheme',
	'integrate_buffer' => 'BetterDarkMode_Buffer',
);

foreach ($hooks as $hook => $function)
	add_integration_function($hook, '$sourcedir/BetterDarkMode.php|' . $function, true);

$defaults = array(
	'better_dark_mode_enabled' => 1,
	'better_dark_mode_default_mode' => 'system',
	'better_dark_mode_allow_toggle' => 1,
	'better_dark_mode_curve_only' => 1,
);

$missing = array();
foreach ($defaults as $key => $value)
	if (!isset($modSettings[$key]))
		$missing[$key] = $value;

if (!empty($missing))
	updateSettings($missing);
