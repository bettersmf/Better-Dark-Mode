<?php

if (!defined('SMF'))
	die('No direct access...');

global $sourcedir;

require_once($sourcedir . '/Subs-Admin.php');

$hooks = array(
	'integrate_admin_areas' => 'BetterDarkMode_AdminAreas',
	'integrate_load_theme' => 'BetterDarkMode_LoadTheme',
	'integrate_buffer' => 'BetterDarkMode_Buffer',
);

foreach ($hooks as $hook => $function)
	remove_integration_function($hook, '$sourcedir/BetterDarkMode.php|' . $function);
