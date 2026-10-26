<?php

if (!defined('SMF'))
	die('No direct access...');

function BetterDarkMode_Defaults()
{
	return array(
		'enabled' => 1,
		'default_mode' => 'system',
		'allow_toggle' => 1,
		'curve_only' => 1,
	);
}

function BetterDarkMode_Settings()
{
	global $modSettings;

	$defaults = BetterDarkMode_Defaults();

	return array(
		'enabled' => isset($modSettings['better_dark_mode_enabled']) ? !empty($modSettings['better_dark_mode_enabled']) : $defaults['enabled'],
		'default_mode' => !empty($modSettings['better_dark_mode_default_mode']) && in_array($modSettings['better_dark_mode_default_mode'], array('system', 'light', 'dark'), true) ? $modSettings['better_dark_mode_default_mode'] : $defaults['default_mode'],
		'allow_toggle' => isset($modSettings['better_dark_mode_allow_toggle']) ? !empty($modSettings['better_dark_mode_allow_toggle']) : $defaults['allow_toggle'],
		'curve_only' => isset($modSettings['better_dark_mode_curve_only']) ? !empty($modSettings['better_dark_mode_curve_only']) : $defaults['curve_only'],
	);
}

function BetterDarkMode_LoadLanguage()
{
	loadLanguage('BetterDarkMode');
}

function BetterDarkMode_AdminAreas(&$admin_areas)
{
	global $txt;

	BetterDarkMode_LoadLanguage();

	if (empty($admin_areas['config']))
		return;

	$admin_areas['config']['areas']['better_dark_mode'] = array(
		'label' => $txt['better_dark_mode_admin'],
		'file' => 'BetterDarkMode.php',
		'function' => 'BetterDarkMode_Admin',
		'permission' => array('admin_forum'),
		'icon' => 'better_dark_mode.png',
		'subsections' => array(
			'settings' => array($txt['settings'] ?? 'Settings'),
		),
	);
}

function BetterDarkMode_Admin()
{
	global $context, $txt, $scripturl, $sourcedir;

	BetterDarkMode_LoadLanguage();

	// Better Dark Mode is a single-settings-page admin area, but SMF's
	// GenericMenu still expects a real subsection + tab_data structure.
	$_REQUEST['sa'] = 'settings';
	BetterDarkMode_SetupAdminTabs();

	// SMF 2.1.x keeps prepareDBSettingContext() and saveDBSettings()
	// in ManageServer.php. Do not depend on the undefined SUBSDIR constant.
	require_once($sourcedir . '/ManageServer.php');

	$context['page_title'] = $txt['better_dark_mode_admin'];
	$context['sub_template'] = 'show_settings';

	$config_vars = array(
		array('check', 'better_dark_mode_enabled', 'subtext' => $txt['better_dark_mode_enabled_help']),
		array('select', 'better_dark_mode_default_mode', array(
			'system' => $txt['better_dark_mode_mode_system'],
			'light' => $txt['better_dark_mode_mode_light'],
			'dark' => $txt['better_dark_mode_mode_dark'],
		), 'subtext' => $txt['better_dark_mode_default_mode_help']),
		array('check', 'better_dark_mode_allow_toggle', 'subtext' => $txt['better_dark_mode_allow_toggle_help']),
		array('check', 'better_dark_mode_curve_only', 'subtext' => $txt['better_dark_mode_curve_only_help']),
	);

	if (isset($_GET['save']))
	{
		checkSession();
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=better_dark_mode;sa=settings');
	}

	$context['post_url'] = $scripturl . '?action=admin;area=better_dark_mode;sa=settings;save';
	prepareDBSettingContext($config_vars);
}


function BetterDarkMode_SetupAdminTabs()
{
	global $context, $txt;

	$tab_data = array(
		'title' => $txt['better_dark_mode_admin'] ?? 'Better Dark Mode',
		'description' => $txt['better_dark_mode_admin_desc'] ?? 'Configure Better Dark Mode.',
		'tabs' => array(
			'settings' => array(
				'description' => $txt['better_dark_mode_admin_desc'] ?? 'Configure Better Dark Mode.',
			),
		),
	);

	$menu_key = null;

	if (!empty($context['admin_menu_name'])
		&& isset($context[$context['admin_menu_name']])
		&& is_array($context[$context['admin_menu_name']])
		&& (($context[$context['admin_menu_name']]['current_area'] ?? '') === 'better_dark_mode'))
	{
		$menu_key = $context['admin_menu_name'];
	}

	if ($menu_key === null)
	{
		foreach ($context as $key => $value)
		{
			if (strpos((string) $key, 'menu_data_') !== 0 || !is_array($value))
				continue;

			if (($value['current_area'] ?? '') === 'better_dark_mode')
			{
				$menu_key = $key;
				break;
			}
		}
	}

	if ($menu_key === null)
		return;

	$context[$menu_key]['current_subsection'] = 'settings';
	$context[$menu_key]['tab_data'] = $tab_data;
	$context['admin_menu_name'] = $menu_key;
}

function BetterDarkMode_IsCurve()
{
	global $settings, $context;

	if (!empty($settings['theme_id']) && (int) $settings['theme_id'] === 1)
		return true;

	$name = '';
	if (!empty($context['theme_name']))
		$name = (string) $context['theme_name'];
	elseif (!empty($settings['theme_name']))
		$name = (string) $settings['theme_name'];

	return stripos($name, 'curve') !== false;
}

function BetterDarkMode_LoadTheme()
{
	global $context;

	$cfg = BetterDarkMode_Settings();
	if (empty($cfg['enabled']))
		return;

	if (!empty($cfg['curve_only']) && !BetterDarkMode_IsCurve())
		return;

	$context['better_dark_mode_active'] = true;
	$context['better_dark_mode_default'] = $cfg['default_mode'];
	$context['better_dark_mode_toggle'] = !empty($cfg['allow_toggle']);

	loadCSSFile('better_dark_mode.css', array('minimize' => true, 'order_pos' => 10000), 'better_dark_mode');
	loadJavaScriptFile('better_dark_mode.js', array('defer' => true, 'minimize' => true, 'order_pos' => 10000), 'better_dark_mode');
}

function BetterDarkMode_Buffer($buffer)
{
	global $context, $txt;

	if (empty($context['better_dark_mode_active']) || !is_string($buffer))
		return $buffer;

	BetterDarkMode_LoadLanguage();

	$default = !empty($context['better_dark_mode_default']) ? $context['better_dark_mode_default'] : 'system';

	$bootstrap = '<script id="better-dark-mode-bootstrap">(function(){try{var d='
		. json_encode($default)
		. ',s=localStorage.getItem("betterDarkMode"),c=s||d,m=c;if(m==="system")m=window.matchMedia&&window.matchMedia("(prefers-color-scheme:dark)").matches?"dark":"light";document.documentElement.setAttribute("data-better-dark-mode",m);document.documentElement.setAttribute("data-better-dark-mode-choice",c);}catch(e){}})();</script>';

	if (stripos($buffer, '</head>') !== false)
		$buffer = str_ireplace('</head>', $bootstrap . '</head>', $buffer);

	if (!empty($context['better_dark_mode_toggle']))
	{
		$label = htmlspecialchars($txt['better_dark_mode_toggle'], ENT_QUOTES, 'UTF-8');
		$toggle = '<button type="button" id="better_dark_mode_toggle" class="better-dark-mode-toggle" aria-label="'
			. $label . '" title="' . $label . '"><span class="better-dark-mode-icon" aria-hidden="true"></span></button>';

		// Place the control directly inside Curve2's #top_section .inner_wrap.
		// Match the structure rather than an exact closing-comment string, because
		// whitespace/template formatting can differ between Curve2 copies.
		$pattern = '~(<div\\s+id=["\\\']top_section["\\\'][^>]*>\\s*<div\\s+class=["\\\']inner_wrap["\\\'][^>]*>)~i';
		if (preg_match($pattern, $buffer))
			$buffer = preg_replace($pattern, '$1' . $toggle, $buffer, 1);
		elseif (stripos($buffer, '</body>') !== false)
			$buffer = str_ireplace('</body>', $toggle . '</body>', $buffer);
	}

	return $buffer;
}
