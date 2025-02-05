<?php

/**
 * The Simple Email Queue Plugin
 *
 * Put email in queue and send it one by one, by limits.
 *
 * @package Simple_Email_Queue
 * @subpackage Main
 */

/**
 * Plugin Name: Simple Email Queue
 * Plugin URI:  https://milandinic.com/wordpress/plugins/simple-email-queue/
 * Description: Put email in queue and send it one by one, by limits.
 * Author:      Milan Dinić
 * Author URI:  https://milandinic.com/
 * Version:     1.3
 * Text Domain: simple-email-queue
 * Domain Path: /languages/
 * License:     GPL
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

// Check minimum required PHP version.
if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
	return;
}

/**
 * Autoloader for Simple Email Queue classes.
 *
 * @param string $class Name of the class.
 */
function simple_email_queue_autoloader( $class ) {
	$pairs = array(
		'WP_Temporary'                          => '/lib/wp-temporary/class-wp-temporary.php',
		'Temporary_Command'                     => '/lib/wp-temporary/cli/Temporary_Command.php',
		'Simple_Email_Queue'                    => '/inc/class-simple-email-queue.php',
		'dimadin\WP\Library\Backdrop\Main'      => '/lib/backdrop/inc/Main.php',
		'dimadin\WP\Library\Backdrop\Server'    => '/lib/backdrop/inc/Server.php',
		'dimadin\WP\Library\Backdrop\Task'      => '/lib/backdrop/inc/Task.php',
	);

	if ( array_key_exists( $class, $pairs ) ) {
		include __DIR__ . $pairs[ $class ];
	}
}
spl_autoload_register( 'simple_email_queue_autoloader' );

/*
 * Initialize a plugin.
 *
 * Load class when all plugins are loaded
 * so that other plugins can overwrite it.
 */
add_action( 'plugins_loaded', array( 'Simple_Email_Queue', 'plugins_loaded' ), 15 );

/**
 * Helper wrapper for adding emails to queue.
 *
 * @see Simple_Email_Queue::add_to_queue()
 *
 * @since 1.0
 *
 * @param string|array $to          Array or comma-separated list of email addresses to send message.
 * @param string       $subject     Email subject.
 * @param string       $message     Message contents.
 * @param string|array $headers     Optional. Additional headers.
 * @param string|array $attachments Optional. Files to attach.
 */
function simple_email_queue_add( $to, $subject, $message, $headers = '', $attachments = array() ) {
	Simple_Email_Queue::get_instance()->add_to_queue( $to, $subject, $message, $headers, $attachments );
}

/**
 * Add action links to plugins page.
 *
 * @since 1.0
 *
 * @param array  $links       Existing plugin's action links.
 * @param string $plugin_file Path to the plugin file.
 * @return array $links New plugin's action links.
 */
function simple_email_queue_action_links( $links, $plugin_file ) {
	// Set basename
	$basename = plugin_basename( __FILE__ );

	// Check if it is for this plugin
	if ( $basename != $plugin_file ) {
		return $links;
	}

	// Load translations
	load_plugin_textdomain( 'simple-email-queue', false, dirname( $basename ) . '/languages' );

	// Add new links
	$links['premium']  = '<a href="https://shop.milandinic.com/downloads/simple-email-queue-plus/">' . __( 'Plus Version', 'simple-email-queue' ) . '</a>';

	return $links;
}
add_filter( 'plugin_action_links',               'simple_email_queue_action_links', 10, 2 );
add_filter( 'network_admin_plugin_action_links', 'simple_email_queue_action_links', 10, 2 );
