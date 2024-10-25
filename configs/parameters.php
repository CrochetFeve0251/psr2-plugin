<?php
namespace Launchpad\Configs;

defined( 'ABSPATH' ) || exit;

$plugin_name = 'Launchpad'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$plugin_launcher_path = dirname( __DIR__ ) . '/'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

return [
	'plugin_name'          => $plugin_name,
	'plugin_slug'          => sanitize_key( $plugin_name ),
	'plugin_version'       => '1.0.0',
	'plugin_launcher_file' => $plugin_launcher_path . '/' . basename( $plugin_launcher_path ) . '.php',
	'plugin_launcher_path' => $plugin_launcher_path,
	'plugin_inc_path'      => realpath( $plugin_launcher_path . 'inc/' ) . '/',
	'prefix'               => 'launchpad_',
	'translation_key'      => 'launchpad',
	'autowiring'           => true,
	'is_mu_plugin'         => false,
];
